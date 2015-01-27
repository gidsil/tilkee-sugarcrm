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

class SugarWidgetSubPanelArchivedLostButton extends SugarWidgetField
{
    function displayList(&$layout_def)
    {
        global $app_strings, $mod_strings;
        global $subpanel_item_count;
        
        $return_module = $_REQUEST['module'];
        $return_id     = $_REQUEST['record'];
        $module_name   = $layout_def['module'];
        $record_id     = $layout_def['fields']['ID'];
        $unique_id     = $layout_def['subpanel_id']."_lost_".$subpanel_item_count; //bug 51512

        
        if ($layout_def['EditView']) {
            $html .= "<a id=\"$unique_id\" onclick='Archived(\"$module_name\",\"$record_id\",\"{$layout_def['subpanel_id']}\",\"archived_lost\");' >".$mod_strings['LBL_LOST_TITLE']."</a>";
            return $html;
        } else {
            return '';
        }

    }
}

?>
