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

$module_name = 'TILKEE_TILKS';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'won' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_WON',
        'width' => '10%',
        'default' => true,
        'name' => 'won',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'contacts_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_TILKEE_TILKS_CONTACTS_FROM_CONTACTS_TITLE',
        'id' => 'CONTACTS_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'contacts_name',
      ),
      'leads_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_TILKEE_TILKS_LEADS_FROM_LEADS_TITLE',
        'id' => 'LEADS_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'leads_name',
      ),
      'tilkee_projects_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_TILKEE_TILKS_TILKEE_PROJECTS_FROM_TILKEE_PROJECTS_TITLE',
        'id' => 'TILKEE_PROJECTS_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'tilkee_projects_name',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
