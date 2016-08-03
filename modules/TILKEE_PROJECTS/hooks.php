<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*
 * Copyright 2014 TILKEE.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class hook_tilkee_projects {

    //
    // If an Opportunity's sales_stage change
    //  to "Closed Won" the project statut change to "archived" and won equal "true"
    //  to "Closed Lost" the project statut change to "archived" and won equal "false"
    //
    //  WARNING : This is a Opportunity module HOOK
    //
    function update_project_from_opportunity(&$bean, $event, $arguments = null)
    {
        if($event != 'after_save'){
          return;
        }

        if ($bean->sales_stage == "Closed Won") {
            $bean->load_relationship('tilkee_projects_opportunities');
            foreach ($bean->tilkee_projects_opportunities->getBeans() as $tilkee_projects) {
                if (($tilkee_projects->status != 'archived') || ($tilkee_projects->won != 'true')) {
                    $tilkee_projects->status = 'archived';
                    $tilkee_projects->won    = 'true';
                    $tilkee_projects->save();
                }
            }
        }

        if ($bean->sales_stage == "Closed Lost") {
            $bean->load_relationship('tilkee_projects_opportunities');
            foreach ($bean->tilkee_projects_opportunities->getBeans() as $tilkee_projects) {
                if (($tilkee_projects->status != 'archived') || ($tilkee_projects->won != 'false')) {
                    $tilkee_projects->status = 'archived';
                    $tilkee_projects->won    = 'false';
                    $tilkee_projects->save();
                }
            }
        }
    }

    //
    // Init Project fields before save
    //      - update account ID from Opportunity
    //      - update name
    //      - update linked opportunity if project archived
    //
    function update_tilkee_project(&$bean, $event, $arguments = null)
    {
        if($event != 'before_save'){
          return;
        }
        global $beanFiles;
        // Update accounts_id if opportunities_id is set
        if (empty($bean->accounts_id) && !empty($bean->opportunities_id)) {
            if (file_exists($beanFiles['Opportunity'])) {
                require_once($beanFiles['Opportunity']);
                $current_opportunity = new Opportunity();
                $current_opportunity->retrieve($bean->opportunities_id);
                if (!empty($current_opportunity->account_id)) {
                    $bean->accounts_id = $current_opportunity->account_id ;
                }
            }
        }

        // Update TILKEE Project name
        if (!empty($bean->accounts_name)) {
            $bean->name = "[TILKEE] ".$bean->accounts_name ;
        }
        if (!empty($bean->opportunities_name)) {
            $bean->name = "[TILKEE] ".$bean->opportunities_name ;
        }

        // Si le projet TILKEE n'est pas créé on essaie de le créé ici
        // si il y a un probleme de connexion le projet n'est pas créé !!!
        if (empty($bean->tilkee_id)) {
            $bean->create_from_API();
        }
    }

    //
    // Delete TILKEE project
    // before delete a TILKEE project, we delete TILKS and Connexions
    //
    function delete_tilkee_project(&$bean, $event, $arguments = null)
    {
        if($event != 'before_delete'){
          return;
        }
        // appel de l'API de suppression du projet
        require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
        $tilkee = new ExtAPITilkee();
        $result = $tilkee->delete_project($bean->tilkee_id);

        // No return info from the API so we expect it's realy deleted !!!
        // And delete linked tilks
        $bean->load_relationship('tilkee_projects_tilkee_tilks');
        foreach ($bean->tilkee_projects_tilkee_tilks->getBeans() as $tilkee_tilks) {
            $tilkee_tilks->mark_deleted($tilkee_tilks->id);
        }
    }

    //
    // API call to update project
    //
    function update_tilkee_project_API(&$bean, $event, $arguments = null)
    {
        if($event != 'after_save'){
          return;
        }

        global $beanFiles;

        // Update linked Opportunity sales_stage if project archived
        if (($bean->status == 'archived') && (!empty($bean->opportunities_id))){
            if (file_exists($beanFiles['Opportunity'])) {
                require_once($beanFiles['Opportunity']);
                $current_opportunity = new Opportunity();
                $current_opportunity->retrieve($bean->opportunities_id);

                if ($bean->won == 'true') {
                        if ($current_opportunity->sales_stage != 'Closed Won') {
                        $current_opportunity->sales_stage = 'Closed Won';
                        $current_opportunity->save();
                    }
                }
                if ($bean->won == 'false') {
                        if ($current_opportunity->sales_stage != 'Closed Lost') {
                        $current_opportunity->sales_stage = 'Closed Lost';
                        $current_opportunity->save();
                    }
                }
            }
        }

        // If the project just create
        if (empty($bean->tilkee_id)) {
            // appel de l'API de creation du projet et Mise a jour des infos du projet
            $bean->create_from_API();
        //} else {
            // appel de l'API de mise à jour du projet et Mise a jour des infos du projet
            //$bean->update_from_API($this->won, ($this->status=='archived')?'true':'false');
        }

    }
}

