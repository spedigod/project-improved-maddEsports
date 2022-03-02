<?php declare(strict_types=1);

    class User {
        private $db;
        public function __construct() {
            $this->db = new Database;
        }

        # Login the user
        public function login(array $data) {
            //Test if users exists with these credentials
            if ($this->dbExistenceCheck("users", "userName = :userName OR userEmail = :userEmail", array("userName", "userEmail"), array($data['userName'], $data['userName']))) {
                //Select password for comparison
                $this->db->dbSelect(array("userPassword"), "users", "userName = :userName OR userEmail = :userEmail", array("userName", "userEmail"), array($data['userName'], $data['userName']));
                if ($this->db->rowCount() > 0) {
                    $result = $this->db->singleRow();
                    $userPassword = $result->userPassword;
                    //Compare
                    if (password_verify($data['password'], $userPassword)) {
                        //Create session
                        $this->db->dbSelect(array("user_id"), "users", "userName = :userName", array("userName"), array($data['userName']));
                        $result = $this->db->singleRow();
                        $_SESSION['user_id'] = $result->user_id;
                        
                        //Successfull login
                        return true;

                    } else {
                        return $data['userPasswordError'] = "Your password is incorrect";
                    }
                } else {
                    return $data['userNameError'] = "There is no account with such username!";
                }
            } else {
                return $data['userNameError'] = "There is no account with such username!";
            }
        }

        # Register the user
        public function register(array $data) {
            //Generate user_id
            $user_id = $this->generateUniqueID(10, "users", "user_id = :user_id", array("user_id"));

            if ($this->db->dbInsert(
                            "users",
                            array("user_id", "userName", "userEmail", "userPassword", "userFirstName", "userLastName", "usedRefferal", "isAdmin", "userLevel", "inGroup", "isValid", "isCoach"),
                            array($user_id, $data['userName'], $data['userEmail'], $data['password'], $data['userFirstName'], $data['userLastName'], $data['refferalCode'], 0, 1, 0, 1, 0))) {
                                
                //Test for existing user in refferals db
                if (!$this->dbExistenceCheck("refferals", "user_id = :user_id", array("user_id"), array($user_id))) {
                    //Create refferal and insert
                    $refferalCode = $this->generateUniqueID(20, "refferals", "refferalCode = :refferalCode", array("refferalCode"));
                    
                    if ($this->db->dbInsert("refferals", array("user_id", "refferalCode", "refferalScore"), array($user_id, $refferalCode, 0))) {

                        //Test for existing userdata in userdata db
                        if (!$this->dbExistenceCheck("userdata", "user_id = :user_id", array("user_id"), array($user_id))) {

                            //Create userdata for new user
                            if ($this->db->dbInsert("userdata", array("user_id", "verified", "premium", "friendCount", "eventCount", "levelCount"), array($user_id, 0, 0, 0, 0, 1))) {
                                
                                //Test for existing userlevel in userlevel db
                                if (!$this->dbExistenceCheck("userlevel", "user_id = :user_id", array("user_id"), array($user_id))) {
                                    
                                    //Create userlevel for new user
                                    if ($this->db->dbInsert("userlevel", array("user_id"), array($user_id))) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        # Check the database for existing data
        public function dbExistenceCheck(string $tableName, string $requirements, array $columnNames, array $bindValues) {
            $this->db->dbSelect(null, $tableName, $requirements, $columnNames, $bindValues);
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        # Update the refferal score
        public function updateRefferal(string $tableName, string $requirements, array $columnNames, array $bindValues) {
            $this->db->dbSelect(null, $tableName, $requirements, $columnNames, $bindValues);
            if ($this->db->rowCount() > 0) {
                $result = $this->db->singleRow();
                $refferalScore = $result->reffelarScore + 10;
                if ($this->db->dbUpdate($tableName, array("refferalScore"), array($refferalScore), $requirements)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function generateUniqueID(int $length, string $searchTable, string $requirements, array $columnNames) {
            $a = 1;
            while ($a = 1) {
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
            
                for ($i = 0; $i < $length; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
                if (!$this->dbExistenceCheck($searchTable, $requirements, $columnNames, array($randomString))) {
                    break;
                }
            }
            return $randomString;
        }
    }