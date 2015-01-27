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

$dictionary["TILKEE_PROJECTS"]["fields"]["tilkee_projects_opportunities"] = array (
  'name' => 'tilkee_projects_opportunities',
  'type' => 'link',
  'relationship' => 'tilkee_projects_opportunities',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_TILKEE_PROJECTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_id',
);
$dictionary["TILKEE_PROJECTS"]["fields"]["opportunities_name"] = array (
  'name' => 'opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TILKEE_PROJECTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_id',
  'link' => 'tilkee_projects_opportunities',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["TILKEE_PROJECTS"]["fields"]["opportunities_id"] = array (
  'name' => 'opportunities_id',
  'type' => 'link',
  'relationship' => 'tilkee_projects_opportunities',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TILKEE_PROJECTS_OPPORTUNITIES_FROM_TILKEE_PROJECTS_TITLE',
);
