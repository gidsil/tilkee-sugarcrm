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

/*
 * Positionnement des modules installés en interface non-AJAX
 */
require_once('modules/Configurator/Configurator.php');
$cfg = new Configurator();
$cfg->config['addAjaxBannedModules'][] = 'TILKEE_CONNEXIONS' ;
$cfg->config['addAjaxBannedModules'][] = 'TILKEE_PROJECTS' ;
$cfg->config['addAjaxBannedModules'][] = 'TILKEE_TILKS' ;
$cfg->handleOverride();

?>
<br />
<h1>TILKEE Connector for SugarCRM</h1>
<p>
    Installation complete...
</p>
<p></p>
    <p>This connector is design to access to TILKEE server information from your SugarCRM instance</p>   
    <p>see below for more information</p>
    <h2>ChangeLog</h2>
    <p>version 1.0</p>
    <ul>
        <li>External API access to Tilkee REST service</li>
        <li>Set and Access to Tilkee projects, TILKs and TILKEE Connexions</li>
        <li>Links Tilkee projects to Opportunities and Accounts</li>
        <li>Links Tilkee TILKs to Contacts and Leads</li>
    </ul>
    <h2>Installation</h2>
    <p>1 - Install the Tilkee Connector module with SugarCRM module loader</p>
    <p>2 - Go to "Admin / Tilkee admin page" to set connector's properties to access Tilkee information</p>
    <p>4 - Users have to create an external link in their profil to connect to their Tilkee account</p>
    <p>5 - Now a Tilkee subpanels appear in objects to access to projects, tilks and connexions</p>
    <p> Remark : sometimes it is necessary to "Rebuild and Repair" to clean the ExternalAPI cache file</p>
    <h2>FAQ</h2>
    <p><b></b><br/>
        
    </p>
    <h2>Licence</h2>
    <pre>
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.         
    </pre>
<br /><br />

