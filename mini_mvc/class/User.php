
<?php

	
    class User{
        private $id_user;
        private $nickname;
        private $identifier;
		private $email;
		private $last_login;
		private $password;
		private $avatar;
		private $account_status;
		private $staff;
		private $admin;
		private $balance;
		private $account_creation_date;
		private $confirmPassword;

		public function __construct($userdatas)
		{
			//Hydrate
			if($userdatas){

				foreach ($userdatas as $key => $value) {
					$method = 'set' . ucfirst($key);
					if (method_exists($this, $method)) {
						$this->$method($value);
					}
					
				}
			}
		}

        /**
         * Get the value of id_user
         */ 
        public function getId_user()
        {
                return $this->id_user;
        }

        /**
         * Set the value of id_user
         *
         * @return  self
         */ 
        public function setId_user($id_user)
        {
                $this->id_user = $id_user;

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
         * Get the value of identifier
         */ 
        public function getIdentifier()
        {
                return $this->identifier;
        }

        /**
         * Set the value of identifier
         *
         * @return  self
         */ 
        public function setIdentifier($identifier)
        {
                $this->identifier = $identifier;

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
		 * Get the value of last_login
		 */ 
		public function getLast_login()
		{
				return $this->last_login;
		}

		/**
		 * Set the value of last_login
		 *
		 * @return  self
		 */ 
		public function setLast_login($last_login)
		{
				$this->last_login = $last_login;

				return $this;
		}

		/**
		 * Get the value of password
		 */ 
		public function getPassword()
		{
				return $this->password;
		}

		/**
		 * Set the value of password
		 *
		 * @return  self
		 */ 
		public function setPassword($password)
		{
				$this->password = $password;

				return $this;
		}

		/**
		 * Get the value of avatar
		 */ 
		public function getAvatar()
		{
				return $this->avatar;
		}

		/**
		 * Set the value of avatar
		 *
		 * @return  self
		 */ 
		public function setAvatar($avatar)
		{
				$this->avatar = $avatar;

				return $this;
		}

		/**
		 * Get the value of account_status
		 */ 
		public function getAccount_status()
		{
				return $this->account_status;
		}

		/**
		 * Set the value of account_status
		 *
		 * @return  self
		 */ 
		public function setAccount_status($account_status)
		{
				$this->account_status = $account_status;

				return $this;
		}

		/**
		 * Get the value of staff
		 */ 
		public function getStaff()
		{
				return $this->staff;
		}

		/**
		 * Set the value of staff
		 *
		 * @return  self
		 */ 
		public function setStaff($staff)
		{
				$this->staff = $staff;

				return $this;
		}

		/**
		 * Get the value of admin
		 */ 
		public function getAdmin()
		{
				return $this->admin;
		}

		/**
		 * Set the value of admin
		 *
		 * @return  self
		 */ 
		public function setAdmin($admin)
		{
				$this->admin = $admin;

				return $this;
		}

		/**
		 * Get the value of balance
		 */ 
		public function getBalance()
		{
				return $this->balance;
		}

		/**
		 * Set the value of balance
		 *
		 * @return  self
		 */ 
		public function setBalance($balance)
		{
				$this->balance = $balance;

				return $this;
		}

		/**
		 * Get the value of account_creation_date
		 */ 
		public function getAccount_creation_date()
		{
				return $this->account_creation_date;
		}

		/**
		 * Set the value of account_creation_date
		 *
		 * @return  self
		 */ 
		public function setAccount_creation_date($account_creation_date)
		{
				$this->account_creation_date = $account_creation_date;

				return $this;
		}

		/**
		 * Get the value of confirmPassword
		 */ 
		public function getConfirmPassword()
		{
				return $this->confirmPassword;
		}

		/**
		 * Set the value of confirmPassword
		 *
		 * @return  self
		 */ 
		public function setConfirmPassword($confirmPassword)
		{
				$this->confirmPassword = $confirmPassword;

				return $this;
		}
   }
?>