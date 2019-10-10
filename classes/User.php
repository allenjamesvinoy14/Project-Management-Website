<?php
    class User{
        private $userid;
        private $username;
        private $email;
        private $password;
        private $token;
        private $verified;

        function __construct($username,$email,$password,$token,$verified)
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->token = $token;
            $this->verified = $verified;
        }
        function setUserId($userid)
        {
            $this->userid = $userid;
        }
        function setUsername($username)
        {
            $this->username = $username;
        }
        function setEmail($email)
        {
            $this->email = $email;
        }
        function setPassword($password)
        {
            $this->password = $password;
        }
        function setVerified($verified)
        {
            $this->verified = $verified;
        }
        function getUsername()
        {
            return $this->username;
        }
        function getEmail()
        {
            return $this->email;
        }
        function getPassword()
        {
            return $this->password;
        }
        function getToken()
        {
            return $this->token;
        }
        function getVerificationStatus()
        {
            return $this->verified;
        }
        function getUserId(){
            return $this->userid;
        }
    }
?>