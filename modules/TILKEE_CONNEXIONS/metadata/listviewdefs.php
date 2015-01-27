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

$module_name = 'TILKEE_CONNEXIONS';
$listViewDefs [$module_name] = 
array (
  'DEVICE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DEVICE',
    'width' => '10%',
    'default' => true,
  ),
  'PLATEFORM' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PLATEFORM',
    'width' => '10%',
    'default' => true,
  ),
  'OS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_OS',
    'width' => '10%',
    'default' => true,
  ),
  'BROWSER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_BROWSER',
    'width' => '10%',
    'default' => true,
  ),
  'IP_ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
  'ACCESS_DATE' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_ACCESS_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'TOTAL_TIME' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTAL_TIME',
    'width' => '10%',
    'default' => true,
  ),
  'DOWNLOADS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_DOWNLOADS',
    'width' => '10%',
    'default' => true,
  ),
  'TILKEE_TILKS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TILKEE_CONNEXIONS_TILKEE_TILKS_FROM_TILKEE_TILKS_TITLE',
    'id' => 'TILKEE_TILKS_ID',
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
  'CONNEXION_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_CONNEXION_ID',
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
);
?>
