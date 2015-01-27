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

class TILKEE_TILKSViewEdit extends ViewEdit {

 	public function __construct(){
 		parent::ViewEdit();
 	}
 	
 	function display() {
            global $mod_strings, $app_strings, $app_list_strings, $sugar_config, $beanFiles;		

            $this->ss->assign("MOD", $mod_strings);     
            $this->ss->assign("APP_LIST", $app_list_strings);  

            // Init default name
            $this->bean->name = '[TILK] ';
                    
            // IF THE TILK IS CREATED FROM AN CONTACT
            if (isset($_REQUEST['CreateFromContact']) && ($_REQUEST['CreateFromContact'] == 'true')) {
                
                // CREATE DEFAULT TILK LINK WITH CONTACT
                require_once($beanFiles['Contact']);
                $link_contact = new Contact();
                $link_contact->retrieve($_REQUEST['return_id']);
                
                $this->bean->contacts_id   = $link_contact->id;
                $this->bean->contacts_name = $link_contact->name;
                $this->bean->contact_email = $link_contact->emailAddress->getPrimaryAddress($link_contact);
                $this->bean->name          = '[TILK] '.$link_contact->name;
                
                //$this->bean->id     = $this->bean->save();
                $_REQUEST['record'] = $this->bean->id;
                
                // TILKEE API - CREATE PROJECT AND SYNCH IT
                
            }

            // IF THE TILK IS CREATED FROM AN LEAD
            if (isset($_REQUEST['CreateFromLead']) && ($_REQUEST['CreateFromLead'] == 'true')) {
                
                // CREATE DEFAULT TILK LINK WITH LEAD
                require_once($beanFiles['Lead']);
                $link_lead = new Lead();
                $link_lead->retrieve($_REQUEST['return_id']);
                
                $this->bean->leads_name    = $link_lead->name;
                $this->bean->leads_id      = $link_lead->id;
                $this->bean->contact_email = $link_lead->emailAddress->getPrimaryAddress($link_lead);
                $this->bean->name          = '[TILK] '.$link_lead->name;

                //$this->bean->id     = $this->bean->save();
                $_REQUEST['record'] = $this->bean->id;
                
                // TILKEE API - CREATE PROJECT AND SYNCH IT
                
            }

            // IF THE TILK IS CREATED FROM AN PROJECT
            if (isset($_REQUEST['CreateFromProject']) && ($_REQUEST['CreateFromProject'] == 'true')) {
                
                // CREATE DEFAULT TILK LINK WITH PROJECT
                require_once($beanFiles['TILKEE_PROJECTS']);
                $link_tilkee_project = new TILKEE_PROJECTS();
                $link_tilkee_project->retrieve($_REQUEST['return_id']);
                
                $this->bean->tilkee_projects_name = $link_tilkee_project->name;
                $this->bean->tilkee_projects_id   = $link_tilkee_project->id;

                //$this->bean->id     = $this->bean->save();
                $_REQUEST['record'] = $this->bean->id;
                
                // TILKEE API - CREATE PROJECT AND SYNCH IT
                
            }

            
            parent::display();
            
        }
}
