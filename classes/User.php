<?php
    class User{
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
            return $username;
        }
        function getEmail()
        {
            return $email;
        }
        function getPassword()
        {
            return $password;
        }
        function getToken()
        {
            return $token;
        }
        function getVerificationStatus()
        {
            return $verified;
        }
    }
?>