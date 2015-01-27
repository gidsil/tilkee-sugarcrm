
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


function Archived(module,id,parentContainerId,action) {
    
    var args = "action=" + action + "&record=" + id + "&module=" + module;
    var callback = {
        success: function(o) {
            window.setTimeout(function() {
                window.location.reload(true);
            }, 0);
        },
        argument: {
            'parentContainerId': parentContainerId
        }
    };
    
    YAHOO.util.Connect.asyncRequest('POST', 'index.php', callback, args);                        
}