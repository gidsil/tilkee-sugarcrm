<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

$module_name='TILKEE_PROJECTS';
$subpanel_layout = array(
    'top_buttons' => array(
            array('widget_class' => 'SubPanelTopCreateButton'),
    ),

    'where' => '',

    'list_fields' => array(
        'name'=>array(
                'vname' => 'LBL_NAME',
                'widget_class' => 'SubPanelDetailViewLink',
                'width' => '45%',
        ),
        'type'=>array(
                'vname' => 'LBL_TYPE',
                'width' => '15%',
        ),
        'status'=>array(
                'vname' => 'LBL_STATUS',
                'width' => '15%',
        ),
        'won'=>array(
                'vname' => 'LBL_WON',
                'width' => '15%',
        ),
        'updated_at'=>array(
                'vname' => 'LBL_UPDATED_AT',
                'width' => '15%',
        ),
        'tilks_count'=>array(
                'vname' => 'LBL_TILKS_COUNT',
                'width' => '5%',
        ),
        'created_at'=>array(
                'vname' => 'LBL_CREATED_AT',
                'width' => '15%',
        ),
        'edit_button'=>array(
                'vname' => 'LBL_EDIT_BUTTON',
                'widget_class' => 'SubPanelEditButton',
                'module' => $module_name,
                'width' => '4%',
        ),
    ),
);

?>