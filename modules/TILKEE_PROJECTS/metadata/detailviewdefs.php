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
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          //1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => array(
                'customCode' => '<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_PROJECTS\';
                this.form.action.value=\'duplicate\';
                this.form.record.value=\'{$fields.id.value}\';"

                type="submit"
                name="mon_action_button"
                value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}">'
                ),
          4 => array(
                'customCode' => '<input title="{$MOD.LBL_WON_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_PROJECTS\';
                this.form.action.value=\'archived_won\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_WON_LABEL}">'
                ),
          5 => array(
                'customCode' => '<input title="{$MOD.LBL_LOST_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_PROJECTS\';
                this.form.action.value=\'archived_lost\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_LOST_LABEL}">'
                ),
          6 => array(
                'customCode' => '<input title="{$MOD.LBL_ARCHIVED_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_PROJECTS\';
                this.form.action.value=\'archived\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_ARCHIVED_LABEL}">'
                ),
          7 => array(
                'customCode' => '<input title="{$MOD.LBL_DESARCHIVED_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_PROJECTS\';
                this.form.action.value=\'desarchived\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_DESARCHIVED_LABEL}">'
                ),
        ),
        'footerTpl'=>'modules/TILKEE_PROJECTS/tpls/DetailViewFooter.tpl',          
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
        'includes' => 
        array (
          0 => 
          array (
            'file' => 'modules/TILKEE_TILKS/TilkSubPanel.js',
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
            'name' => 'accounts_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'opportunities_name',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'leader',
            'label' => 'LBL_LEADER',
            'customCode' => '{$fields.leader.value} ({$fields.leader_id.value})',  
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'tilks_count',
            'label' => 'LBL_TILKS_COUNT',
          ),
          1 => 
          array (
            'name' => 'created_at',
            'label' => 'LBL_CREATED_AT',
            'customCode' => '{$fields.created_at.value}',              
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'active_tilk',
            'label' => 'LBL_ACTIVE_TILK',
          ),
          1 => 
          array (
            'name' => 'updated_at',
            'label' => 'LBL_UPDATED_AT',
            'customCode' => '{$fields.updated_at.value}',                            
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'total_connexions',
            'label' => 'LBL_TOTAL_CONNEXIONS',
          ),
          1 => 
          array (
            'name' => 'visible_since',
            'label' => 'LBL_VISIBLE_SINCE',
            'customCode' => '{$fields.visible_since.value}',                                          
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'total_time',
            'label' => 'LBL_TOTAL_TIME',
          ),
          1 => 
          array (
            'name' => 'last_sign_in_at',
            'label' => 'LBL_LAST_SIGN_IN_AT',
            'customCode' => '{$fields.last_sign_in_at.value}',                                                        
          ),
        ),
        8 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'activated_at',
            'label' => 'LBL_ACTIVATED_AT',
            'customCode' => '{$fields.activated_at.value}',                                                                      
          ),
        ),
        9 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'archived_at',
            'label' => 'LBL_ARCHIVED_AT',
            'customCode' => '{$fields.archived_at.value}',                                                                                    
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'tilkee_id',
            'label' => 'LBL_TILKEE_ID',
          ),
          1 => 
          array (
            'name' => 'url',
            'label' => 'LBL_URL',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'won',
            'studio' => 'visible',
            'label' => 'LBL_WON',
          ),
          1 => 
          array (
            'name' => 'preview_url',
            'label' => 'LBL_PREVIEW_URL',
            'customCode' => '<a href="{$PREVIEW_URL}" target="_blank">{$MOD.LBL_PREVIEW_LABEL}</a>',  
          ),
        ),
        12 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'edit_url',
            'label' => 'LBL_EDIT_URL',
          ),
        ),
        13 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'stat_url',
            'label' => 'LBL_STAT_URL',
          ),
        ),
      ),
    ),
  ),
);
?>
