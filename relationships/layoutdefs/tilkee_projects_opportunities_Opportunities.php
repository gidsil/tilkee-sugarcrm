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

$layout_defs["Opportunities"]["subpanel_setup"]['tilkee_projects_opportunities'] = array (
  'order' => 100,
  'module' => 'TILKEE_PROJECTS',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_TILKEE_PROJECTS_OPPORTUNITIES_FROM_TILKEE_PROJECTS_TITLE',
  'get_subpanel_data' => 'tilkee_projects_opportunities',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateTilkeeProjectFromOpportunity',
    ),
  ),
);
