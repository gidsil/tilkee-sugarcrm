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

$dictionary["tilkee_projects_accounts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'tilkee_projects_accounts' => 
    array (
      'lhs_module' => 'Accounts',
      'lhs_table' => 'accounts',
      'lhs_key' => 'id',
      'rhs_module' => 'TILKEE_PROJECTS',
      'rhs_table' => 'tilkee_projects',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'tilkee_projects_accounts',
      'join_key_lhs' => 'accounts_id',
      'join_key_rhs' => 'tilkee_projects_id',
    ),
  ),
  'table' => 'tilkee_projects_accounts',
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
      'name' => 'accounts_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'tilkee_projects_id',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'tilkee_projects_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'accounts_id1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'accounts_id',
      ),
    ),
    2 => 
    array (
      'name' => 'tilkee_projects_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'tilkee_projects_id',
      ),
    ),
  ),
);