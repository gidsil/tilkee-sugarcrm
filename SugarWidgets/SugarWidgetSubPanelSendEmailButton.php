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

class SugarWidgetSubPanelSendEmailButton extends SugarWidgetField
{
    function displayList(&$layout_def)
    {
        global $current_user;
        global $beanList;
        global $focus;
        global $sugar_config;
        global $locale;
        global $mod_strings;

        if(isset($layout_def['varname'])) {
                $key = strtoupper($layout_def['varname']);
        } else {
                $key = $this->_get_column_alias($layout_def);
                $key = strtoupper($key);
        }
        $value = $layout_def['fields'][$key];

        if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];
        else $action = '';

        if(isset($_REQUEST['module'])) $module = $_REQUEST['module'];
        else $module = '';

        if(isset($_REQUEST['record'])) $record = $_REQUEST['record'];
        else $record = '';

        if (!empty($focus->name)) {
            $name = $focus->name;
        }

        $userPref = $current_user->getPreference('email_link_type');
        $defaultPref = $sugar_config['email_default_client'];
        if($userPref != '') {
                $client = $userPref;
        } else {
                $client = $defaultPref;
        }

        if($client == 'sugar')
        {
            $composeData = array(
                'load_id'       => $layout_def['fields']['ID'],
                'load_module'   => $this->layout_manager->defs['module_name'],
                'return_module' => $module,
                'return_action' => $action,
                'return_id'     => $record
            );
            
            if (!empty($layout_def['fields']['CONTACTS_NAME'])) {
                $composeData['parent_name'] = $layout_def['fields']['CONTACTS_NAME'];
                $composeData['parent_id']   = $layout_def['fields']['CONTACTS_ID'];
                $composeData['parent_type'] = 'Contacts';
            }
            if (!empty($layout_def['fields']['LEADS_NAME'])) {
                $composeData['parent_name'] = $layout_def['fields']['LEADS_NAME'];
                $composeData['parent_id']   = $layout_def['fields']['LEADS_ID'];
                $composeData['parent_type'] = 'Leads';
            }
            
            $composeData['to_email_addrs']  = $layout_def['fields']['CONTACT_EMAIL'];
            
            if (!empty($layout_def['fields']['TILK_URL'])) {
                $composeData['body'] = "<a href='".$layout_def['fields']['TILK_URL']."'>".$layout_def['fields']['TILK_URL']."</a>";
            }
            
            require_once('modules/Emails/EmailUI.php');
            $eUi = new EmailUI();
            $j_quickComposeOptions = $eUi->generateComposePackageForQuickCreate($composeData, http_build_query($composeData), true);

            $link = "<a onclick='SUGAR.quickCompose.init($j_quickComposeOptions);'>";
        } else {
            $link = '<a href="mailto:' . $value .'" >';
        }

        return $link.$mod_strings['LBL_SEND_MAIL_TITLE'].'</a>';
    }
}

?>
