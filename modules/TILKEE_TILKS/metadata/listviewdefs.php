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
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TILK_URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_TILK_URL',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACT_EMAIL' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CONTACT_EMAIL',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_TILKS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_ID',
    'width' => '10%',
    'default' => true,
  ),
  'LEADS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_TILKS_LEADS_FROM_LEADS_TITLE',
    'id' => 'LEADS_ID',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACT_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TILKEEE_CONTACT_ID',
    'width' => '10%',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'TOTAL_TIME' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTAL_TIME',
    'width' => '10%',
    'default' => false,
  ),
  'TOTAL_CONNEXION' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTAL_CONNEXION',
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
  'WON' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_WON',
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
  'TILKEE_PROJECTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_TILKS_TILKEE_PROJECTS_FROM_TILKEE_PROJECTS_TITLE',
    'id' => 'TILKEE_PROJECTS_ID',
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
