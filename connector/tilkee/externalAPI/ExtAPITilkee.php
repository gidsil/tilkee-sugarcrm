<?php
//TODO
//Supprimer type de projet (vues création/edition)
//TILKS --> last connectoin date

/* 
 * Copyright 2014 TILKEE.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 $http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once('include/externalAPI/Base/ExternalAPIBase.php');

class ExtAPITilkee extends ExternalAPIBase {
    
    var $app_base_url  = "https://api.tilkee.com";
	var $app_url_front = "https://app2.tilkee.com";
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
		$this->app_url_front  = ($GLOBALS['current_language']=='fr_fr')?($this->app_url_front.'/fr/#'):($this->app_url_front.'/en/#');
    }
    
    function init_curl_session ($url) {
        
    	$this->curl_session_id = curl_init($this->app_base_url.$url);

        curl_setopt($this->curl_session_id, CURLOPT_POST, true);
        curl_setopt($this->curl_session_id, CURLOPT_HEADER, false);
        curl_setopt($this->curl_session_id, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Content-Type: application/json")); 
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
    
        curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, json_encode($post_parameters));
        $response = curl_exec($this->curl_session_id);    
        $result_call = json_decode($response);
        
        /*
         * return structure if success :
         $access_token  : <access_token>
         $token_type    :"bearer"
         $expires_in    :7200
         $refresh_token : <refresh_token>
         $scope         : $scope
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

        curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, json_encode($post_parameters));
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
        
        $curl_url = "/projects";
        $this->init_curl_session($curl_url);

        curl_setopt($this->curl_session_id, CURLOPT_POST, false);
		curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$this->access_token)); 

        $response = curl_exec($this->curl_session_id);            
        $result_call = json_decode($response);
                
        /*
         * return structure if success : Array of Projects
         $IDX => stdobj
         $    stdobj->project->id
         $    stdobj->project->name
         $    stdobj->project->created_at
         $    stdobj->project->updated_at
         $    stdobj->project->tokens_count
         $    stdobj->project->kind (proposal| brochure)
         $    stdobj->project->status (draft | published)
         $    stdobj->project->leader
         $    stdobj->project->last_connexion
         $    stdobj->project->total_time
         $    stdobj->project->visible_since
         $    stdobj->project->url
         $    stdobj->project->edit_url
         $    stdobj->project->preview_url
         $    stdobj->project->stat_url
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
            $curl_url = "/projects/".$project_id;
            $this->init_curl_session($curl_url);

            curl_setopt($this->curl_session_id, CURLOPT_POST, false);
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token)); 
			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);
			
            /*
             * return structure if success : 
             $project->id
             $project->name
             $project->won
             $project->created_at
             $project->updated_at
             $project->activated_at
             $project->archived_at
             $project->deleted_at
             $project->customer_type
             $project->total_connexions
             $project->leader_id
             $project->leader
             $project->last_sign_in_at
             $project->total_time
             $project->status (reviewing)
             $project->visible_since
             $project->tilk_count (= 0)
             $project->employees (= Array ([0] => <leader_id>) )
             $project->url
             $project->edit_url
             $project->preview_url
             $project->stat_url
             $project->tilks = array()
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('infos_project - result_call -> '.print_r($result_call,true));
            	if ($result_call->status == 'unauthorized')
                    $this->get_token_access();
                $this->set_log_error($result_call);
                return $result_call ;
            } else {
				$result_call->last_sign_in_at = $result_call->last_access;
				$result_call->deleted_at       = '';
				$result_call->visible_since    = $result_call->activated_at;
				$result_call->leader_id        = $result_call->leader->id;
				$result_call->leader           = $result_call->leader->first_name.' '.$result_call->leader->last_name;
				$result_call->won      		   = ($result_call->won=='na')?(''):($result_call->won);
				$result_call->tilks_count      = '';
				$result_call->active_tilk      = '';
				$result_call->total_connexions = $result_call->nb_connections;
				$result_call->url              = $this->app_url_front.'/project/'.$result_call->id;
				//$result_call->edit_url         = $this->app_url_front.'/login/oauth?token='.$access_token.'&redirect_to=%2Fproject%2F'.$result_call->id.'%2Fitems';
				$result_call->edit_url         = $this->app_url_front.'/login/oauth?token='.$access_token.'&redirect_to=%2Fproject%2F'.$result_call->id.'%2Fitems'; //$this->app_url_front.'/project/'.$result_call->id.'/items';
				$result_call->preview_url      = $result_call->preview;
				$result_call->stat_url         = $this->app_url_front.'/login/oauth?token='.$access_token.'&redirect_to=%2Fproject%2F'.$result_call->id.'%2Fstats'; //$this->app_url_front.'/project/'.$result_call->id.'/stats';
				$result_call->stat_iframe 	   = $this->app_url_front.'/login/oauth?token='.$access_token.'&redirect_to=%2Fproject%2F'.$result_call->id.'%2Fitems';

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
        
        
        $access_token = $this->get_valid_token();
        if (!empty($access_token)) {
            if($duplicate_project_id > 0) { // Cas duplicate
				$curl_url = "/projects/".$duplicate_project_id."/duplicate";
				$this->init_curl_session($curl_url);
				curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token)); 
				$response = curl_exec($this->curl_session_id);    
				$result_call = json_decode($response);
				//TODO MAJ name !!
			} else {
				$curl_url = "/projects";
				$this->init_curl_session($curl_url);
        
				$post_parameters = array(
					//"access_token"          => $access_token,
					"name"                  => $name,
					//"kind"                  => $kind,
					//"duplicate_project_id"  => $duplicate_project_id
				);

				curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, json_encode($post_parameters));
				curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json")); 
				$response = curl_exec($this->curl_session_id);  
				$result_call = json_decode($response);
			}
            /*
             * return structure if success : 
             $project->id
             $project->name
             $project->won
             $project->created_at
             $project->updated_at
             $project->activated_at
             $project->archived_at
             $project->deleted_at
             $project->customer_type
             $project->total_connexions
             $project->leader_id
             $project->leader
             $project->last_sign_in_at
             $project->total_time
             $project->status (reviewing)
             $project->visible_since
             $project->tilk_count (= 0)
             $project->employees (= Array ([0] => <leader_id>) )
             $project->url
             $project->edit_url
             $project->preview_url
             $project->stat_url
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('create_project - result_call -> '.print_r($result_call,true));            	
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
				$result_call->last_sign_in_at = $result_call->last_access;
				$result_call->deleted_at       = '';
				$result_call->visible_since    = $result_call->activated_at;
				$result_call->leader_id        = $result_call->leader->id;
				$result_call->leader           = $result_call->leader->first_name.' '.$result_call->leader->last_name;
				$result_call->tilks_count      = '';
				$result_call->active_tilk      = '';
				$result_call->won      		   = '';
				$result_call->total_connexions = $result_call->nb_connections;
				$result_call->url              = $this->app_url_front.'/project/'.$result_call->id;
				$result_call->edit_url         = $this->app_url_front.'/project/'.$result_call->id.'/items';
				$result_call->preview_url      = $result_call->preview;
				$result_call->stat_url         = $this->app_url_front.'/project/'.$result_call->id.'/stats';
				$result_call->stat_iframe 	   = $this->app_url_front.'/project/'.$result_call->id.'/stats';
				
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

		$curl_url = "/projects/".$project_id;
		$this->init_curl_session($curl_url);
        
        if (!empty($access_token)) {
            $put_parameters = array(
                "name"         => $name,
                "won"          => $won                
            );
			if($archived) $put_parameters['archived_at']=date("Y-m-d H:i:s");
			

			curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, json_encode($put_parameters));	
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json")); 			
			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             $project->id
             $project->name
             $project->won
             $project->created_at
             $project->updated_at
             $project->activated_at
             $project->archived_at
             $project->deleted_at
             $project->customer_type
             $project->total_connexions
             $project->leader_id
             $project->leader
             $project->last_sign_in_at
             $project->total_time
             $project->status (reviewing)
             $project->visible_since
             $project->tilk_count (= 0)
             $project->employees (= Array ([0] => <leader_id>) )
             $project->url
             $project->edit_url
             $project->preview_url
             $project->stat_url
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('update_project - result_call -> '.print_r($result_call,true));            	            
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
				$result_call->last_sign_in_at = $result_call->last_access;
				$result_call->deleted_at       = '';
				$result_call->visible_since    = $result_call->activated_at;
				$result_call->leader_id        = $result_call->leader->id;
				$result_call->leader           = $result_call->leader->first_name.' '.$result_call->leader->last_name;
				$result_call->tilks_count      = '';
				$result_call->active_tilk      = '';
				$result_call->total_connexions = $result_call->nb_connections;
				$result_call->url              = $this->app_url_front.'/project/'.$result_call->id;
				$result_call->edit_url         = $this->app_url_front.'/project/'.$result_call->id.'/items';
				$result_call->preview_url      = $result_call->preview;
				$result_call->stat_url         = $this->app_url_front.'/project/'.$result_call->id.'/stats';
				$result_call->stat_iframe 	   = $this->app_url_front.'/project/'.$result_call->id.'/stats';
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
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            $curl_url = '/projects/'.$project_id;
            $this->init_curl_session($curl_url);		   
			
            curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, false);
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json"));

            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             $"ProjectName has been deleted successfully"
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
            
            $curl_url = '/projects/'.$project_id.'/tokens';
            $this->init_curl_session($curl_url);
            
            curl_setopt($this->curl_session_id, CURLOPT_POST, false);
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token));
			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             $tilk->id
             $tilk->title
             $tilk->last_sign_in_at
             $tilk->url
             $tilk->won
             $tilk->created_at
             $tilk->archived_at
             $tilk->contact_id
             $tilk->contact
             $tilk->total_time
             $tilk->total_connexion
             $tilk->connexions
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('infos_tilk - result_call -> '.print_r($result_call,true));            	                                    
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else { //on parcours les résultats...
				foreach($result_call->contents as $tilk) {
					if($tilk->id ==$tilk_id) {
						$tilk->title = $tilk->name;
						$tilk->last_sign_in_at = $tilk->last_signin;
						$tilk->url = $tilk->link; 
						$tilk->contact_id = ''; 
						$tilk->contact = '';
						$tilk->total_connexion = $tilk->nb_connections;
						$tilk->connexions = $this->infos_connections($project_id, $tilk_id);
						return $tilk;
					}
				}
                $this->set_log_error('no tilk found');
                return -1 ;
            }
        } else {
            return -1 ;
        }        
    } 
    
	function infos_connections($project_id, $tilk_id) {
        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            
            $curl_url = '/projects/'.$project_id.'/connexions?tokens='.$tilk_id;
            $this->init_curl_session($curl_url);
            
            curl_setopt($this->curl_session_id, CURLOPT_POST, false);
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token));
			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('infos_tilk - result_call -> '.print_r($result_call,true));            	                                    
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else { //On parcours
				$result_array=array();
				foreach($result_call->contents as $connexion) {
					$connexion->device = $connexion->platform->device_type.' '.$connexion->platform->device_number;
					$connexion->browser = $connexion->platform->browser;
					$connexion->plateform = $connexion->platform->device_type;
					$connexion->os = $connexion->platform->os;
					$connexion->ip_address = $connexion->platform->ip;
					$connexion->downloads = $connexion->downloaded;
					$result_array[]=$connexion;
				}
				return $result_array;
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
$GLOBALS['log']->fatal("Debut function create_tilk: " . $project_id);	        
        $access_token = $this->get_valid_token();
        
        if (!empty($access_token)) {
            
            $curl_url = '/projects/'.$project_id.'/tokens';
            $this->init_curl_session($curl_url);
            
            $post_parameters = '{"persons": [{"name": "'.$tilk_name.'"}]}';
			

            curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, $post_parameters);
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json"));
//die($post_parameters.'-'.$access_token.'-'.$curl_url);			
            $response = curl_exec($this->curl_session_id);    
            $result_call = json_decode($response);

            /*
             * return structure if success : 
             $tilk->id
             $tilk->title
             $tilk->url
             $tilk->won
             $tilk->archived_at
             $tilk->contact_id
             $tilk->contact
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('create_tilk - result_call -> '.print_r($result_call,true));            	                                    
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
				$tilk = $result_call->contents[0];
//die(print_r($tilk));				
				$tilk->title = $tilk->name;
				$tilk->url = $tilk->link;
				$tilk->contact_id = ''; 
				$tilk->contact = '';
				$tilk->archived_at = '';
				//$tilk->won = '';
				$tilk->total_time = 0;
				$tilk->total_connexion = 0;
				$tilk->last_sign_in_at = '';
$GLOBALS['log']->fatal("New TILK: " . print_r($tilk, true));	
                return $tilk;
            }
        } else {
			$GLOBALS['log']->fatal("Fin function create_tilk ERROR: " . $project_id);	        
            return -1 ;
        }        
    } 
    
    
    /*
     * Update tilk
     * OK V1
     */    
    function update_tilk($project_id, $tilk_id, $tilk_name = '', $won = '', $archived = '') {
$GLOBALS['log']->fatal("Debut function update_tilk: " . $project_id.'-'.$tilk_id);	        
        
        $access_token = $this->get_valid_token();
        if (!empty($access_token)) {
           
			$curl_url = '/tokens/'.$tilk_id;
			$put_parameters = array(
			"name"        => $tilk_name,
			"won"          => $won
			);
$GLOBALS['log']->fatal("Debut function update_tilk request: " . $curl_url.'-'.$access_token.'-'.print_r($put_parameters,true));	 			
			$this->init_curl_session($curl_url);
			curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, json_encode($put_parameters));				
			
            curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json"));
			
            $response = curl_exec($this->curl_session_id);    
			$result_call = json_decode($response);
$GLOBALS['log']->fatal("Debut function update_tilk reponse: " . print_r($result_call,true));	 			
			if($archived=='true') {
				$GLOBALS['log']->fatal("Debut function update_tilk ARCHIVE !!: " . $archived.'-'.$tilk_id);	        
				$curl_url = '/tokens/'.$tilk_id.'/archive';
				$this->init_curl_session($curl_url);
				curl_setopt($this->curl_session_id, CURLOPT_POSTFIELDS, false);
				curl_setopt($this->curl_session_id, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($this->curl_session_id, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token,"Content-Type: application/json"));
				$response = curl_exec($this->curl_session_id);    
				$result_call = json_decode($response);
			}
			/*
             * return structure if success : 
             $tilk->id
             $tilk->title
             $tilk->url
             $tilk->won
             $tilk->archived_at
             $tilk->contact_id
             $tilk->contact
             *  
             */

            if (isset($result_call->status) && isset($result_call->body->error)) {
            	$GLOBALS['log']->fatal('update_tilk - result_call -> '.print_r($result_call,true));            	                                                
                if ($result_call->status == 'unauthorized')
                        $this->get_token_access();
                $this->set_log_error($result_call);
                return -1 ;
            } else {
				$result_call->title = $result_call->name;
				$result_call->url = $result_call->link;
				$result_call->contact_id = ''; 
				$result_call->contact = '';
				$result_call->total_connexion = $result_call->nb_connections;
				$result_call->connexions = $this->infos_connections($project_id, $tilk_id);
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
