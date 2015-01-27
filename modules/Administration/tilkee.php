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

global $current_user, $sugar_config;
if (!is_admin($current_user)) sugar_die("Unauthorized access to administration.");

require_once('modules/Configurator/Configurator.php');


echo getClassicModuleTitle(
        "Administration",
        array(
            "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
           $mod_strings['LBL_CONFIG_TITLE'],
           ),
        false
        );

$cfg		= new Configurator();
$sugar_smarty	= new Sugar_Smarty();
$errors		= array();


///////////////////////////////////////////////////////////////////////////////
////	HANDLE CHANGES
$display_result = '' ;
$display_title	= '' ;

if(isset($_REQUEST['process']) && $_REQUEST['process'] == 'true') {
    require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
    $tilkee = new ExtAPITilkee();
    
    switch ($_REQUEST['test_action']) {
        case 'test_token':
            $result = $tilkee->get_token_access();
            $display_result = print_r($result, true);
            $display_title = "Token Test";
            break;
        case 'test_connexion':
            $result = $tilkee->init_tilkee_access_eapm();
            $display_result = print_r($result, true);
            $display_title = "Connection Test";
            break;
        case 'infos_project':
            if ($_REQUEST['project_id_infos_project'] != '') {
                $result = $tilkee->infos_project($_REQUEST['project_id_infos_project']);
                $display_result = print_r($result, true);
                $display_title = "Infos Project";
            }
            break;
        case 'create_project':
            if ($_REQUEST['project_name_create'] != '') {

                $result = $tilkee->create_project($_REQUEST['project_name_create']);
                $display_result = print_r($result, true);
                $display_title = "Create Project";
            }
            break;
        case 'update_project':
            if ($_REQUEST['project_id_update'] != '') {
                $result = $tilkee->update_project($_REQUEST['project_id_update'],$_REQUEST['project_name_update'],$_REQUEST['project_kind'],$_REQUEST['project_won'],$_REQUEST['project_archived']);
                $display_result = print_r($result, true);
                $display_title = "Update Project";
            }
            break;

        case 'delete_project':
            if ($_REQUEST['project_id_delete'] != '') {
                $result = $tilkee->delete_project($_REQUEST['project_id_delete']);
                $display_result = print_r($result, true);
                $display_title = "Delete Project";
            }
            break;
        case 'infos_tilk':
            if (($_REQUEST['project_id_infos_tilk'] != '') && ($_REQUEST['tilk_id_infos_tilk'] != '')){

                $result = $tilkee->infos_tilk($_REQUEST['project_id_infos_tilk'], $_REQUEST['tilk_id_infos_tilk']);
                $display_result = print_r($result, true);
                $display_title = "Infos Tillk";
            }
            break;
        case 'create_tilk':
            if ($_REQUEST['project_id_create_tilk'] != '') {

                $result = $tilkee->create_tilk($_REQUEST['project_id_create_tilk'], $_REQUEST['tilk_name_create']);
                $display_result = print_r($result, true);
                $display_title = "Create Tillk";
            }
            break;
        case 'update_tilk':
            if (($_REQUEST['project_id_update_tilk'] != '') && ($_REQUEST['tilk_id_update_tilk'] != '')){

                $result = $tilkee->update_tilk($_REQUEST['project_id_update_tilk'], $_REQUEST['tilk_id_update_tilk'], $_REQUEST['tilk_name_update'], $_REQUEST['tilk_won'], $_REQUEST['tilk_archived']);
                $display_result = print_r($result, true);
                $display_title = "Update Tillk";
            }
            break;

        default:
            break;
    }
        
    /* 
     * Update admini parameters
     */
    if (isset($_REQUEST['url_tilkee'])) {
        $cfg->config['tilkee']['url_tilkee'] = $_REQUEST['url_tilkee'] ;        
    }
    if (isset($_REQUEST['user_scheduler'])) {
        $cfg->config['tilkee']['user_scheduler'] = $_REQUEST['user_scheduler'] ;        
    }
    if (isset($_REQUEST['client_id'])) {
        $cfg->config['tilkee']['client_id'] = $_REQUEST['client_id'] ;                
    }
    
    $cfg->handleOverride();
    //header('Location: index.php?module=Administration&action=index');
}


///////////////////////////////////////////////////////////////////////////////
////	PAGE OUTPUT
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('LANGUAGES', get_languages());
$sugar_smarty->assign("JAVASCRIPT",get_set_focus_js());
$sugar_smarty->assign('config', $sugar_config);
$sugar_smarty->assign('error', $errors);

$sugar_smarty->assign('DISPLAY_RESULT', $display_result);
$sugar_smarty->assign('DISPLAY_TITLE', $display_title);

$sugar_smarty->assign('URL_TILKEE', $cfg->config['tilkee']['url_tilkee']);
$sugar_smarty->assign('TILKEE_CLIENT_ID', $cfg->config['tilkee']['client_id']);
// Scheduler users dropbox
$users_array = get_bean_select_array(false, 'User','user_name', ' users.status="Active" AND users.deleted=0 ','user_name',false);
$SELECT_USER_SCHEDULER = get_select_options_with_id($users_array, $cfg->config['tilkee']['user_scheduler']);
$sugar_smarty->assign('SELECT_USER_SCHEDULER', $SELECT_USER_SCHEDULER);


$sugar_smarty->assign('project_id_infos_project', $_REQUEST['project_id_infos_project']);
$sugar_smarty->assign('project_name_create', $_REQUEST['project_name_create']);
$sugar_smarty->assign('project_id_delete', $_REQUEST['project_id_delete']);
$sugar_smarty->assign('project_id_update', $_REQUEST['project_id_update']);
$sugar_smarty->assign('project_name_update', $_REQUEST['project_name_update']);
$sugar_smarty->assign('project_id_infos_tilk', $_REQUEST['project_id_infos_tilk']);
$sugar_smarty->assign('tilk_id_infos_tilk', $_REQUEST['tilk_id_infos_tilk']);
$sugar_smarty->assign('project_id_create_tilk', $_REQUEST['project_id_create_tilk']);
$sugar_smarty->assign('tilk_name_create', $_REQUEST['tilk_name_create']);
$sugar_smarty->assign('project_id_update_tilk', $_REQUEST['project_id_update_tilk']);
$sugar_smarty->assign('tilk_id_update_tilk', $_REQUEST['tilk_id_update_tilk']);
$sugar_smarty->assign('tilk_name_update', $_REQUEST['tilk_name_update']);

$SELECT_KIND = get_select_options_with_id($app_list_strings['type_list'], '');
$sugar_smarty->assign('SELECT_KIND', $SELECT_KIND);

$SELECT_WON_ARCHIVED = get_select_options_with_id($app_list_strings['won_archived_list'], '');
$sugar_smarty->assign('SELECT_WON_ARCHIVED', $SELECT_WON_ARCHIVED);

$sugar_smarty->display('custom/modules/Administration/tilkee.tpl');

?>