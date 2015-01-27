
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

window.onload=function(){
	
    save_header_button = document.getElementById("SAVE_HEADER");
    save_header_button.onclick=save_onclick ;
    save_footer_button = document.getElementById("SAVE_FOOTER");
    save_footer_button.onclick=save_onclick ;
};

function save_onclick () {
    var _form = document.getElementById('EditView'); 
    _form.action.value='Save'; 
    
    if(check_form('EditView')) {
        // Lead and Contact are exclusive
        if ((document.getElementById("leads_id").value == '') && (document.getElementById("contacts_id").value == '')) {
            alert(lbl_error_contact_lead);
            return false ;
        }
        if ((document.getElementById("leads_id").value != '') && (document.getElementById("contacts_id").value != '')) {
                alert(lbl_error_contact_lead);
                return false ;
        }
        return true ;
        
    }
        
    return false;
}
