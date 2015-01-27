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

$dictionary["TILKEE_CONNEXIONS"]["fields"]["tilkee_tilks_tilkee_connexions"] = array (
  'name' => 'tilkee_tilks_tilkee_connexions',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_tilkee_connexions',
  'source' => 'non-db',
  'module' => 'TILKEE_TILKS',
  'bean_name' => false,
  'vname' => 'LBL_TILKEE_TILKS_TILKEE_CONNEXIONS_FROM_TILKEE_TILKS_TITLE',
  'id_name' => 'tilkee_tilks_id',
);
$dictionary["TILKEE_CONNEXIONS"]["fields"]["tilkee_tilks_name"] = array (
  'name' => 'tilkee_tilks_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TILKEE_TILKS_TILKEE_CONNEXIONS_FROM_TILKEE_TILKS_TITLE',
  'save' => true,
  'id_name' => 'tilkee_tilks_id',
  'link' => 'tilkee_tilks_tilkee_connexions',
  'table' => 'tilkee_tilks',
  'module' => 'TILKEE_TILKS',
  'rname' => 'name',
);
$dictionary["TILKEE_CONNEXIONS"]["fields"]["tilkee_tilks_id"] = array (
  'name' => 'tilkee_tilks_id',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_tilkee_connexions',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TILKEE_TILKS_TILKEE_CONNEXIONS_FROM_TILKEE_CONNEXIONS_TITLE',
);
