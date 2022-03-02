<?php declare(strict_types=1);
    class Home extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function index() {
            $data = [];
            
            $this->view('home/index');
        }

        public function login() {
            $data = [
                'title' => 'Login Page',
                'userName' => '',
                'password' => '',

                'userNameError' => '',
                'passwordError' => ''
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => 'Login Page',
                    'userName' => trim($_POST['userName']),
                    'password' => trim($_POST['password']),

                    'userNameError' => '',
                    'passwordError' => ''
                ];

                
                if (empty($data['userName'])) {
                    //Empty userName field
                    $data['userNameError'] = "Please enter username or email!";
                }
                if (empty($data['password'])) {
                    //Empty password field
                    $data['passwordError'] = "Please enter password!";
                }

                //Validation
                if ($this->userModel->login($data)) {
                    //Redirect on success
                    header("location: ../home");

                } else {
                   
                }
            }

            $this->view('home/login', $data);
        }

        public function registration() {
            $data = [
                'userName' => '',
                'userEmail' => '',
                'password' => '',
                'passwordCheck' => '',
                'userFirstName' => '',
                'userLastName' => '',
                'refferalCode' => '',

                'userNameError' => '',
                'userEmailError' => '',
                'passwordError' => '',
                'passwordCheckError' => '',
                'userFirstNameError' => '',
                'userLastNameError' => '',
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'userName' => trim($_POST['userName']),
                    'userEmail' => trim($_POST['userEmail']),
                    'password' => trim($_POST['password']),
                    'passwordCheck' => trim($_POST['passwordCheck']),
                    'userFirstName' => trim($_POST['userFirstName']),
                    'userLastName' => trim($_POST['userLastName']),
                    'refferalCode' => trim($_POST['refferalCode']),
    
                    'userNameError' => '',
                    'userEmailError' => '',
                    'passwordError' => '',
                    'passwordCheckError' => '',
                    'userFirstNameError' => '',
                    'userLastNameError' => '',
                    'refferalCodeError' => ''
                ];

                $nameValidation = "/^[a-zA-Z0-9]*$/";

                if (empty($data['userName'])) {
                    //Empty userName field
                    $data['userNameError'] = "Please enter username!";
                } elseif (strlen($data['userName']) < 4) {
                    //Username length check
                    $data['userNameError'] = "Name should be atleast 4 characters long!";
                } elseif (!preg_match($nameValidation, $data['userName'])) {
                    //Preg match 
                    $data['userNameError'] = "Name can only contain letters and numbers!";
                }
                if (empty($data['userEmail'])) {
                    //Empty userEmail field
                    $data['userEmailError'] = "Please enter your email!";
                } elseif (!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)) {
                    $data['userEmailError'] = "Please enter a valid email address!";
                }
                if (empty($data['password'])) {
                    //Empty password field
                    $data['passwordError'] = "Please enter password!";
                } elseif (strlen($data['password']) < 8) {
                    $data['passwordError'] = "Password should be atleast 8 character long!";
                }
                if (empty($data['passwordCheck'])) {
                    //Empty passwordCheck field
                    $data['passwordCheckError'] = "Please enter password again!";
                }
                if ($data['password'] != $data['passwordCheck']) {
                    //Passwords doesnt match
                    $data['passwordError'] = "Passwords do not match!";
                }
                if (empty($data['userFirstName'] or empty($data['userLastName']))) {
                    //Empty name fields
                    $data['userNameError'] = "Please enter your name!";
                }
                //Check if userName taken
                if ($this->userModel->dbExistenceCheck(
                                            "users",
                                            "userName = :userName",
                                            array("userName"),
                                            array($data['userName'])
                )) {
                    $data['userNameError'] = "Username is taken!";
                }
                //Check if userEmail taken
                if ($this->userModel->dbExistenceCheck(
                                            "users",
                                            "userEmail = :userEmail",
                                            array("userEmail"),
                                            array($data['userEmail'])
                )) {
                    $data['userEmailError'] = "Email is taken!";
                }

                if (!empty($data['refferalCode'])) {
                    if ($this->userModel->dbExistenceCheck(
                                                "refferals",
                                                "refferalCode = :refferalCode",
                                                array("refferalCode"),
                                                array($data['refferalCode'])                       
                    )) {
                        $data['refferalCodeError'] = "Invalid refferal code";
                    } else {
                        if (!$this->userModel->updateRefferal(
                                                    "refferals",
                                                    "refferalCode = :refferalCode",
                                                    array("refferalCode"),
                                                    array($data['refferalCode'])
                        )) {
                            $data['refferalCodeError'] = "Refferal update error";
                        }
                    }
                }

                //Make sure that errors are empty
                if (empty($data['userNameError']) && 
                    empty($data['userEmailError']) && 
                    empty($data['passwordError']) && 
                    empty($data['passwordCheckError']) && 
                    empty($data['userFirstNameError']) && 
                    empty($data['userLastNameError']) &&
                    empty($data['refferalCodeError'])) {
                        
                    //Hashing the password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //Register user
                    if ($this->userModel->register($data)) {
                        //Redirect on success
                        header("location: home.php");
                    } else {
                        die("Something went wrong!");
                    }
                }
            }

            $this->view('home/registration', $data);
        }

        public function logout() {
            $this->view('home/logout');
        }
    }