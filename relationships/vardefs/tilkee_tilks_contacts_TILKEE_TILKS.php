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

$dictionary["TILKEE_TILKS"]["fields"]["tilkee_tilks_contacts"] = array (
  'name' => 'tilkee_tilks_contacts',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_contacts',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_TILKEE_TILKS_CONTACTS_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_id',
);
$dictionary["TILKEE_TILKS"]["fields"]["contacts_name"] = array (
  'name' => 'contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TILKEE_TILKS_CONTACTS_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_id',
  'link' => 'tilkee_tilks_contacts',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["TILKEE_TILKS"]["fields"]["contacts_id"] = array (
  'name' => 'contacts_id',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TILKEE_TILKS_CONTACTS_FROM_TILKEE_TILKS_TITLE',
);
