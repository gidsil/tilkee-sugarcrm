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

$dictionary["tilkee_projects_tilkee_tilks"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'tilkee_projects_tilkee_tilks' => 
    array (
      'lhs_module' => 'TILKEE_PROJECTS',
      'lhs_table' => 'tilkee_projects',
      'lhs_key' => 'id',
      'rhs_module' => 'TILKEE_TILKS',
      'rhs_table' => 'tilkee_tilks',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'tilkee_projects_tilkee_tilks',
      'join_key_lhs' => 'tilkee_projects_id',
      'join_key_rhs' => 'tilkee_tilks_id',
    ),
  ),
  'table' => 'tilkee_projects_tilkee_tilks',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'tilkee_projects_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'tilkee_tilks_id',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'tilkee_projects_tilkee_tilksspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'tilkee_projects_tilkee_tilks_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tilkee_projects_id',
      ),
    ),
    2 => 
    array (
      'name' => 'tilkee_projects_tilkee_tilks_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'tilkee_tilks_id',
      ),
    ),
  ),
);