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

require_once('include/MVC/Controller/SugarController.php');
  
  
 class TILKEE_PROJECTSController extends SugarController
{
    function action_duplicate(){

        $this->bean->create_from_API($this->bean->tilkee_id);
        SugarApplication::redirect('index.php?module=TILKEE_PROJECTS&action=EditView&isduplicate=true&record='.$this->bean->id);
    }
    
    function action_archived_won(){

        //$this->bean->status = 'archived';
        //$this->bean->won    = 'true';
        //$this->bean->save();
        $this->bean->update_from_API('true', 'true');
        SugarApplication::redirect('index.php?module=TILKEE_PROJECTS&action=DetailView&record='.$this->bean->id);
    }

    function action_archived_lost(){
        //$this->bean->status = 'archived';
        //$this->bean->won    = 'false';
        //$this->bean->save();
        $this->bean->update_from_API('false', 'true');
        SugarApplication::redirect('index.php?module=TILKEE_PROJECTS&action=DetailView&record='.$this->bean->id);
    }

    function action_archived(){
        //$this->bean->status = 'archived';
        //$this->bean->won    = '';
        //$this->bean->save();
        $this->bean->update_from_API('', 'true');
        SugarApplication::redirect('index.php?module=TILKEE_PROJECTS&action=DetailView&record='.$this->bean->id);
    }

    function action_desarchived(){
        //$this->bean->status = 'activated';
        //$this->bean->won    = '';
        //$this->bean->save();
        $this->bean->update_from_API('', 'false');
        SugarApplication::redirect('index.php?module=TILKEE_PROJECTS&action=DetailView&record='.$this->bean->id);        
    }
}
 