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

$module_name='TILKEE_TILKS';
$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => $module_name),
	),

	'where' => '',

	'list_fields' => array(
		'name'=>array(
	 		'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
	 		'width' => '25%',
		),
		'won'=>array(
	 		'vname' => 'LBL_WON',
	 		'width' => '15%',
		),
		'contact_email'=>array(
	 		'vname' => 'LBL_CONTACT_EMAIL',
	 		'width' => '15%',
		),
		'tilk_url'=>array(
	 		'vname' => 'LBL_TILK_URL',
	 		'width' => '15%',
		),
		'total_connexion'=>array(
	 		'vname' => 'LBL_TOTAL_CONNEXION',
	 		'width' => '15%',
		),
		'last_sign_in_at'=>array(
	 		'vname' => 'LBL_LAST_SIGN_IN_AT',
	 		'width' => '15%',
		),
		'total_time'=>array(
	 		'vname' => 'LBL_TOTAL_TIME',
	 		'width' => '15%',
		),
		'contacts_name'=>array(
				'vname' => 'LBL_CONTACTS_NAME',
				'width' => '15%',
		),
		'leads_name'=>array(
				'vname' => 'LBL_LEADS_NAME',
				'width' => '15%',
		),
		'archived_won'=>array(
			'vname' => '',
			'widget_class' => 'SubPanelArchivedWonButton',
			'sortable'=>false,
			'width' => '5%',
		),
		'archived_lost'=>array(
			'vname' => '',
			'widget_class' => 'SubPanelArchivedLostButton',
			'sortable'=>false,
			'width' => '5%',
		),
		'send_email'=>array(
			'vname' => '',
			'widget_class' => 'SubPanelSendEmailButton',
			'sortable'=>false,
			'width' => '15%',
		),   
		'contacts_name'=>array(
			'usage' => 'query_only',
		),
		'contacts_id'=>array(
			'usage' => 'query_only',
		),
		'leads_name'=>array(
			'usage' => 'query_only',
		),
		'leads_id'=>array(
			'usage' => 'query_only',
		),
		         
	),
);

?>