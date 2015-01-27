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

$dictionary["TILKEE_TILKS"]["fields"]["tilkee_tilks_leads"] = array (
  'name' => 'tilkee_tilks_leads',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_leads',
  'source' => 'non-db',
  'module' => 'Leads',
  'bean_name' => 'Lead',
  'vname' => 'LBL_TILKEE_TILKS_LEADS_FROM_LEADS_TITLE',
  'id_name' => 'leads_id',
);
$dictionary["TILKEE_TILKS"]["fields"]["leads_name"] = array (
  'name' => 'leads_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TILKEE_TILKS_LEADS_FROM_LEADS_TITLE',
  'save' => true,
  'id_name' => 'leads_id',
  'link' => 'tilkee_tilks_leads',
  'table' => 'leads',
  'module' => 'Leads',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["TILKEE_TILKS"]["fields"]["leads_id"] = array (
  'name' => 'leads_id',
  'type' => 'link',
  'relationship' => 'tilkee_tilks_leads',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TILKEE_TILKS_LEADS_FROM_TILKEE_TILKS_TITLE',
);
