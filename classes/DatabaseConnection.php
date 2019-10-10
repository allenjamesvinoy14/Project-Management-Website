<?php
// DatabaseConnection class is a utility class that lets a person sets up database connection.
    class DatabaseConnection{
        public $db;

        function __construct(){
            $this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            if($this->db->connect_error){
                die("Database Error: ".$conn->connect_error);
            }
        }

        function getConnection(){
            return $this->db;
        }

        public static function findtype($var){
            $t = gettype($var);

            if($t=="integer")
                return "i";
            if($t=="double")
                return "d";
            if($t=="blob")  
                return "b";
            else   
                return "s";
        }
        //function 'query' enables the user to execute the query in a single line.
        public function __call($name,$arguments){
            if($name == "query")
            {
                if(count($arguments)==1){
                    $sql = $arguments[0];

                    $stmt = $this->db->prepare($sql);
                    if(!$stmt->execute())
                    {
                        return false;
                    }
                    $result = $stmt->get_result();
                    $stmt->close();
                    
                    if(empty($result))
                        return true;
                    else
                        return $result;
                }
                if(count($arguments)==2){
                    $sql = $arguments[0];
                    $params = $arguments[1];

                    $stmt = $this->db->prepare($sql);
                    
                    $types='';

                    foreach($params as $p)
                    {
                        $types = $types.self::findtype($p);
                    }
                    $stmt->bind_param($types,...$params);

                    $stmt->execute();
                    
                    $result = $stmt->get_result();
                    $stmt->close();
                    if(empty($result))
                        return true;
                    else
                        return $result;
                }
            }
        }
    }
?>