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

$module_name='TILKEE_CONNEXIONS';
$subpanel_layout = array(
	'top_buttons' => array(
	),

	'where' => '',

	'list_fields' => array(
		'device'=>array(
	 		'vname' => 'LBL_DEVICE',
	 		'width' => '10%',
		),
		'browser'=>array(
	 		'vname' => 'LBL_BROWSER',
	 		'width' => '10%',
		),
		'os'=>array(
	 		'vname' => 'LBL_OS',
	 		'width' => '10%',
		),
		'ip_address'=>array(
	 		'vname' => 'LBL_IP_ADDRESS',
	 		'width' => '10%',
		),
		'access_date'=>array(
	 		'vname' => 'LBL_ACCESS_DATE',
	 		'width' => '10%',
		),
		'total_time'=>array(
	 		'vname' => 'LBL_TOTAL_TIME',
	 		'width' => '10%',
		),
		'downloads'=>array(
	 		'vname' => 'LBL_DOWNLOADS',
	 		'width' => '10%',
		),
	),
);

?>