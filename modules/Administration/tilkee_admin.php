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

//
// Add TILKEE paragraph and TILKEE admin page to Sugar Admin Page
//

$admin_option_defs = array ();
$admin_option_defs['0_param'] = array (
   'TILKEE',
   'LBL_CONFIG_TITLE',
   'LBL_CONFIG_PARAM',
   './index.php?module=Administration&action=tilkee'
);    

$idx_cde = 0 ;
foreach ($admin_group_header as $idx => $grp) {
	if ($grp[0] == 'LBL_TILKEE')
		$idx_cde = $idx;
}
if ($idx_cde == 0) {
    $admin_group_header[] = array (
        'LBL_TILKEE',
        '',
        false,
        array("Administration" => $admin_option_defs),
        'LBL_TILKEE_DESC'
    );
} else {
    $admin_group_header[$idx_cde][3]['Administration']['0_param'] = 
        array (
            'TILKEE',
            'LBL_CONFIG_TITLE',
            'LBL_CONFIG_PARAM',
            './index.php?module=Administration&action=tilkee'
         );
}
ksort($admin_group_header[$idx_cde][3]['Administration']);