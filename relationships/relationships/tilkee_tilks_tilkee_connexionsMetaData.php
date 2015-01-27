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

$dictionary["tilkee_tilks_tilkee_connexions"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'tilkee_tilks_tilkee_connexions' => 
    array (
      'lhs_module' => 'TILKEE_TILKS',
      'lhs_table' => 'tilkee_tilks',
      'lhs_key' => 'id',
      'rhs_module' => 'TILKEE_CONNEXIONS',
      'rhs_table' => 'tilkee_connexions',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'tilkee_tilks_tilkee_connexions',
      'join_key_lhs' => 'tilkee_tilks_id',
      'join_key_rhs' => 'tilkee_connexions_id',
    ),
  ),
  'table' => 'tilkee_tilks_tilkee_connexions',
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
      'name' => 'tilkee_tilks_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'tilkee_connexions_id',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'tilkee_tilks_tilkee_connexionsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'tilkee_tilks_tilkee_connexions_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tilkee_tilks_id',
      ),
    ),
    2 => 
    array (
      'name' => 'tilkee_tilks_tilkee_connexions_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'tilkee_connexions_id',
      ),
    ),
  ),
);