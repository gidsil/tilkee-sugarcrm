<?php

/* 
 * Copyright 2014 Corto.
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

require_once 'config.php';
echo "<script>var base_url = '".$sugar_config['site_url']."'</script>";
?>

<script>
window.onload = function(e){ 
	var url_array = window.location.href.split('#');
        
	if (url_array.length == 2) {
		var url_info = url_array[0];
		var token_info = url_array[1];
		
		window.location = base_url+'/index.php?entryPoint=retourToken&'+token_info;
	} 
}	
</script>

<center>
    <img src='custom/themes/default/images/logo_tilkee.png'><br /><br />  
    <img src='themes/default/images/loading.gif'>
</center>