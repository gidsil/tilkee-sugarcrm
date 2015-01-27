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

require_once('include/externalAPI/Base/ExternalAPIBase.php');

class ExtAPITilkee extends ExternalAPIBase {
    
    var $app_base_url  = "http://www.tilkee.fr";
    var $client_id     = "";
    var $client_secret = "";
    var $access_token  = "";
    var $refresh_token = "";
    var $scope         = "";
    
    var $curl_session_id ;
    

    function __construct($client_id = '', $client_secret = '') {
        global $sugar_config;
        if (isset($sugar_config['tilkee']['url_tilkee']) && !empty($sugar_config['tilkee']['url_tilkee'])) {
            $this->app_base_url = $sugar_config['tilkee']['url_tilkee'];
        }
    }
    
    function init_curl_session ($url) {
        
    	$this->curl_session_id = curl_init($this->app_base_url.$url);

        curl_setopt($this->curl_session_id, CURLOPT_POST, true);
        curl_setopt($this->curl_session_id, CURLOPT_HEADER, false);
        curl_setopt($this->curl_session_id, CURLOPT_RETURNTRANSFER, true);
    }

    /*
     * Init TILKEE access with EAPM connector method
     * OK V1
     */
    function init_tilkee_access_eapm () {
        
        $eapmBean = EAPM::getLoginInfo('tilkee', true);                        

        $this->loadEAPM($eapmBean);

        if (isset($this->account_name) && ($this->account_name != '') 
            && isset($this->account_password) && ($this->account_password !='')) {

                $result = $this->get_token_password($this->account_name,$this->account_password);	            
                return $result ;          
            } else {
                // ERROR : Connection Information not set
                return -1;        
            }
    }
    
    /*
     * Init token information with client_id and client_secret input
     */
    function get_token_access($code = "SUGARCRM", $redirect_uri = "") {
                
        global $sugar_config, $current_user;        
        
        $this->init_curl_session("/oauth/authorize");

        if ((isset($sugar_config['tilkee']['client_id'])) && (!empty($sugar_config['tilkee']['client_id']))) {        
            $get_parameters = array(
                 "response_type" => "token",
                 "client_id"     => $sugar_config['tilkee']['client_id'],
                 "redirect_uri"  => $sugar_config['site_url'].'/retourToken.php',
            );
            $url = $this->app_base_url."/oauth/authorize?".http_build_query($get_parameters);        
            SugarApplication::redirect($url);
        }
    }
    
    /*
     * Init token information with user_name and password input
     * 
     */
    function get_token_password($user_name, $password) {
                
        $this->init_curl_session("/oauth/token/");

        $post_parameters = array(
             "password"     => $password,
             "username"     => $user_name,
             "grant_type"   => "password"
        );
    
        curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $post_parameters);
        $response = curl_exec($this->curl_session_id);    
        $result_call = json_decode($response);
        
        /*
         * return structure if success :
         *      access_token  : <access_token>
         *      token_type    :"bearer"
         *      expires_in    :7200
         *      refresh_token : <refresh_token>
         *      scope         : $scope
         */
        
        session_start();
        
        if (isset($result_call->access_token)) {
            $_SESSION['access_token']  = $result_call->access_token;
            $_SESSION['refresh_token'] = $result_call->refresh_token;
            $this->access_token        = $result_call->access_token;
            $this->refresh_token       = $result_call->refresh_token;
        }
        
        if (isset($result_call->error)) {
            $_SESSION['access_token']  = '';
            $_SESSION['refresh_token'] = '';
            $this->access_token        = '';
            $this->refresh_token       = '';
            $this->set_log_error($result_call);
        }
        
        return $result_call;
    }
    
    /*
     * Verify the session token if is set return it  
     * and if not generate a new one
     * 
     * return an access_token or an empty string if an error occure
     * 
     */
    function get_valid_token() {
        
        global $current_user;

        if (isset($current_user->tilkee_token_c) && !empty($current_user->tilkee_token_c)) {
            return $current_user->tilkee_token_c;
        } else {
            $this->get_token_access();
        }
    }
    
    function refresh_token () {
        
        $this->init_curl_session("/oauth/token/");

        $post_parameters = array(
             "client_id"     => $this->client_id,
             "client_secret" => $this->client_secret,
             "grant_type"    => "refresh_token",
             "refresh_token" => $this->refresh_token
        );

        curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $post_parameters);
        $response = curl_exec($this->curl_session_id);    
        $result_call = json_decode($response);
        
        /*
         * return structure if success :
         *  TBD !!!
         */
        
        /* TBD !!!
        if (isset($result_call->access_token)) {
            $this->access_token = $result_call->access_token;
            $this->refresh_token = $result_call->refresh_token;
            $this->scope = $result_call->scope;
        }
        */
        if (isset($result_call->error)) {
            $this->set_log_error($result_call);
        }

        return $result_call;
        
    }
    
    /*
     *  Retrieve projects list
     */    
    function get_projects_list() {
        
        $curl_url = "/api/v2/projects?access_token=".$this->access_token;
        $this->init_curl_session($curl_url);

        curl_setopt($this->curl_session_id, CURLOPT_POST, false);

        $response = curl_exec($this->curl_session_id);            
        $result_call = json_decode($response);
                
        /*
         * return structure if success : Array of Projects
         *      IDX => stdobj
         *          stdobj->project->id
         *          stdobj->project->name
         *          stdobj->project->created_at
         *          stdobj->project->updated_at
         *          stdobj->project->tokens_count
         *          stdobj->project->kind (proposal| brochure)
         *          stdobj->project->status (draft | published)
         *          stdobj->project->leader
         *          stdobj->project->last_connexion
         *          stdobj->project->total_time
         *          stdobj->project->visible_since
         *          stdobj->project->url
         *          stdobj->project->edit_url
         *          stdobj->project->preview_url
         *          stdobj->project->stat_url
         *  
         */

        if (isset($result_call->status) && isset($result_call->body->error)) {
            $GLOBALS['log']->fatal('get_projects_list - result_call -> '.print_r($result_call,true));        
            if ($result_call->status == 'unauthorized')
                $this->get_token_access();
            $this->set_log_error($result_call);
        }

        return $result_call;
        
    }
    
    /*
     * Info project
     * ERROR V1
     */    
    function infos_project($project_id) {
        
        $access_token = $this->get_valid_token();
                
        if (!empty($access_token)) {
            $curl_url = "/api/v2/projects/".$project_id."?access_token=".$access_token;
            $this->init_curl_session($curl_url);

            curl_setopt($this->curl_session_id, CURLOPT_POST, false);
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);
			
            /*
             * return structure if success : 
             *      project->id
             *      project->name
             *      project->won
             *      project->created_at
             *      project->updated_at
             *      project->activated_at
             *      project->archived_at
             *      project->deleted_at
             *      project->customer_type
             *      project->total_connexions
             *      project->leader_id
             *      project->leader
             *      project->last_sign_in_at
             *      project->total_time
             *      project->status (reviewing)
             *      project->visible_since
             *      project->tilk_count (= 0)
             *      project->employees (= Array ([0] => <leader_id>) )
             *      project->url
             *      project->edit_url
             *      project->preview_url
             *      project->stat_url
             *      project->tilks = array()
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('infos_project - result_call -> '.print_r($result_call,true));
            	if ($result_call->status == 'unauthorized')
                    $this->get_token_access();
                $this->set_log_error($result_call);
                return $result_call ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    }  
    
    /*
     * Create project
     * OK V1
     */    
    function create_project($name, $kind = 'brochure', $duplicate_project_id = '') {
        
        $curl_url = "/api/v2/projects";
        $this->init_curl_session($curl_url);
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            $post_parameters = array(
                "access_token"          => $access_token,
                "name"                  => $name,
                "kind"                  => $kind,
                "duplicate_project_id"  => $duplicate_project_id
            );

            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $post_parameters);
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      project->id
             *      project->name
             *      project->won
             *      project->created_at
             *      project->updated_at
             *      project->activated_at
             *      project->archived_at
             *      project->deleted_at
             *      project->customer_type
             *      project->total_connexions
             *      project->leader_id
             *      project->leader
             *      project->last_sign_in_at
             *      project->total_time
             *      project->status (reviewing)
             *      project->visible_since
             *      project->tilk_count (= 0)
             *      project->employees (= Array ([0] => <leader_id>) )
             *      project->url
             *      project->edit_url
             *      project->preview_url
             *      project->stat_url
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('create_project - result_call -> '.print_r($result_call,true));            	
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    }   
    
    /*
     * Update project
     * ERROR V1
     */    
    function update_project($project_id, $name = '', $kind = '', $won = '', $archived = '') {
        
        $access_token = $this->get_valid_token();

		$curl_url = "/api/v2/projects/".$project_id;
		$this->init_curl_session($curl_url);
        
        if (!empty($access_token)) {
            $put_parameters = array(
                "access_token" => $access_token,
                "name"         => $name,
                "kind"         => $kind,
                "won"          => $won,
                "archived"     => $archived
            );

			curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $put_parameters);			
			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      project->id
             *      project->name
             *      project->won
             *      project->created_at
             *      project->updated_at
             *      project->activated_at
             *      project->archived_at
             *      project->deleted_at
             *      project->customer_type
             *      project->total_connexions
             *      project->leader_id
             *      project->leader
             *      project->last_sign_in_at
             *      project->total_time
             *      project->status (reviewing)
             *      project->visible_since
             *      project->tilk_count (= 0)
             *      project->employees (= Array ([0] => <leader_id>) )
             *      project->url
             *      project->edit_url
             *      project->preview_url
             *      project->stat_url
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('update_project - result_call -> '.print_r($result_call,true));            	            
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    }  

    /*
     * Delete project
     * ERROR V1
     */    
    function delete_project($project_id) {
        
        if ($project_id == '')
            return -1;
        
        $curl_url = "/api/v2/projects/".$project_id;
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            $curl_url = '/api/v2/projects/'.$project_id;
            $this->init_curl_session($curl_url);

		    $put_parameters = array(
		        "access_token" => $access_token
		    );
			
            curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $put_parameters);

            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      "ProjectName has been deleted successfully"
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('delete_project - result_call -> '.print_r($result_call,true));            	                        
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }         
    } 

        /*
     * Create tilk
     * OK V1
     */    
    function infos_tilk($project_id, $tilk_id) {
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            
            $curl_url = '/api/v2/projects/'.$project_id.'/tilks/'.$tilk_id.'?access_token='.$access_token;
            $this->init_curl_session($curl_url);
            
            curl_setopt($this->curl_session_id, CURLOPT_POST, false);
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      tilk->id
             *      tilk->title
             *      tilk->last_sign_in_at
             *      tilk->url
             *      tilk->won
             *      tilk->created_at
             *      tilk->archived_at
             *      tilk->contact_id
             *      tilk->contact
             *      tilk->total_time
             *      tilk->total_connexion
             *      tilk->connexions
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('infos_tilk - result_call -> '.print_r($result_call,true));            	                                    
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    } 
    
    /*
     * Create tilk
     * OK V1
     */    
    function create_tilk($project_id, $tilk_name, $contact_id = '') {
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            
            $curl_url = '/api/v2/projects/'.$project_id.'/tilks?access_token='.$access_token;
            $this->init_curl_session($curl_url);
            
            $post_parameters = array(
                "title" => $tilk_name
            );

            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $post_parameters);
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      tilk->id
             *      tilk->title
             *      tilk->url
             *      tilk->won
             *      tilk->archived_at
             *      tilk->contact_id
             *      tilk->contact
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('create_tilk - result_call -> '.print_r($result_call,true));            	                                    
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    } 
    
    
    /*
     * Update tilk
     * OK V1
     */    
    function update_tilk($project_id, $tilk_id, $tilk_name = '', $won = '', $archived = '') {
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            
            $curl_url = '/api/v2/projects/'.$project_id.'/tilks/'.$tilk_id;
            $this->init_curl_session($curl_url);
            
            $put_parameters = array(
                "access_token" => $access_token,
                "title"        => $tilk_name,
                "won"          => $won,
                "archived"     => $archived,
            );

            curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $put_parameters);			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             *      tilk->id
             *      tilk->title
             *      tilk->url
             *      tilk->won
             *      tilk->archived_at
             *      tilk->contact_id
             *      tilk->contact
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('update_tilk - result_call -> '.print_r($result_call,true));            	                                                
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
                return $result_call;
            }
        } else {
            return -1 ;
        }        
    } 
    
        
    /*
     *  write error object information in SugarCRM log file
     */
    protected function set_log_error ($result_error,$error_level = "fatal") {
        
        if (!isset($result_error->status))
            return ;
        
        if ($error_level == "fatal")
            $GLOBALS['log']->fatal("TILKEE CONNECTOR ACCESS ERROR - ".print_r($result_error->body->error,true));
        else
            $GLOBALS['log']->info("TILKEE CONNECTOR INFO - ".print_r($result_error->body->error,true));

        SugarApplication::appendErrorMessage('TILKEE ERROR : '.$result_error->body->error->message);
        
    }
}