<?php
    class Project{
        private $projid;
        private $proj_name;
        private $proj_desc;
        private $proj_lead;
        private $accepted;
        private $skills = array();

        public function __construct($proj_name,$proj_desc,$proj_lead){
            $this->proj_name = $proj_name;
            $this->proj_desc = $proj_desc;
            $this->proj_lead = $proj_lead;
        }

        public function getProjectId(){
            return $this->projid;
        }
        public function getProjectName(){
            return $this->proj_name;
        }
        public function getProjectDesc(){
            return $this->proj_desc;
        }
        public function getProjectLeadDetails(){
            return $this->proj_lead;
        }

        public function setProjectId($projid){
            $this->projid = $projid;
        }
        public function setProjectName($proj_name){
            $this->proj_name = $proj_name;
        }
        public function setProjectDesc($proj_desc){
            $this->proj_desc = $proj_desc;
        }
        public function setProjectLeadDetails($proj_lead){
            $this->proj_lead= $proj_lead;
        }
        public function setAcceptanceStatus($status){
            $accepted = $status;
        }

        public function addSkill($newskill){
            array_push($this->skills,$newskill);
        }

        public function getSkills(){
            return $this->skills;
        }
    }
?>