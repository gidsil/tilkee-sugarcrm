<?php
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

$manifest = array (
  0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      0 => '6.5.*',
    ),
  ),
  1 => 
  array (
    'acceptable_sugar_flavors' => 
    array (
      0 => 'CE',
      1 => 'PRO',
      2 => 'ENT',
      3 => 'ULT',
    ),
  ),
  'readme' => '',
  'key' => 'NEOARNO',
  'author' => 'NEOARNO',
  'description' => 'Tilkee Connector for SugarCRM',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'TILKEE Connector',
  'published_date' => '2014-09-18 00:00:00',
  'type' => 'module',
  'version' => '1.0.5',
  'remove_tables' => 'prompt',
);

$installdefs = array (
    'id' => 'NEO_TILKEE',

    'entrypoints' => array (
        array (
            'from' => '<basepath>/entrypoints/tilkee_entrypoint_registry.php',
            'to_module' => 'application',
        ),
    ),
    
    'scheduledefs' => array (
        array (
            'from' => '<basepath>/modules/Schedulers/Scheduled_syncTILKEE.php',
        ),
    ), 
    
    'pre_execute'=>array(
        0 => '<basepath>/scripts/pre_execute_script.php',
    ),
    'post_execute'=>array(
        0 => '<basepath>/scripts/post_execute_script.php',
    ),
    'pre_uninstall'=>array(
        0 => '<basepath>/scripts/pre_uninstall_script.php',
    ),
    'post_uninstall'=>array(
        0 => '<basepath>/scripts/post_uninstall_script.php',
    ),

    'beans' => 
    array (
      array (
        'module' => 'TILKEE_PROJECTS',
        'class'  => 'TILKEE_PROJECTS',
        'path'   => 'modules/TILKEE_PROJECTS/TILKEE_PROJECTS.php',
        'tab'    => true,
      ),
      array (
        'module' => 'TILKEE_TILKS',
        'class'  => 'TILKEE_TILKS',
        'path'   => 'modules/TILKEE_TILKS/TILKEE_TILKS.php',
        'tab'    => false,
      ),
      array (
        'module' => 'TILKEE_CONNEXIONS',
        'class'  => 'TILKEE_CONNEXIONS',
        'path'   => 'modules/TILKEE_CONNEXIONS/TILKEE_CONNEXIONS.php',
        'tab'    => false,
      ),
    ),

    'logic_hooks' => array(  
        array(
        'module' => 'Opportunities',
        'hook' => 'after_save',
        'order' => '',
        'description' => 'Update linked projects when opportunity closed',
        'file' => 'modules/TILKEE_PROJECTS/hooks.php',
        'class' => 'hook_tilkee_projects',
        'function' => 'update_project_from_opportunity',
        ),        
        array(
        'module' => 'TILKEE_PROJECTS',
        'hook' => 'before_save',
        'order' => '',
        'description' => 'Update Project Infos',
        'file' => 'modules/TILKEE_PROJECTS/hooks.php',
        'class' => 'hook_tilkee_projects',
        'function' => 'update_tilkee_project',
        ),        
        array(
        'module' => 'TILKEE_PROJECTS',
        'hook' => 'after_save',
        'order' => '',
        'description' => 'Update Project Infos',
        'file' => 'modules/TILKEE_PROJECTS/hooks.php',
        'class' => 'hook_tilkee_projects',
        'function' => 'update_tilkee_project_API',
        ),        
        array(
        'module' => 'TILKEE_PROJECTS',
        'hook' => 'before_delete',
        'order' => '',
        'description' => 'Delete TILKEE Project',
        'file' => 'modules/TILKEE_PROJECTS/hooks.php',
        'class' => 'hook_tilkee_projects',
        'function' => 'delete_tilkee_project',
        ),        
        array(
        'module' => 'TILKEE_TILKS',
        'hook' => 'before_delete',
        'order' => '',
        'description' => 'Delete TILKEE TILK',
        'file' => 'modules/TILKEE_TILKS/hooks.php',
        'class' => 'hook_tilkee_tilks',
        'function' => 'delete_tilkee_tilk',
        ),        
        array(
        'module' => 'TILKEE_TILKS',
        'hook' => 'before_save',
        'order' => '',
        'description' => 'Update TILKEE TILK',
        'file' => 'modules/TILKEE_TILKS/hooks.php',
        'class' => 'hook_tilkee_tilks',
        'function' => 'update_tilkee_tilk',
        ),        
        array(
        'module' => 'TILKEE_TILKS',
        'hook' => 'after_save',
        'order' => '',
        'description' => 'Update TILKEE TILK with API',
        'file' => 'modules/TILKEE_TILKS/hooks.php',
        'class' => 'hook_tilkee_tilks',
        'function' => 'update_tilkee_tilk_API',
        ),        
    ),
    
    'relationships' => 
    array (
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_tilks_contactsMetaData.php',
      ),
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_tilks_leadsMetaData.php',
      ),
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_tilks_tilkee_connexionsMetaData.php',
      ),
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_projects_accountsMetaData.php',
      ),
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_projects_opportunitiesMetaData.php',
      ),
      array (
        'meta_data' => '<basepath>/relationships/relationships/tilkee_projects_tilkee_tilksMetaData.php',
      ),
    ),


    'layoutdefs' => 
    array (
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_projects_accounts_Accounts.php',
        'to_module' => 'Accounts',
      ),
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_projects_opportunities_Opportunities.php',
        'to_module' => 'Opportunities',
      ),
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_projects_tilkee_tilks_TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
      ),
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_tilks_contacts_Contacts.php',
        'to_module' => 'Contacts',
      ),
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_tilks_leads_Leads.php',
        'to_module' => 'Leads',
      ),
      array (
        'from' => '<basepath>/relationships/layoutdefs/tilkee_tilks_tilkee_connexions_TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
      ),
    ),    

    'administration' => array (
        array(
            'from' => '<basepath>/modules/Administration/tilkee_admin.php',
        ),
    ),
    
    'image_dir' => '<basepath>/icons',
    
    // Copy External API
    'copy' => array (
        array (
          'from' => '<basepath>/modules/TILKEE_PROJECTS',
          'to' => 'modules/TILKEE_PROJECTS',
        ),
        array (
          'from' => '<basepath>/modules/TILKEE_TILKS',
          'to' => 'modules/TILKEE_TILKS',
        ),
        array (
          'from' => '<basepath>/modules/TILKEE_CONNEXIONS',
          'to' => 'modules/TILKEE_CONNEXIONS',
        ),
        array (
          'from' => '<basepath>/modules/Administration/tilkee.php',
          'to' => 'custom/modules/Administration/tilkee.php',
        ),
        array (
          'from' => '<basepath>/modules/Administration/tilkee.tpl',
          'to' => 'custom/modules/Administration/tilkee.tpl',
        ),
        array (
          'from' => '<basepath>/connector/tilkee/externalAPI',
          'to' => 'custom/include/externalAPI/Tilkee',
        ),
        array (
          'from' => '<basepath>/SugarWidgets',
          'to' => 'custom/include/generic/SugarWidgets',
        ),
        array (
          'from' => '<basepath>/ZeroClipboard',
          'to' => 'custom/include/ZeroClipboard',
        ),
        array (
            'from' => '<basepath>/entrypoints/retour_token.php',
            'to' => 'custom/entrypoints/retour_token.php',
        ),        
        array (
            'from' => '<basepath>/files/retourToken.php',
            'to' => 'retourToken.php',
        ),        
    ),
    
    'language' => 
    array (
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/Contacts.php',
        'to_module' => 'Contacts',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/Contacts.php',
        'to_module' => 'Contacts',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/Leads.php',
        'to_module' => 'Leads',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/Leads.php',
        'to_module' => 'Leads',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_CONNEXIONS.php',
        'to_module' => 'TILKEE_CONNEXIONS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_CONNEXIONS.php',
        'to_module' => 'TILKEE_CONNEXIONS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/Accounts.php',
        'to_module' => 'Accounts',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/Accounts.php',
        'to_module' => 'Accounts',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/Opportunities.php',
        'to_module' => 'Opportunities',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/Opportunities.php',
        'to_module' => 'Opportunities',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_TILKS.php',
        'to_module' => 'TILKEE_TILKS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/relationships/language/TILKEE_PROJECTS.php',
        'to_module' => 'TILKEE_PROJECTS',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/modules/Administration/language/tilkee_admin.en_US.php',
        'to_module' => 'Administration',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/modules/Administration/language/tilkee_admin.fr_FR.php',
        'to_module' => 'Administration',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/modules/Schedulers/language/en_us.lang.php',
        'to_module' => 'Schedulers',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/modules/Schedulers/language/fr_FR.lang.php',
        'to_module' => 'Schedulers',
        'language' => 'fr_FR',
      ),
      array (
        'from' => '<basepath>/language/application/en_us.lang.php',
        'to_module' => 'application',
        'language' => 'en_us',
      ),
      array (
        'from' => '<basepath>/language/application/fr_FR.lang.php',
        'to_module' => 'application',
        'language' => 'fr_FR',
      ),
    ),    

    'vardefs' => 
      array (
        0 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_contacts_TILKEE_TILKS.php',
          'to_module' => 'TILKEE_TILKS',
        ),
        1 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_contacts_Contacts.php',
          'to_module' => 'Contacts',
        ),
        2 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_leads_TILKEE_TILKS.php',
          'to_module' => 'TILKEE_TILKS',
        ),
        3 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_leads_Leads.php',
          'to_module' => 'Leads',
        ),
        4 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_tilkee_connexions_TILKEE_CONNEXIONS.php',
          'to_module' => 'TILKEE_CONNEXIONS',
        ),
        5 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_tilks_tilkee_connexions_TILKEE_TILKS.php',
          'to_module' => 'TILKEE_TILKS',
        ),
        6 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_accounts_TILKEE_PROJECTS.php',
          'to_module' => 'TILKEE_PROJECTS',
        ),
        7 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_accounts_Accounts.php',
          'to_module' => 'Accounts',
        ),
        8 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_opportunities_TILKEE_PROJECTS.php',
          'to_module' => 'TILKEE_PROJECTS',
        ),
        9 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_opportunities_Opportunities.php',
          'to_module' => 'Opportunities',
        ),
        10 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_tilkee_tilks_TILKEE_TILKS.php',
          'to_module' => 'TILKEE_TILKS',
        ),
        11 => 
        array (
          'from' => '<basepath>/relationships/vardefs/tilkee_projects_tilkee_tilks_TILKEE_PROJECTS.php',
          'to_module' => 'TILKEE_PROJECTS',
        ),
      ), 
    
'custom_fields' => 
    array(
////////////// FIELD FOR USERS //////////////        
        array (
          'name' => 'tilkee_token_c',
          'label' => 'LBL_TILKEE_TOKEN',
          'comments' => NULL,
          'help' => NULL,
          'module' => 'Users',
          'type' => 'varchar',
          'max_size' => '255',
          'require_option' => '0',
          'default_value' => '',
          'audited' => '0',
          'mass_update' => '0',
          'duplicate_merge' => '0',
          'reportable' => '0',
          'importable' => 'false',
          'ext1' => NULL,
          'ext2' => NULL,
          'ext3' => NULL,
          'ext4' => NULL,
        ),
         array (
          'name' => 'tilkee_expires_c',
          'label' => 'LBL_TILKEE_EXPIRES',
          'comments' => NULL,
          'help' => NULL,
          'module' => 'Users',
          'type' => 'varchar',
          'max_size' => '255',
          'require_option' => '0',
          'default_value' => '',
          'audited' => '0',
          'mass_update' => '0',
          'duplicate_merge' => '0',
          'reportable' => '0',
          'importable' => 'false',
          'ext1' => NULL,
          'ext2' => NULL,
          'ext3' => NULL,
          'ext4' => NULL,
        ),
         array (
          'name' => 'tilkee_refresh_token_c',
          'label' => 'LBL_TILKEE_REFRESH_TOKEN',
          'comments' => NULL,
          'help' => NULL,
          'module' => 'Users',
          'type' => 'varchar',
          'max_size' => '255',
          'require_option' => '0',
          'default_value' => '',
          'audited' => '0',
          'mass_update' => '0',
          'duplicate_merge' => '0',
          'reportable' => '0',
          'importable' => 'false',
          'ext1' => NULL,
          'ext2' => NULL,
          'ext3' => NULL,
          'ext4' => NULL,
        ),
    ),
);
