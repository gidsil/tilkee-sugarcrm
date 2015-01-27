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

class TILKEE_PROJECTSViewDetail extends ViewDetail {

 	public function __construct(){
 		parent::ViewDetail();
 	}
 	
 	function display() {
            global $mod_strings, $app_strings, $app_list_strings, $sugar_config, $current_user;		

            $this->ss->assign("MOD", $mod_strings);     
            $this->ss->assign("APP_LIST", $app_list_strings); 

            // Sync info from tilkee server
            $this->bean->sync_from_API('update_tilks');

            // Build Stat url 
            $stat_url = "";
            if (isset($current_user->tilkee_token_c) && !empty($current_user->tilkee_token_c) && !empty($this->bean->stat_url)) {
                $stat_url = $this->bean->stat_url.'&access_token='.$current_user->tilkee_token_c;
            }
            $this->ss->assign("STAT_URL", $stat_url);
            // Build Stat url 
            $preview_url = "";
            if (isset($current_user->tilkee_token_c) && !empty($current_user->tilkee_token_c) && !empty($this->bean->preview_url)) {
                $preview_url = $this->bean->preview_url.'&access_token='.$current_user->tilkee_token_c;
            }
            $this->ss->assign("PREVIEW_URL", $preview_url);
                        
            $button_array = $this->dv->defs['templateMeta']['form']['buttons'] ;
            $new_button_array = array();
            $new_button_array[] = $button_array[0]; // EDIT
            //$new_button_array[] = $button_array[1]; // DUPLICATE
            $new_button_array[] = $button_array[3]; // DUPLICATE

            switch ($this->bean->status) {
                case 'reviewing':
                    $new_button_array[] = $button_array[2]; // DELETE
                    $new_button_array[] = $button_array[4]; // ARCHIVED/WON
                    $new_button_array[] = $button_array[5]; // ARCHIVED/LOST
                    $new_button_array[] = $button_array[6]; // ARCHIVED
                    break;
                case 'pending_approval':
                    break;
                case 'activated':
                    $new_button_array[] = $button_array[4]; // ARCHIVED/WON
                    $new_button_array[] = $button_array[5]; // ARCHIVED/LOST
                    $new_button_array[] = $button_array[6]; // ARCHIVED
                    break;
                case 'archived':
                    $new_button_array[] = $button_array[2]; // DELETE
                    $new_button_array[] = $button_array[7]; // DESARCHIVED
                    break;
                default:
                    break;
            }
            $this->dv->defs['templateMeta']['form']['buttons'] = $new_button_array;
            
            parent::display();
            
        }
}
