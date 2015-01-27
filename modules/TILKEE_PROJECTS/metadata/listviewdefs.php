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
$module_name = 'TILKEE_PROJECTS';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'TILKS_COUNT' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TILKS_COUNT',
    'width' => '10%',
    'default' => true,
  ),
  'ACCOUNTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_PROJECTS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_ID',
    'width' => '10%',
    'default' => true,
  ),
  'OPPORTUNITIES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_PROJECTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
    'id' => 'OPPORTUNITIES_ID',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'LEADER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LEADER',
    'width' => '10%',
    'default' => false,
  ),
  'LEADER_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_LEADER_ID',
    'width' => '10%',
    'default' => false,
  ),
  'WON' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_WON',
    'width' => '10%',
  ),
  'ACTIVE_TILK' => 
  array (
    'type' => 'int',
    'label' => 'LBL_ACTIVE_TILK',
    'width' => '10%',
    'default' => false,
  ),
  'TOTAL_CONNEXIONS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTAL_CONNEXIONS',
    'width' => '10%',
    'default' => false,
  ),
  'TOTAL_TIME' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTAL_TIME',
    'width' => '10%',
    'default' => false,
  ),
  'CREATED_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_CREATED_AT',
    'width' => '10%',
    'default' => false,
  ),
  'UPDATED_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_UPDATED_AT',
    'width' => '10%',
    'default' => false,
  ),
  'ACTIVATED_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_ACTIVATED_AT',
    'width' => '10%',
    'default' => false,
  ),
  'LAST_SIGN_IN_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LAST_SIGN_IN_AT',
    'width' => '10%',
    'default' => false,
  ),
  'ARCHIVED_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_ARCHIVED_AT',
    'width' => '10%',
    'default' => false,
  ),
  'VISIBLE_SINCE' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_VISIBLE_SINCE',
    'width' => '10%',
    'default' => false,
  ),
  'URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_URL',
    'width' => '10%',
    'default' => false,
  ),
  'PREVIEW_URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_PREVIEW_URL',
    'width' => '10%',
    'default' => false,
  ),
  'EDIT_URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_EDIT_URL',
    'width' => '10%',
    'default' => false,
  ),
  'STAT_URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_STAT_URL',
    'width' => '10%',
    'default' => false,
  ),
  'TILKEE_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TILKEE_ID',
    'width' => '10%',
    'default' => true,
  ), 
);
?>
