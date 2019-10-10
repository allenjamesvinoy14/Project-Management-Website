<?php
    class Skill{
        private $skillid;
        private $skillname;

        public function __construct($skillid,$skillname){
            $this->skillid = $skillid;
            $this->skillname = $skillname;
        }

        public function getSkillId(){
            return $this->skillid;
        }
        public function getSkillName(){
            return $this->skillname;
        }

        public function setSkillId($skillid){
            $this->skillid = $skillid;
        }
        public function setSkillName($skillname){
            $this->skillname = $skillname;
        }
    }
?>