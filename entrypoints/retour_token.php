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

global $sugar_config, $current_user;


// URL Example from TILKEE :
//      <site_url>/index.php?entryPoint=retourToken#access_token=4abd700617e78253e28f9bfecdfb9b924fefb67cb57e021b973371ca59db8379&token_type=bearer&expires_in=7200

/*
 * Retrieve and save token in a cookie
 */
if (isset($_REQUEST['access_token']) && !empty($_REQUEST['access_token'])) {
    $current_user->tilkee_token_c = $_REQUEST['access_token'];
    $current_user->save();

    SugarApplication::redirect("index.php");
} 
    