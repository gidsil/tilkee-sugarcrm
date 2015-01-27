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
require_once('include/generic/SugarWidgets/SugarWidgetSubPanelTopButton.php');

class SugarWidgetSubPanelTopCreateTilkeeProjectFromOpportunity extends SugarWidgetSubPanelTopButton
{
	function SugarWidgetSubPanelTopCreateTilkeeProjectFromOpportunity($module='', $title='', $access_key='', $form_value='')
	{
            global $app_strings;
            
            $this->form_value = $app_strings['LBL_CREATE_BUTTON_LABEL'];
            parent::SugarWidgetSubPanelTopButton($this->module, $this->title, $this->access_key, $this->form_value);
        }
        
	function display(&$widget_data)
	{
            global $app_strings, $beanFiles;
            $initial_filter = '';

            // REDIRECTE TO EDIT VIEW OF IT
            global $app_strings,$current_user,$sugar_config,$beanList,$beanFiles;
            $button = "<form action='index.php?module=TILKEE_PROJECTS' method='POST'>";
            $button .= "<input class='button' type='submit'  value='$this->form_value'  name='$this->title'  accesskey='$this->accesskey' title='$this->title' />";
            $button .= '<input type="hidden" name="action" value="EditView"/>
                                    <input type="hidden" name="module" value="TILKEE_PROJECTS"/>
                                    <input type="hidden" name="record" value="" />
                                    <input type="hidden" name="return_id" value="'.$_REQUEST['record'].'"/>
                                    <input type="hidden" name="return_module" value="Opportunities"/>
                                    <input type="hidden" name="return_action" value="DetailView" />
                                    <input type="hidden" name="CreateFromOpp" value="true" />
                                    </form>';

            return $button;
	}
        

}
?>