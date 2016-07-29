{*

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
 
*}


<script type="text/javascript">
    var ERR_NO_SINGLE_QUOTE = '{$APP.ERR_NO_SINGLE_QUOTE}';
    var cannotEq = "{$APP.ERR_DECIMAL_SEP_EQ_THOUSANDS_SEP}";
{literal}
    function verify_data(formName) {
        var f = document.getElementById(formName);

        for(i=0; i<f.elements.length; i++) {
            if(f.elements[i].value == "'") {
                alert(ERR_NO_SINGLE_QUOTE + " " + f.elements[i].name);
                return false;
            }
        }
        // currency syntax
        if (document.ConfigureSettings.default_number_grouping_seperator.value == document.ConfigureSettings.default_decimal_seperator.value) {
            alert(cannotEq);
            return false;
        }
        return true;
    }
	
	
	function open_dialog() {	
		YAHOO.example.container.dialog1.show();
	}
	
	
	YAHOO.namespace("example.container");
	YAHOO.util.Event.onDOMReady(function () {
	
	
	     // Define various event handlers for Dialog
	     var handleSubmit = function() {
	          this.submit();
	     };
	     var handleCancel = function() {
	          this.cancel();
	     };
	     var handleSuccess = function(o) {
	          var response = o.responseText;
	          response = response.split("<!")[0];
	          document.getElementById("resp").innerHTML = response;
	     };
	     var handleFailure = function(o) {
	          alert("Erreur de soumission: " + o.status);
	     };
	
	
	     // Remove progressively enhanced content class, just before creating the module
	     YAHOO.util.Dom.removeClass("dialog1", "yui-pe-content");
	
	
	     // Instantiate the Dialog
	     YAHOO.example.container.dialog1 = new YAHOO.widget.Dialog("dialog1",
	          {
	               width      : "400px",
	               height     : "450px",
	               fixedcenter : true,
	               visible : false,
	               constraintoviewport : true,
	               buttons : [ { text:"Cancel", handler:handleCancel } ]
	          });
	
	
	     // Validate the entries in the form to require
	     YAHOO.example.container.dialog1.validate = function() {
	          var data = this.getData();
	          if (data.raison == "") {
	               alert("Veuillez saisir une raison.");
	               return false;
	          } else {
	               document.getElementById('raison_annulation').value = data.raison ;
	              document.SetAction.submit();
	               return true;
	          }
	     };
	
	
	     // Wire up the success and failure handlers
	     YAHOO.example.container.dialog1.callback = { success: handleSuccess,
	                                                            failure: handleFailure };
	     // Render the Dialog
	     YAHOO.example.container.dialog1.render();
	     //YAHOO.util.Event.addListener("show", "click", YAHOO.example.container.dialog1.show, YAHOO.example.container.dialog1, true);
	     //YAHOO.util.Event.addListener("hide", "click", YAHOO.example.container.dialog1.hide, YAHOO.example.container.dialog1, true);
	});
</script>
{/literal}

<div id="dialog1" class="yui-pe-content">
	<iframe id='TilkeeFrame' src='' title='TILKEE' scrolling="auto" style='border:0px; width:100%;height:400px;overflow:hidden;'></iframe>
</div>
	


<BR>
<form id="ConfigureSettings" name="ConfigureSettings" enctype='multipart/form-data' method="POST" action="index.php?module=Administration&action=tilkee&process=true">
<input type="hidden" value="" name="test_action">

<span class='error'>{$error.main}</span>

<table width="100%" cellpadding="0" cellspacing="1" border="0" class="actionsContainer">
<tr>
	<td>
		<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"
			accessKey="{$APP.LBL_SAVE_BUTTON_KEY}"
			class="button primary"
			type="submit"
			name="save"
			onclick="return verify_data('ConfigureSettings');"
			value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >
		&nbsp;<input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " > </td>
	</tr>
</table>



<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
    <tr>
        <th align="left" scope="row" colspan="4"><h4>{$MOD.LBL_GENERAL_PARAMETERS}</h4></th>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_URL_TILKEE}: </td>
        <td>            
            <input id="url_tilkee" type="text" title="" value="{$URL_TILKEE}" maxlength="255" size="50" name="url_tilkee">
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td>
            &nbsp;
        </td>
    </tr>
     <tr>
        <td  scope="row" width="200">{$MOD.LBL_URL_TILKEE_FRONT}: </td>
        <td>            
            <input id="url_tilkee_front" type="text" title="" value="{$URL_TILKEE_FRONT}" maxlength="255" size="50" name="url_tilkee_front">
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td>
            &nbsp;
        </td>
    </tr>
   <tr>
        <td  scope="row" width="200">{$MOD.LBL_AUTHENT_SCHEDULER}: </td>
        <td>            
            <select id="user_scheduler" name="user_scheduler">{$SELECT_USER_SCHEDULER}</select>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_CLIENT_ID}: </td>
        <td>
            <input id="client_id" type="text" title="" value="{$TILKEE_CLIENT_ID}" maxlength="255" size="50" name="client_id">
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <th align="left" scope="row" colspan="4"><h4>{$MOD.LBL_TILKEE_TEST}</h4></th>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_GET_TOKEN}: </td>
        <td  >
        	<input class="button primary" type="button" value=" Get Token " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='test_token';_form.submit();" name="action" title="Action">
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_CONNEXION}: </td>
        <td  >
        	<input class="button primary" type="button" value=" Connexion " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='test_connexion';_form.submit();" name="action" title="Action">
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_INFOS_PROJECT}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
				    <td>			
		        	<input class="button primary" type="button" value=" Infos Project " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='infos_project';_form.submit();" name="action" title="Action">
		        	</td>
				    <td>&nbsp;
				    </td>
				</tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_infos_project" type="text" title="" value="{$project_id_infos_project}" maxlength="5" size="10" name="project_id_infos_project"></td>
				</tr>
		    </table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_CREATE_PROJECT}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
				    <td>			
		        	<input class="button primary" type="button" value=" Create Project " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='create_project';_form.submit();" name="action" title="Action">
		        	</td>
				    <td>&nbsp;
				    </td>
				</tr>
				<tr>
				    <td>Project Name</td>
				    <td><input id="project_name_create" type="text" title="" value="{$project_name_create}" maxlength="60" size="30" name="project_name_create"></td>
				</tr>
		    </table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_DELETE_PROJECT}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
		    	    <td>
			        	<input class="button primary" type="button" value=" Delete Project " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='delete_project';_form.submit();" name="action" title="Action">
		    	    </td>
		    	    <td>&nbsp;
		    	    </td>
			    </tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_delete" type="text" title="" value="{$project_id_delete}" maxlength="5" size="10" name="project_id_delete"></td>
				</tr>
			</table>
		</td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_UPDATE_PROJECT}: </td>
        <td  scope="row" width="400">
        	<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
        	    <tr>
	        	    <td>
			        	<input class="button primary" type="button" value=" Update Project " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='update_project';_form.submit();" name="action" title="Action">
	        	    </td>
	        	    <td>&nbsp;
	        	    </td>
        	    </tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_update" type="text" title="" value="{$project_id_update}" maxlength="5" size="10" name="project_id_update"></td>
				</tr>
				<tr>
				    <td>Project Name</td>
				    <td><input id="project_name_update" type="text" title="" value="{$project_name_update}" maxlength="60" size="30" name="project_name_update"></td>
				</tr>
				<tr>
				    <td>Project Kind</td>
				    <td><select id="project_kind" name="project_kind">{$SELECT_KIND}</select></td>
				</tr>
				<tr>
				    <td>Project Won ?</td>
				    <td><select id="project_won" name="project_won">{$SELECT_WON_ARCHIVED}</select></td>
				</tr>
				<tr>
				    <td>Project Archived ?</td>
				    <td><select id="project_archived" name="project_archived">{$SELECT_WON_ARCHIVED}</select></td>
				</tr>
        	</table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_INFOS_TILK}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
				    <td>			
		        	<input class="button primary" type="button" value=" Infos Tilk " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='infos_tilk';_form.submit();" name="action" title="Action">
		        	</td>
				    <td>&nbsp;
				    </td>
				</tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_infos_tilk" type="text" title="" value="{$project_id_infos_tilk}" maxlength="5" size="10" name="project_id_infos_tilk"></td>
				</tr>
				<tr>
				    <td>Tilk ID</td>
				    <td><input id="tilk_id_infos_tilk" type="text" title="" value="{$tilk_id_infos_tilk}" maxlength="5" size="10" name="tilk_id_infos_tilk"></td>
				</tr>
		    </table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_CREATE_TILK}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
				    <td>			
		        	<input class="button primary" type="button" value=" Create Tilk " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='create_tilk';_form.submit();" name="action" title="Action">
		        	</td>
				    <td>&nbsp;
				    </td>
				</tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_create_tilk" type="text" title="" value="{$project_id_create_tilk}" maxlength="5" size="10" name="project_id_create_tilk"></td>
				</tr>
				<tr>
				    <td>TILK Name</td>
				    <td><input id="tilk_name_create" type="text" title="" value="{$tilk_name_create}" maxlength="60" size="30" name="tilk_name_create"></td>
				</tr>
		    </table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
    <tr>
        <td  scope="row" width="200">{$MOD.LBL_API_UPDATE_TILK}: </td>
		<td  scope="row" width="400">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" class="edit view">
			    <tr>
				    <td>			
		        	<input class="button primary" type="button" value=" Update Tilk " onclick="var _form = document.getElementById('ConfigureSettings'); _form.test_action.value='update_tilk';_form.submit();" name="action" title="Action">
		        	</td>
				    <td>&nbsp;
				    </td>
				</tr>
				<tr>
				    <td>Project ID</td>
				    <td><input id="project_id_update_tilk" type="text" title="" value="{$project_id_update_tilk}" maxlength="5" size="10" name="project_id_update_tilk"></td>
				</tr>
				<tr>
				    <td>Tilk ID</td>
				    <td><input id="tilk_id_update_tilk" type="text" title="" value="{$tilk_id_update_tilk}" maxlength="5" size="10" name="tilk_id_update_tilk"></td>
				</tr>
				<tr>
				    <td>TILK Name</td>
				    <td><input id="tilk_name_update" type="text" title="" value="{$tilk_name_update}" maxlength="60" size="30" name="tilk_name_update"></td>
				</tr>
				<tr>
				    <td>Tilk Won ?</td>
				    <td><select id="tilk_won" name="tilk_won">{$SELECT_WON_ARCHIVED}</select></td>
				</tr>
				<tr>
				    <td>Tilk Archived ?</td>
				    <td><select id="tilk_archived" name="tilk_archived">{$SELECT_WON_ARCHIVED}</select></td>
				</tr>
		    </table>
        </td>
        <td  scope="row" width="200">&nbsp;</td>
        <td  >
            &nbsp;
        </td>
    </tr>
</table>


<div style="padding-top: 2px;">
<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button primary"  type="submit" name="save" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " />
		&nbsp;<input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " />
</div>
{$JAVASCRIPT}
</form>

<div>
<br /><br />
<h3>{$MOD.LBL_RESULT_TEST}</h3>
<hr>
<h5>{$DISPLAY_TITLE}</h5>
<pre>
{if $DISPLAY_RESULT eq ''}
{$MOD.LBL_NOTHING_TO_DISPLAY}
{else}
{$DISPLAY_RESULT}
{/if}
</pre>
</div>

<script language="Javascript" type="text/javascript">
{$getNameJs}
</script>


