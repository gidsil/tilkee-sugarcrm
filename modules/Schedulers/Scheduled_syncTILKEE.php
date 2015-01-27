<?php

/* 
 * Copyright 2014 Corto.
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

$job_strings[] = 'syncTILKEE';


function syncTILKEE(){
    global $sugar_config;

    $GLOBALS['log']->info('Scheduled syncTILKEE -> START');
    
    if (isset($sugar_config['tilkee']['user_scheduler']) && isset($sugar_config['tilkee']['user_scheduler'])) {

        require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
        require_once('modules/TILKEE_PROJECTS/TILKEE_PROJECTS.php');
        require_once('modules/Users/User.php');
        
        global $current_user ;
        //$scheduler_user = new User();
        $current_user->retrieve($sugar_config['tilkee']['user_scheduler']);

        $tilkee = new ExtAPITilkee();
        //$result_call = $tilkee->get_token_password($login, $mdp) ;

        // retrieve all TILKEE Projects
        $tilkee_projects_array = get_bean_select_array(false, 'TILKEE_PROJECTS', 'name', '', 'name', false) ;

        foreach ($tilkee_projects_array as $id => $project) {

            $current_project = new TILKEE_PROJECTS();
            $current_project->retrieve($id);

            $current_project->sync_from_API('update_tilks');

            // Retrieve list of TILKS and update connexion
            $tilks_array = $current_project->get_linked_beans('tilkee_projects_tilkee_tilks','TILKEE_TILKS');

            foreach ($tilks_array as $tilkee_tilk) {
                $tilkee_tilk->sync_from_API('update_connexions');		    		    
            }		
            unset ($current_project);		
        }		
    } else {
        $GLOBALS['log']->fatal('Scheduled syncTILKEE -> scheduler connexion information is not set');
    }

    $GLOBALS['log']->info('Scheduled syncTILKEE -> END');
    return true;

}