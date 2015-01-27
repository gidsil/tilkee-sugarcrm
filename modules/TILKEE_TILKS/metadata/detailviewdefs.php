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
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          //0 => 'EDIT',
          //1 => 'DUPLICATE',
          0 => 'DELETE',
          //3 => 'FIND_DUPLICATES',
          1 => array(
                'customCode' => '{$SEND_EMAIL_BUTTON}'
                ),
          2 => array(
                'customCode' => '{$COPY_TILK_URL}'
                ),
          3 => array(
                'customCode' => '<input title="{$MOD.LBL_WON_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_TILKS\';
                this.form.action.value=\'archived_won\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_WON_LABEL}">'
                ),
          4 => array(
                'customCode' => '<input title="{$MOD.LBL_LOST_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_TILKS\';
                this.form.action.value=\'archived_lost\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_LOST_LABEL}">'
                ),
          5 => array(
                'customCode' => '<input title="{$MOD.LBL_ARCHIVED_TITLE}" class="button"
                onclick="this.form.module.value=\'TILKEE_TILKS\';
                this.form.action.value=\'archived\';
                this.form.record.value=\'{$fields.id.value}\';"
                type="submit"
                name="mon_action_button"
                value="{$MOD.LBL_ARCHIVED_LABEL}">'
                ),
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
      'includes' =>
      array (
		0 =>
        array (
          'file' => 'custom/include/ZeroClipboard/ZeroClipboard.js',
        ),
		1 =>
		array (
		  'file' => 'modules/TILKEE_TILKS/KeyboardCopy.js',
		),
      ),
        'javascript' => 'ZeroClipboard.config( {literal}{{/literal} swfPath: "{$sugar_config.site_url}/custom/include/ZeroClipboard/ZeroClipboard.swf" {literal}}{/literal} );',
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
          'name' => 'tilkee_projects_name',
        ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_name',
          ),
          1 => 
        array (
          'name' => 'tilk_url',
          'label' => 'LBL_TILK_URL',
        ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'leads_name',
          ),
          1 => 
        array (
          'name' => 'contact_email',
          'label' => 'LBL_CONTACT_EMAIL',
        ),
        ),
        4 => 
        array (
          0 => 
        array (
          'name' => 'total_connexion',
          'label' => 'LBL_TOTAL_CONNEXION',
        ),          
          1 =>
        array (
          'name' => 'last_sign_in_at',
          'label' => 'LBL_LAST_SIGN_IN_AT',
        ),
        ),
        1 => 
        array (
          0 => 
                array (
                  'name' => 'total_time',
                  'label' => 'LBL_TOTAL_TIME',
                ),
          1 => '',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'archived',
            'label' => 'LBL_ARCHIVED',
          ),
          1 => 
          array (
            'name' => 'archived_at',
            'label' => 'LBL_ARCHIVED_AT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'won',
            'studio' => 'visible',
            'label' => 'LBL_WON',
          ),
          1 => 
            array (
              'name' => 'created_at',
              'label' => 'LBL_CREATED_AT',
              'customCode' => '{$fields.created_at.value}',
            ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'tilkee_id',
            'label' => 'LBL_TILKEE_ID',
          ),
        ),
      ),
    ),
  ),
);
?>
