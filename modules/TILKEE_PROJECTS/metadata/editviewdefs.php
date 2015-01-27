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
$module_name = 'TILKEE_PROJECTS';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'includes' =>
      array (
        0 =>
        array (
          'file' => 'include/SubPanel/SubPanelTiles.js',
        ),
      ),        
      'form' => 
      array (
        'footerTpl'=>'modules/TILKEE_PROJECTS/tpls/EditViewFooter.tpl',          
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
            'name' => 'type',
            'label' => 'LBL_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'accounts_name',
          ),
          1 => 
          array (
            'name' => 'opportunities_name',
          ),
        ),          
      ),
    ),
  ),
);
?>
