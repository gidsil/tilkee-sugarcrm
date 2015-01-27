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
    ),
    'advanced_search' => 
    array (
      'device' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DEVICE',
        'width' => '10%',
        'default' => true,
        'name' => 'device',
      ),
      'browser' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_BROWSER',
        'width' => '10%',
        'default' => true,
        'name' => 'browser',
      ),
      'plateform' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_PLATEFORM',
        'width' => '10%',
        'default' => true,
        'name' => 'plateform',
      ),
      'os' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_OS',
        'width' => '10%',
        'default' => true,
        'name' => 'os',
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
