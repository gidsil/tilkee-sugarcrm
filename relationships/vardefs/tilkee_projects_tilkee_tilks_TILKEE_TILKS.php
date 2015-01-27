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

$dictionary["TILKEE_TILKS"]["fields"]["tilkee_projects_tilkee_tilks"] = array (
  'name' => 'tilkee_projects_tilkee_tilks',
  'type' => 'link',
  'relationship' => 'tilkee_projects_tilkee_tilks',
  'source' => 'non-db',
  'module' => 'TILKEE_PROJECTS',
  'bean_name' => false,
  'vname' => 'LBL_TILKEE_PROJECTS_TILKEE_TILKS_FROM_TILKEE_PROJECTS_TITLE',
  'id_name' => 'tilkee_projects_id',
);
$dictionary["TILKEE_TILKS"]["fields"]["tilkee_projects_name"] = array (
  'name' => 'tilkee_projects_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TILKEE_PROJECTS_TILKEE_TILKS_FROM_TILKEE_PROJECTS_TITLE',
  'save' => true,
  'id_name' => 'tilkee_projects_id',
  'link' => 'tilkee_projects_tilkee_tilks',
  'table' => 'tilkee_projects',
  'module' => 'TILKEE_PROJECTS',
  'rname' => 'name',
);
$dictionary["TILKEE_TILKS"]["fields"]["tilkee_projects_id"] = array (
  'name' => 'tilkee_projects_id',
  'type' => 'link',
  'relationship' => 'tilkee_projects_tilkee_tilks',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TILKEE_PROJECTS_TILKEE_TILKS_FROM_TILKEE_TILKS_TITLE',
);
