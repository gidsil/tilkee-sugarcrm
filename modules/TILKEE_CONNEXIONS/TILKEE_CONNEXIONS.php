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

class TILKEE_CONNEXIONS extends Basic {
    var $new_schema = true;
    var $module_dir = 'TILKEE_CONNEXIONS';
    var $object_name = 'TILKEE_CONNEXIONS';
    var $table_name = 'tilkee_connexions';
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
    var $connexion_id;
    var $device;
    var $browser;
    var $plateform;
    var $os;
    var $ip_address;
    var $access_date;
    var $total_time;
    var $downloads;
    
    function TILKEE_CONNEXIONS_sugar(){	
        parent::Basic();
    }
	
    function bean_implements($interface){
        switch($interface){
                case 'ACL': return true;
        }
        return false;
    }	
    
    /*
     * Update tilks with the input array data
     *  if tilk exist update
     *  else create it
     * 
     *  $tilkee_tilk_id = TILKEE_TILKS SUGAR ID
     *  $connexions_array =array(
     *      "id",
     *      "device",
     *      "browser",
     *      "platform",
     *      "os",
     *      "ip_address",
     *      "access_date",
     *      "total_time",
     *      "downloads"
     */
    function updateFromArray($tilkee_tilk_id, $connexions_array) {
        
        global $beanFiles;
        
        require_once($beanFiles['TILKEE_PROJECTS']);
        require_once($beanFiles['TILKEE_CONNEXIONS']);
        
        if (!empty($tilkee_tilk_id)) {
            foreach ($connexions_array as $connexion) {
                $search_connexion = new TILKEE_CONNEXIONS();
                $search_connexion->retrieve_by_string_fields(array( 'connexion_id' => $connexion->id ));
                if (!empty($search_connexion->id)) {
                    // Update CONNEXION
                    $search_connexion->name        = "[CONNEXION] ";
                    $search_connexion->device      = $connexion->device;
                    $search_connexion->browser     = $connexion->browser;
                    $search_connexion->plateform   = $connexion->plateform;
                    $search_connexion->os          = $connexion->os;
                    $search_connexion->ip_address  = $connexion->ip_address;
                    $search_connexion->access_date = (!empty($connexion->access_date))?date('Y-m-d H:i:s', strtotime($connexion->access_date)):'';
                    $search_connexion->total_time  = $this->convert_time($connexion->total_time);
                    $search_connexion->downloads   = $connexion->downloads;
                    $search_connexion->save();
                } else {
                    // Create CONNEXION
                    $new_connexion = new TILKEE_CONNEXIONS();
                    $new_connexion->name            = "[CONNEXION] ";
                    $new_connexion->connexion_id    = $connexion->id;
                    $new_connexion->device          = $connexion->device;
                    $new_connexion->browser         = $connexion->browser;
                    $new_connexion->plateform       = $connexion->plateform;
                    $new_connexion->os              = $connexion->os;
                    $new_connexion->ip_address      = $connexion->ip_address;
                    $new_connexion->access_date     = (!empty($connexion->access_date))?date('Y-m-d H:i:s', strtotime($connexion->access_date)):'';
                    $new_connexion->total_time      = $this->convert_time($connexion->total_time);
                    $new_connexion->downloads       = $connexion->downloads;
                    $new_connexion->tilkee_tilks_id = $tilkee_tilk_id;
                    $new_connexion->save();
                    
                        // Init relationship with Tilkee Tilk              
                    $new_connexion->load_relationship('tilkee_tilks_tilkee_connexions');
                    $new_connexion->tilkee_tilks_tilkee_connexions->add($tilkee_tilk_id);

                }
                unset($search_connexion);
            } // CONNEXIONS LOOP
        } // Sugar TILK ID is set
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