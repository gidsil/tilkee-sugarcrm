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

$layout_defs["Leads"]["subpanel_setup"]['tilkee_tilks_leads'] = array (
  'order' => 100,
  'module' => 'TILKEE_TILKS',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_TILKEE_TILKS_LEADS_FROM_TILKEE_TILKS_TITLE',
  'get_subpanel_data' => 'tilkee_tilks_leads',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateTilkFromLead',
    ),
  ),
);
