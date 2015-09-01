<?PHP

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



class TILKEE_TILKS extends Basic {
    var $new_schema = true;
    var $module_dir = 'TILKEE_TILKS';
    var $object_name = 'TILKEE_TILKS';
    var $table_name = 'tilkee_tilks';
    var $importable = false;
    var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
    var $id;
    var $name;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $modified_by_name;
    var $created_by;
    var $created_by_name;
    var $description;
    var $deleted;
    var $created_by_link;
    var $modified_user_link;
    var $assigned_user_id;
    var $assigned_user_name;
    var $assigned_user_link;
    var $tilkee_contact_id;
    var $tilk_url;
    var $total_time;
    var $total_connexion;
    var $contact_email;
    var $last_sign_in_at;
    var $created_at;
    var $won;
    var $archived_at;
    var $tilkee_id;
    
    function TILKEE_TILKS_sugar(){	
        parent::Basic();
    }
	
    function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }

    function create_from_API () {
        
        global $beanFiles;
        
        require_once($beanFiles['TILKEE_PROJECTS']);
        $associated_project = new TILKEE_PROJECTS();
        
        if (!empty($this->tilkee_projects_id)) {
            $associated_project->retrieve($this->tilkee_projects_id);
            
            if (!empty($associated_project->tilkee_id)) {

                if (empty($this->tilkee_id)) {

                    require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
                    $tilkee = new ExtAPITilkee();
                    $result = $tilkee->create_tilk($associated_project->tilkee_id, $this->name);

                    if (($result != -1) && (!empty($result))){
                        // project created : init bean
                        $this->tilkee_id         = $result->id;
                        // project_id
                        // title
                        $this->tilk_url          = $result->url;
                        $this->won               = $result->won;
                        $this->created_at      = (!empty($result->created_at))?date('Y-m-d H:i:s', strtotime($result->created_at)):'';
                        $this->archived_at     = (!empty($result->archived_at))?date('Y-m-d H:i:s', strtotime($result->archived_at)):'';
                        $this->tilkee_contact_id = $result->contact_id;
                        // tilkee_contact

                        $this->save();
                    } else {
                        global $mod_strings;
                        SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_CREATE_ON_TILKEE']);
                    }
                }
            }
        }        
        return 0;
    }    
    
    function update_from_API ($archived = '') {
        
        global $beanFiles;
        
        require_once($beanFiles['TILKEE_PROJECTS']);
        $associated_project = new TILKEE_PROJECTS();
        if (!empty($this->tilkee_projects_id)) {
            $associated_project->retrieve($this->tilkee_projects_id);
            
            if (!empty($associated_project->tilkee_id)) {
                
                require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
                $tilkee = new ExtAPITilkee();
                $result = $tilkee->update_tilk($associated_project->tilkee_id, $this->tilkee_id, $this->name, $this->won, $this->archived);
                
                if (($result != -1) && (!empty($result))){
                    // project updated : init bean
                    $this->tilk_url        = $result->url;
                    $this->won             = $result->won;
                    $this->created_at      = (!empty($result->created_at))?date('Y-m-d H:i:s', strtotime($result->created_at)):'';
                    $this->archived_at     = (!empty($result->archived_at))?date('Y-m-d H:i:s', strtotime($result->archived_at)):'';
                    $this->last_sign_in_at = (!empty($result->last_sign_in_at))?date('Y-m-d H:i:s', strtotime($result->last_sign_in_at)):'';
                    $this->archived	   = (!empty($result->archived_at))?'true':'false';
                    $this->total_time      = $this->convert_time($result->total_time);
                    $this->total_connexion = $result->total_connexion;
                    // tilkee_contact_id
                    // tilkee_contact
                    
                    $this->save();

                    // UPDATE LINKED CONNEXIONS
                    $connexion_array = $result->connexions ;

                } else {
                    global $mod_strings;
                    SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_UPDATE_ON_TILKEE']);
                }
                
            } else {
                // ERROR : Associated project is not created in TILKEE
            }            
        }        
        return 0;
    }  

    //
    // Sync tilks information with tilkee serveur
    // when $mode is 'update_connexions', the connexions array is updated
    //    
    function sync_from_API ($mode = '') {
        
        global $beanFiles;
        
        require_once($beanFiles['TILKEE_PROJECTS']);
        $associated_project = new TILKEE_PROJECTS();

        $projects_array = $this->get_linked_beans('tilkee_projects_tilkee_tilks','TILKEE_PROJECTS');
        $tilkee_project_id = 0;
        foreach ( $projects_array as $project ) {
                $tilkee_project_id = $project->tilkee_id ;
        }
        
        if (!empty($tilkee_project_id)) {
                
            require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
            $tilkee = new ExtAPITilkee();
            $result = $tilkee->infos_tilk($tilkee_project_id, $this->tilkee_id);
            
            if (($result != -1) && (!empty($result))){
                // project updated : init bean
                $this->name            = $result->title;
                $this->tilk_url        = $result->url;
                $this->won             = ($result->won==1)?'true':'false';
                $this->archived	   = (!empty($result->archived_at))?'true':'false';
                $this->created_at      = (!empty($result->created_at))?date('Y-m-d H:i:s', strtotime($result->created_at)):'';
                $this->archived_at     = (!empty($result->archived_at))?date('Y-m-d H:i:s', strtotime($result->archived_at)):'';
                $this->last_sign_in_at = (!empty($result->last_sign_in_at))?date('Y-m-d H:i:s', strtotime($result->last_sign_in_at)):'';
                $this->total_time      = $this->convert_time($result->total_time);
                $this->total_connexion = $result->total_connexion;
                $this->save();

                // UPDATE LINKED CONNEXIONS
                if ($mode == 'update_connexions') {
                    global $beanFiles;
                    require_once($beanFiles['TILKEE_CONNEXIONS']);
                    
                    $cur_connexions = new TILKEE_CONNEXIONS();
                    $cur_connexions->updateFromArray($this->id, $result->connexions);                                                                    
                }
                
            } else {
                global $mod_strings;
                SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_SYNC_ON_TILKEE']);
                $GLOBALS['log']->fatal('TILKS sync_from_API -> ERROR RETRIEVE TILK INFOS FOR TILK : '.$this->tilkee_id.' - PROJECT : '.$associated_project->tilkee_id);
            }
            
        }
        
        return 0;
    }  
    
    //
    // Upadte TILKS from Array
    // used when view a Tilkee project, it updates tilks linked
    // 1st version : does not deleted inexistant tilks, but does it exist ?
    //              and does not verify the link between an existing tilk and the project
    // 
    function updateFromArray($project_id, $tilks_array) {
        
        if (empty($project_id) || !is_array($tilks_array) || count($tilks_array) == 0)
            return;
                
        foreach ($tilks_array as $tilks) {
            // retrive tilk by tilkee_id field
            $tilk_obj = new TILKEE_TILKS();
            $tilk_obj->retrieve_by_string_fields(array('tilkee_id'=> $tilks->id));
            
            if (empty($tilk_obj->id)) {
                // Tilk does not exist so create it
                $tilk_obj->tilkee_id       = $tilks->id;
            }
            
            $tilk_obj->name            = $tilks->title;
            $tilk_obj->tilk_url        = $tilks->url;
            $tilk_obj->won             = ($tilks->won==1)?'true':'false';
            $tilk_obj->archived        = (!empty($tilks->archived_at))?'true':'false';
            $tilk_obj->created_at      = (!empty($tilks->created_at))?date('Y-m-d H:i:s', strtotime($tilks->created_at)):'';
            $tilk_obj->archived_at     = (!empty($tilks->archived_at))?date('Y-m-d H:i:s', strtotime($tilks->archived_at)):'';
            $tilk_obj->last_sign_in_at = (!empty($tilks->last_sign_in_at))?date('Y-m-d H:i:s', strtotime($tilks->last_sign_in_at)):'';
            $tilk_obj->total_time      = $this->convert_time($tilks->total_time);
            $tilk_obj->total_connexion = $tilks->total_connexion;
            $tilk_obj->save();

            // Init relationship with Tilkee project              
            $tilk_obj->load_relationship('tilkee_projects_tilkee_tilks');
            $tilk_obj->tilkee_projects_tilkee_tilks->add($project_id);

            unset($tilk_obj);
        }
    }
    
    //
    // convert time in second and decimal into string with hour/minute/second
    //
    function convert_time ($time = '') {
        $str_time = '';

        $time_in_second = $time / 1000;

        $nb_minutes = $time_in_second / 60;
        $nb_seconds = $time_in_second % 60;

        $str_time = $nb_seconds.'s';

        if ($nb_minutes >= 60) {
                $nb_heures = $nb_minutes / 60;
                $nb_minutes = $nb_minutes % 60;
                $str_time = floor($nb_heures).'h '.$nb_minutes.'m '.$str_time;									
        } else {
                $str_time = floor($nb_minutes).'m '.$str_time;
        }		
        return $str_time;

    }        
}
?>
