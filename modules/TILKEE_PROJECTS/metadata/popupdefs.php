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

$module_name = 'TILKEE_PROJECTS';
$object_name = 'TILKEE_PROJECTS';
$_module_name = 'TILKEE_projects';
$popupMeta = array(
    'moduleMain' => $module_name,
    'varName' => $object_name,
    'orderBy' => $_module_name.'.name',
    'whereClauses' => array('name' => $_module_name . '.name'),
    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
);
?>
 
 