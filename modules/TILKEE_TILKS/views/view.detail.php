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

class TILKEE_TILKSViewDetail extends ViewDetail {

 	public function __construct(){
 		parent::ViewDetail();
 	}
 	
 	function display() {
            global $mod_strings, $app_strings, $app_list_strings, $sugar_config, $current_user;		

            $this->ss->assign("MOD", $mod_strings);     
            $this->ss->assign("APP_LIST", $app_list_strings);   

            // Sync info from tilkee server
            $this->bean->sync_from_API('update_connexions');
            
            $button_array = $this->dv->defs['templateMeta']['form']['buttons'] ;
            $new_button_array = array();
            if ($this->bean->archived === 'true') {
                $new_button_array[] = $button_array[0]; // DELETED
            }
            $new_button_array[] = $button_array[1]; // SEND EMAIL
            $new_button_array[] = $button_array[2]; // COPY URL
            $new_button_array[] = $button_array[3]; // ARCHIVED/WON
            $new_button_array[] = $button_array[4]; // ARCHIVED/LOST
            $new_button_array[] = $button_array[5]; // ARCHIVED
                        
            $this->dv->defs['templateMeta']['form']['buttons'] = $new_button_array;
            
            // BUILD SEND MAIL BUTTON
            $userPref    = $current_user->getPreference('email_link_type');
            $defaultPref = $sugar_config['email_default_client'];
            if($userPref != '') {
                    $client = $userPref;
            } else {
                    $client = $defaultPref;
            }
            
            $title_button = $mod_strings['LBL_SEND_MAIL_TITLE'];
            $value_button = $mod_strings['LBL_SEND_MAIL_VALUE'];
            $parent_id    = '';
            $parent_type  = '';
            $parent_name  = '';
            $button       = '';
            
            // Links to a Contact
            if ($this->bean->contacts_id != '') {
                $parent_id   = $this->bean->contacts_id;
                $parent_name = $this->bean->contacts_name;
                $parent_type = 'Contacts';
            }
            // Links to a Lead
            if ($this->bean->leads_id != '') {
                $parent_id   = $this->bean->leads_id;
                $parent_name = $this->bean->leads_name;
                $parent_type = 'Leads';
            }
            // Build Send mail action depends on user prefs
            if ($parent_type != '') {
                if($client != 'sugar') {
                        if (isset($this->bean->contact_email)){
                                $to_addrs = $this->bean->contact_email;
                                $button = "<input class='button' type='button'  value='$value_button'  id=''  name=''   title='$title_button' onclick=\"location.href='mailto:$to_addrs';return false;\" />";
                        }
                        else{
                                $button = "<input class='button' type='button'  value='$value_button'  id=''  name=''  title='$title_button' onclick=\"location.href='mailto:';return false;\" />";
                        }
                } else {

                    //Generate the compose package for the quick create options.
                    $composeData = array(
                            "to_email_addrs" => $this->bean->contact_email,
                            "parent_id"      => $parent_id, 
                            "parent_type"    => $parent_type,
                            "parent_name"    => $parent_name);
                    
                    if (!empty($this->bean->tilk_url)) {
                        $composeData['body'] = "<a href='".$this->bean->tilk_url."'>".$this->bean->tilk_url."</a>";
                    }

                    require_once('modules/Emails/EmailUI.php');
                    $eUi = new EmailUI();
                    $j_quickComposeOptions = $eUi->generateComposePackageForQuickCreate($composeData, http_build_query($composeData), false);

                    $button = "<input title='$title_button'  id=''  onclick='SUGAR.quickCompose.init($j_quickComposeOptions);' class='button' type='submit' name='_button' value='$value_button' />";
                }
            }
            
            $this->ss->assign("SEND_EMAIL_BUTTON", $button);     

            // BUILD COPY TO CLIPBOARD BUTTON
            $button_copy = "<button id='copy-button' data-clipboard-text='".$this->bean->tilk_url."' title='Click to copy me.'>".$mod_strings['LBL_COPY_VALUE']."</button>";
            
            $this->ss->assign("COPY_TILK_URL", $button_copy);     
            
            
            parent::display();
            
        }
}
