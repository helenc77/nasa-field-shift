<?php

    namespace hcUsers;

    use function hcFormHandling\xssPrevention as xssPrevention;
    use function hcDatabase\{dbConnect, dbSelect, dbInsert, dbClose, sanitizeBeforeInsert};

    class userLogin {

        protected $errors = [];

        protected $email;
        protected $password;
        protected $user;

        public $loggedin = 0;

        function __construct($post) {

            // Get the form data 
            $this->email = xssPrevention($post['email']);
            $this->password = xssPrevention($post['password']);
            
        }

        function validate() {    

            if (strlen($this->email) < 1)
                $this->errors[] = 'Please enter your email.';
            if (strlen($this->password) < 1)
                $this->errors[] = 'Please enter your password.';
            
        }

        function getUser() {

            $conn = dbConnect();
            $getUser = dbSelect($conn, 'users', array('id', 'name', 'email', 'password'), 'email = "'.$this->email.'"', 1, null);
            dbClose($conn);

            //user exists
            if ($getUser->num_rows > 0) {

                //user row
                $this->user  = $getUser->fetch_assoc();

                //verify password
                if (password_verify($this->password, $this->user['password'])) { 

                    $this->loggedin = 1; // user is logged in

                    // Set the session variables 
                    $_SESSION['hc_loggedin'] = true; 
                    $_SESSION['hc_id'] = $this->user['id']; 
                    $_SESSION['hc_email'] = $this->user['email']; 

                } else {

                    $this->errors[] = 'You entered the wrong username or password.';

                    $_SESSION['hc_loggedin'] = false; 
                }

            } else {

                $this->errors[] = 'You entered the wrong username or password.';

                $_SESSION['hc_loggedin'] = false; 

            }
        }

        function getErrors() {

            return $this->errors;

        }
    }

    class userLogout {

        function __construct() {

            $_SESSION['hc_loggedin'] = false; 
            unset($_SESSION['hc_id']);
            unset($_SESSION['hc_email']);

        }
    }

    class userRegister {

        protected $errors = [];

        protected $name;
        protected $email;
        protected $password;
        protected $confirm_password;

        protected $existingUser;

        public $insertNewUser;

        function __construct($post) {

            // Get the form data 
            $this->name = xssPrevention($post['name']);
            $this->email = xssPrevention($post['email']);
            $this->password = xssPrevention($post['password']);
            $this->confirm_password = xssPrevention($post['confirm_password']);

        }

        function validate() {    

            if (strlen($this->name) < 1)
                $this->errors[] = 'Please enter your display name.';
            if (strlen($this->email) < 1)
                $this->errors[] = 'Please enter your email.';
            if (strlen($this->password) < 1)
                $this->errors[] = 'Please enter a password.';
            if (strlen($this->confirm_password) < 1)
                $this->errors[] = 'Please confirm your password.';
            
        }

        function insert() {   

            $conn = dbConnect();

            //check not already registered
            $this->existingUser = checkForExistingUserEmail($this->email);

            //user already exists
            if ($this->existingUser == 1) {

                $this->errors[] = 'You have already registered.';
        
            } else {
        
                // Hash the password 
                $password = password_hash($this->password, PASSWORD_DEFAULT); 
        


                //sanitize
                $values = ['name' => $this->name, 'email' => $this->email];
                $sanitizedValues = sanitizeBeforeInsert($values);
        
                $this->insertNewUser = dbInsert ($conn, 'users', array('name', 'email', 'password'), 
                array($sanitizedValues['name'], $sanitizedValues['email'], $password));

            }

            dbClose($conn);

        }


        function getErrors() {

            return $this->errors;

        }

    }

    function checkForExistingUserEmail($email) {

        $userExists = 0;

        //check not already registered
        $conn = dbConnect();
        $existingUser = dbSelect($conn, 'users', array('id'), 'email = "'.$email.'"', 1, null); 
        dbClose($conn);

        //user already exists
        if ($existingUser->num_rows > 0) {

            $userExists = 1;

        }

        return $userExists;

}

?>