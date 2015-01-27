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

class TILKEE_PROJECTSViewEdit extends ViewEdit {

 	public function __construct(){
 		parent::ViewEdit();
 	}
 	
 	function display() {
            global $mod_strings, $app_strings, $app_list_strings, $sugar_config, $beanFiles, $current_user;		

            $this->ss->assign("MOD", $mod_strings);     
            $this->ss->assign("APP_LIST", $app_list_strings);  

            // IF THE PROJECT IS CREATED FROM AN OPP
            if (isset($_REQUEST['CreateFromOpp']) && ($_REQUEST['CreateFromOpp'] == 'true')) {
                
                // CREATE DEFAULT PROJECT LINK WITH OPPORTUNITY
                require_once($beanFiles['Opportunity']);
                $link_opportunity = new Opportunity();
                $link_opportunity->retrieve($_REQUEST['return_id']);
                
                $this->bean->opportunities_id 	= $link_opportunity->id;
                $this->bean->opportunities_name = $link_opportunity->name;
                $this->bean->accounts_name 	= $link_opportunity->account_name;
                $this->bean->accounts_id   	= $link_opportunity->account_id;

                $this->bean->id     = $this->bean->save();
                $_REQUEST['record'] = $this->bean->id;
                
            }

                        // IF THE PROJECT IS CREATED FROM AN ACCOUNT
            if (isset($_REQUEST['CreateFromAcc']) && ($_REQUEST['CreateFromAcc'] == 'true')) {
                
                // CREATE DEFAULT PROJECT LINK WITH OPPORTUNITY
                require_once($beanFiles['Account']);
                $link_account = new Account();
                $link_account->retrieve($_REQUEST['return_id']);
                
                $this->bean->accounts_name 	= $link_account->name;
                $this->bean->accounts_id   	= $link_account->id;

                $this->bean->id     = $this->bean->save();
                $_REQUEST['record'] = $this->bean->id;
                
            }

            // Build Stat url 
            $edit_url = "";
            if (isset($current_user->tilkee_token_c) && !empty($current_user->tilkee_token_c) && !empty($this->bean->edit_url)) {
                $edit_url = $this->bean->edit_url.'&access_token='.$current_user->tilkee_token_c;
            }
            $this->ss->assign("EDIT_URL", $edit_url);

            
            parent::display();
            
        }
}
