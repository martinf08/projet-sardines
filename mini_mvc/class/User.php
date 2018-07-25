<?php 
    class User {
        
        private $userid;
        private $email;
        private $nickname;
        private $indentifier;


    
        /**
         * Get the value of indentifier
         */ 
        public function getIndentifier()
        {
                return $this->indentifier;
        }

        /**
         * Set the value of indentifier
         *
         * @return  self
         */ 
        public function setIndentifier($indentifier)
        {
                $this->indentifier = $indentifier;

                return $this;
        }

        /**
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Set the value of nickname
         *
         * @return  self
         */ 
        public function setNickname($nickname)
        {
                $this->nickname = $nickname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of userid
         */ 
        public function getUserid()
        {
                return $this->userid;
        }

        /**
         * Set the value of userid
         *
         * @return  self
         */ 
        public function setUserid($userid)
        {
                $this->userid = $userid;

                return $this;
        }
    }
?>