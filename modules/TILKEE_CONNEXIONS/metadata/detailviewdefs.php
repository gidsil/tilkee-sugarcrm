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

$module_name = 'TILKEE_CONNEXIONS';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'connexion_id',
            'label' => 'LBL_CONNEXION_ID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'device',
            'label' => 'LBL_DEVICE',
          ),
          1 => 
          array (
            'name' => 'os',
            'label' => 'LBL_OS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'plateform',
            'label' => 'LBL_PLATEFORM',
          ),
          1 => 
          array (
            'name' => 'browser',
            'label' => 'LBL_BROWSER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'ip_address',
            'label' => 'LBL_IP_ADDRESS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'access_date',
            'label' => 'LBL_ACCESS_DATE',
          ),
          1 => 
          array (
            'name' => 'tilkee_tilks_name',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'total_time',
            'label' => 'LBL_TOTAL_TIME',
          ),
          1 => 
          array (
            'name' => 'downloads',
            'label' => 'LBL_DOWNLOADS',
          ),
        ),
      ),
    ),
  ),
);
?>
