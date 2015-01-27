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

class hook_tilkee_tilks {

    //
    // Update TILKEE TILK
    // before save a TILKEE TILK
    //
    function update_tilkee_tilk(&$bean, $event, $arguments = null) 
    {        
        if($event != 'before_save'){
          return;
        }

        global $beanFiles;
        
        $tilk_name = '[TILK] ';
        
        // Email initialisation
        if ($bean->contacts_id != '') {
            require_once($beanFiles['Contact']);
            $the_contact = new Contact();
            $the_contact->retrieve($bean->contacts_id);
            
            $bean->contact_email = $the_contact->emailAddress->getPrimaryAddress($the_contact);
            $bean->name          = $tilk_name.$the_contact->name;
        }
        if ($bean->leads_id != '') {
            require_once($beanFiles['Lead']);
            $the_lead = new Lead();
            $the_lead->retrieve($bean->leads_id);
            
            $bean->contact_email = $the_lead->emailAddress->getPrimaryAddress($the_lead);
            $bean->name          = $tilk_name.$the_lead->name;
        } 
        
        // delete URL if tilk is archived
        if ($bean->archived == 'true') {
            $bean->tilk_url = '';
        }
    }    
    
    //
    // Delete TILKEE TILK
    // before delete a TILKEE TILK, we delete Connexions
    //
    function delete_tilkee_tilk(&$bean, $event, $arguments = null) 
    {        
        if($event != 'before_delete'){
          return;
        }

        // NO TILKEE API FOR THAT
        
        $bean->load_relationship('tilkee_tilks_tilkee_connexions');
        foreach ($bean->tilkee_tilks_tilkee_connexions->getBeans() as $tilkee_connexions) {
            $tilkee_connexions->mark_deleted($tilkee_connexions->id);
        }            
    }   
    
    //
    // API call to update tilk
    //
    function update_tilkee_tilk_API(&$bean, $event, $arguments = null) 
    {        
        if($event != 'after_save'){
          return;
        }
       
        // If the tilk just create 
        if (empty($bean->tilkee_id)) {

            // Call creation API and update bean
            $bean->create_from_API();
        } else {
            
            // Call update API and update bean
            $bean->update_from_API();
            
        }                        
    }

    //
    // API call to sync project
    //
    function process_record_tilk(&$bean, $event, $arguments = null) 
    {        
        if($event != 'process_record'){
          return;
        }
        
        if (!empty($bean->tilkee_id)) {
            $bean->sync_from_API();
        }
        
    }
    
    
}

