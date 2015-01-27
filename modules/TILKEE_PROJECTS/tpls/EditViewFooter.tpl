<!--
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
-->

<div id='TilkeewDiv' style='width:100%' class="doNotPrint">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formHeader h3Row">
        <tbody>
            <tr>
                <td nowrap="">
                    <h3>
                        <a name="tilkee"> </a>
                        {if $fields.status.value=='archived'}                        
                        <span id="show_link_tilkee" style="display:">
                        {else}
                        <span id="show_link_tilkee" style="display: none">
                        {/if}
                            <a class="utilsLink" href="#" onclick="current_child_field = 'tilkee';markSubPanelLoaded('tilkee');showSubPanel('tilkee',null,null,'tilkee');document.getElementById('show_link_tilkee').style.display='none';document.getElementById('hide_link_tilkee').style.display='';return false;">{sugar_getimage name='advanced_search' attr='border="0" align="absmiddle"' ext='.gif' alt=$APP.LBL_SHOW }</a>
                        </span>
                        {if $fields.status.value=='archived'}                        
                        <span id="hide_link_tilkee" style="display: none">
                        {else}
                        <span id="hide_link_tilkee" style="display:">
                        {/if}
                            <a class="utilsLink" href="#" onclick="hideSubPanel('tilkee');document.getElementById('hide_link_tilkee').style.display='none';document.getElementById('show_link_tilkee').style.display='';return false;">{sugar_getimage name='basic_search' attr='border="0" align="absmiddle"' ext='.gif' alt=$APP.LBL_HIDE }</a>
                        </span>
                        <span>{$MOD.IFRAME_EDIT}</span>
                    </h3>
                </td>
                <td width="100%" valign="middle" nowrap="">
                </td>
            </tr>
        </tbody>
    </table>
    {if $fields.status.value=='archived'}
    <div id='subpanel_tilkee' style='width: 100%; display: none;' align="center">      
    {else}
    <div id='subpanel_tilkee' style='width: 100%;' align="center">      
    {/if}
        <iframe id='TilkeeFrame' src='{$EDIT_URL}' title='{$fields.name.value}' scrolling="auto" style='border:0px; width:100%;height:450px;overflow:hidden;'></iframe>
    </div>
</div>
