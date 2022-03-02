<?php declare(strict_types=1);

    class Database {
        
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $statement;
        private $dbHandler;
        private $error;

        public function __construct() {
            $conn = 'mysql:host='. $this->dbHost .';dbname='. $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            try {
                 //Database connection
                $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);

            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        # Ultimate query

        # Insert
        //Should look like this->   "users",
        //                          array("user_id", "userName", "userEmail", "userPassword"),
        //                          array("MHLbykXOKa", "Martin", "k0ltaym4rtin@gmail.com", "HASHEDPASSWORD")

        public function dbInsert(string $tableName, array $columnNames, array $bindValues) {
            //Create a variable called "rowName" that contains all the row names required for successfull query
            $columnName = "";
            for ($n = 0; $n <= array_key_last($columnNames); $n++) { 
                $columnName .= ", " . $columnNames[$n];
            }
            $columnName = ltrim($columnName, ", ");


            //Assign placeholders for prepared statement
            $placeholders = "";
            for ($n = 0; $n <= array_key_last($columnNames); $n++) { 
                $placeholders .= ":" . $columnNames[$n] . ", ";
            }
            $placeholders = rtrim($placeholders, ", ");

            $stmt = "INSERT INTO " . $tableName . " (". $columnName .") VALUES (". $placeholders .")";
            //Prepare PDO query
            $this->statement = $this->dbHandler->prepare($stmt);

            //Bind values
            for ($n = 0; $n <= array_key_last($columnNames); $n++) {
                $type = null;
                switch (is_null($type)) {
                    case is_int($bindValues[$n]):
                        $type = PDO::PARAM_INT;
                        break;
                    
                    case is_bool($bindValues[$n]):
                        $type = PDO::PARAM_BOOL;
                        break;
                    
                    case is_null($bindValues[$n]):
                        $type = PDO::PARAM_NULL;
                        break;
                    
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }

                $parameter = ":" . $columnNames[$n];

                //Bind values to the statement
                $this->statement->bindValue($parameter, $bindValues[$n], $type);
            }
            if (!$this->statement->execute()) {
                return false;
            } else {
                return true;
            }
        }

        # Delete
        //Should look like this->   "users",
        //                          "userName = :userName AND user_id = :user_id",
        //                          array("userName", "user_id"),
        //                          array("Martin", "MHLbykXOKa")

        public function dbDelete(string $tableName, string $requirements, array $columnNames, array $bindValues) {

            $stmt = "DELETE FROM " . $tableName . " WHERE " . $requirements;
            $this->statement = $this->dbHandler->prepare($stmt);

            //Bind values
            for ($n = 0; $n <= array_key_last($columnNames); $n++) {
                $type = null;
                if (strstr($requirements, $columnNames[$n]) !== false) {
                    switch (is_null($type)) {
                        case is_int($bindValues[$n]):
                            $type = PDO::PARAM_INT;
                            break;
                        
                        case is_bool($bindValues[$n]):
                            $type = PDO::PARAM_BOOL;
                            break;
                        
                        case is_null($bindValues[$n]):
                            $type = PDO::PARAM_NULL;
                            break;
                        
                        default:
                            $type = PDO::PARAM_STR;
                            break;
                    }

                    $parameter = ":" . $columnNames[$n];

                    //Bind values to the statement
                    $this->statement->bindValue($parameter, $bindValues[$n], $type);
                    
                }
            }
            if (!$this->statement->execute()) {
                return false;
            } else {
                return true;
            }
        }

        # Update
        //Should look like this->   "users",
        //                          array("userName", "userEmail", "userLastName"),
        //                          array("spediGod", "martin.koltay@gmail.com", "David"),
        //                          "userName = :userName OR user_id = :user_id"

        public function dbUpdate(string $tableName, array $columnNames, array $bindValues, string $requirements) {
            //Test for matching number of values inside each array
            if (array_key_last($columnNames) !== array_key_last($bindValues)) {
                die("Error!");
            }

            //Create a string containing the column name and placeholders needed to be set
            $setString = "";
            for ($n = 0; $n <= array_key_last($columnNames); $n++) { 
                $setString .= ", " . $columnNames[$n] . " = :" . $columnNames[$n];
            }
            $setString = ltrim($setString, ", ");

            $stmt = "UPDATE " . $tableName . " SET " . $setString . " WHERE " . $requirements;
            $this->statement = $this->dbHandler->prepare($stmt);

            //Bind values
            for ($n = 0; $n <= array_key_last($columnNames); $n++) {
                $type = null;
                if (strstr($requirements, $columnNames[$n]) !== false) {
                    switch (is_null($type)) {
                        case is_int($bindValues[$n]):
                            $type = PDO::PARAM_INT;
                            break;
                        
                        case is_bool($bindValues[$n]):
                            $type = PDO::PARAM_BOOL;
                            break;
                        
                        case is_null($bindValues[$n]):
                            $type = PDO::PARAM_NULL;
                            break;
                        
                        default:
                            $type = PDO::PARAM_STR;
                            break;
                    }

                    $parameter = ":" . $columnNames[$n];

                    //Bind values to the statement
                    $this->statement->bindValue($parameter, $bindValues[$n], $type);
                }
            }
            //Execute statement
            if (!$this->statement->execute()) {
                return false;
            } else {
                return true;
            }
        }
        
        # Select
        //the number of values in "$bindValues" have to be the same as in the "$requirements"
        //Should look like this->   array(userName, user_id, userEmail),            <- can be NULL
        //                          "users",
        //                          "userName = :userName OR user_id = :user_id",   <- can be NULL
        //                          array(userName, user_id),                       <- can be NULL
        //                          array("Martin", "MHLbykXOKa");                  <- can be NULL

        public function dbSelect(array|null $returnValues, string $tableName, string|null $requirements, array|null $columnNames, array|null $bindValues) {
            //Run this if any of the values passed in empty
            if (is_null($requirements) || is_null($columnNames) || is_null($bindValues)) {
                //Create a variable called "returnValue" that contains the values needed to be returned
                $returnValue = "";
                if ($returnValues !== null) {
                    for ($n = 0; $n <= array_key_last($returnValues); $n++) { 
                        $returnValue .= "," . $returnValues[$n];
                    }
                    $returnValue = ltrim($returnValue, ",");

                } else {
                    $returnValue = "*";
                }

                $this->statement = $this->dbHandler->prepare("SELECT " . $returnValue . " FROM " . $tableName);

            } else {
                //Create a variable called "returnValue" that contains the values needed to be returned
                $returnValue = "";
                if ($returnValues !== null) {
                    for ($n = 0; $n <= array_key_last($returnValues); $n++) { 
                        $returnValue .= "," . $returnValues[$n];
                    }
                    $returnValue = ltrim($returnValue, ",");

                } else {
                    $returnValue = "*";
                }

                $stmt = "SELECT " . $returnValue . " FROM " . $tableName ." WHERE " . $requirements;
                $this->statement = $this->dbHandler->prepare($stmt);

                //Bind values
                for ($n = 0; $n <= array_key_last($bindValues); $n++) {
                    $type = null;
                    if (strstr($requirements, $columnNames[$n]) !== false) {
                        switch (is_null($type)) {
                            case is_int($bindValues[$n]):
                                $type = PDO::PARAM_INT;
                                break;
                            
                            case is_bool($bindValues[$n]):
                                $type = PDO::PARAM_BOOL;
                                break;
                            
                            case is_null($bindValues[$n]):
                                $type = PDO::PARAM_NULL;
                                break;
                            
                            default:
                                $type = PDO::PARAM_STR;
                                break;
                        }

                        $parameter = ':' . $columnNames[$n];

                        //Bind values to the statement
                        $this->statement->bindParam($parameter, $bindValues[$n], $type);
                    }
                }
            }
            //Execute statement
            $this->statement->execute();
        }

        //Return an array
        public function resultSet() {
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        //Return a specific row as an object
        public function singleRow() {
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        //Get's the row count
        public function rowCount() {
            return $this->statement->rowCount();
        }
    }