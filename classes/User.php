<?php
    class User{
        private $userid;
        private $username;
        private $email;
        private $password;
        private $token;
        private $verified;

        private $projects = array();

        public function __construct($username,$email,$password,$token,$verified)
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->token = $token;
            $this->verified = $verified;
        }
        public function setUserId($userid)
        {
            $this->userid = $userid;
        }
        public function setUsername($username)
        {
            $this->username = $username;
        }
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function setPassword($password)
        {
            $this->password = $password;
        }
        public function setVerified($verified)
        {
            $this->verified = $verified;
        }
        public function addProject($newproject){
            array_push($this->projects,$newproject);
        }

        public function getUsername()
        {
            return $this->username;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getToken()
        {
            return $this->token;
        }
        public function getVerificationStatus()
        {
            return $this->verified;
        }
        public function getUserId(){
            return $this->userid;
        }
        public function getProjects(){
            return $this->projects;
        }
    }
?>