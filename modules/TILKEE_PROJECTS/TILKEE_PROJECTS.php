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

class TILKEE_PROJECTS extends Basic {
    var $new_schema = true;
    var $module_dir = 'TILKEE_PROJECTS';
    var $object_name = 'TILKEE_PROJECTS';
    var $table_name = 'tilkee_projects';
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
    var $type;
    var $leader;
    var $leader_id;
    var $status;
    var $won;
    var $tilks_count;
    var $active_tilk;
    var $total_connexions;
    var $total_time;
    var $created_at;
    var $updated_at;
    var $activated_at;
    var $deleted_at;
    var $last_sign_in_at;
    var $archived_at;
    var $visible_since;
    var $url;
    var $preview_url;
    var $edit_url;
    var $stat_url;
    var $stat_iframe;
    var $tilkee_id;

    function TILKEE_PROJECTS_sugar(){
        parent::Basic();
    }

    function bean_implements($interface){
        switch($interface){
                case 'ACL': return true;
        }
        return false;
    }

    function create_from_API ($duplicate_id = '') {

        if (empty($this->tilkee_id) || !empty($duplicate_id)) {
            require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
            $tilkee = new ExtAPITilkee();
            $result = $tilkee->create_project($this->name, $this->type, $duplicate_id);
            if (($result != -1) && (!empty($result))){
                if (!empty($duplicate_id))
                    $this->id = '';
                $this->set_result_to_bean($result);
                $cur_tilks = new TILKEE_TILKS();
                $cur_tilks->updateFromArray($this->id, $result->tokens);

            } else {
                global $mod_strings;
                SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_CREATE_ON_TILKEE']);
            }
        }
        return 0;
    }

    function update_from_API ($won = '', $archived = '') {

        require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
        $tilkee = new ExtAPITilkee();
        $result = $tilkee->update_project($this->tilkee_id, $this->name, $this->type, $won, $archived);

        if (($result != -1) && (!empty($result))){
            $this->set_result_to_bean($result);
            // Create or update tilks from return data
            $tilks_array = $result->tilks ;
        } else {
            global $mod_strings;
            SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_UPDATE_ON_TILKEE']);
        }
    }

    //
    // Sync projects information with tilkee serveur
    // when $mode is 'update_tilks', the tilks array is updated
    //
    function sync_from_API ($mode = '') {

        if (!empty($this->tilkee_id)) {
            require_once('custom/include/externalAPI/Tilkee/ExtAPITilkee.php');
            $tilkee = new ExtAPITilkee();
            $result = $tilkee->infos_project($this->tilkee_id);

            if (($result != -1) && (!empty($result))){

                // project created : init bean
                $this->set_result_to_bean($result);

                // Create or update tilks from return data
                if ($mode == 'update_tilks') {
                    global $beanFiles;
                    require_once($beanFiles['TILKEE_TILKS']);
                    $cur_tilks = new TILKEE_TILKS();
                    $cur_tilks->updateFromArray($this->id, $result->tilks);
                }

                // TBD

            } else {
                global $mod_strings;
                SugarApplication::appendErrorMessage($mod_strings['LBL_ERROR_UPDATE_ON_TILKEE']);
            }
        }
    }

    //
    // set result to current bean
    //
    function set_result_to_bean ($result) {

        $this->name             = $result->name;
        $this->type             = $result->kind;
        $this->status           = $result->status;
        if ($result->won == '1'){
                $this->won = 'true';
        } elseif ($result->won == '0') {
                $this->won = 'false';
        } else {
                $this->won = '';
        }
        $this->created_at       = (!empty($result->created_at))?date('Y-m-d H:i:s', strtotime($result->created_at)):'';
        $this->updated_at       = (!empty($result->updated_at))?date('Y-m-d H:i:s', strtotime($result->updated_at)):'';
        $this->archived_at      = (!empty($result->archived_at))?date('Y-m-d H:i:s', strtotime($result->archived_at)):'';
        $this->last_sign_in_at  = (!empty($result->last_sign_in_at))?date('Y-m-d H:i:s', strtotime($result->last_sign_in_at)):'';
        $this->activated_at     = (!empty($result->activated_at))?date('Y-m-d H:i:s', strtotime($result->activated_at)):'';
        $this->deleted_at       = (!empty($result->deleted_at))?date('Y-m-d H:i:s', strtotime($result->deleted_at)):'';
        $this->visible_since    = (!empty($result->visible_since))?date('Y-m-d H:i:s', strtotime($result->visible_since)):'';

        $this->leader_id        = $result->leader_id;
        $this->leader           = $result->leader;
        $this->total_time       = $this->convert_time($result->total_time);
        $this->tilks_count      = $result->tilks_count;
        $this->active_tilk      = $result->active_tilk;
        $this->total_connexions = $result->total_connexions;

        //URL
        $this->url              = $result->url;
        $this->edit_url         = $result->edit_url;
        $this->preview_url      = $result->preview_url;
        $this->stat_url         = $result->stat_url;
        $this->stat_iframe      = $result->stat_iframe;

        if (empty($this->tilkee_id))
            $this->tilkee_id = $result->id;

        $this->save();

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
