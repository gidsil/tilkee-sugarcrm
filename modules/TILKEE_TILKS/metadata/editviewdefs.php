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

$module_name = 'TILKEE_TILKS';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
        'includes' => 
        array (
          0 => 
          array (
            'file' => 'modules/TILKEE_TILKS/TilkEdit.js',
          ),
        ),
     'javascript' => '<script>                    
                    var lbl_error_contact_lead = \'{$MOD.LBL_ERROR_CONTACT_LEAD}\';
                    </script>',        
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
            'name' => 'contacts_name',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'tilkee_projects_name',
            'displayParams' =>
               array (
                'required' => true,
               ),            
          ),            
          1 =>
          array (
            'name' => 'leads_name',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'contact_email',
            'label' => 'LBL_CONTACT_EMAIL',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
