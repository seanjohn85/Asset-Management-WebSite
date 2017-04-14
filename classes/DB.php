<?php
    //This class connects to the database
    class Connection
    {
        private static $connection = NULL;
        
        public static function getInstance()
        {
            //there is no connection
            if(Connection::$connection ===NULL)
            {
                //the below varaibles are used to connect
                //$host = "daneel";
                $host = "localhost";
                $database = "N00145905";
                $username = "N00145905";
                $password = "N00145905";
                
                //connect statement
                $dsn = "mysql:host=" .$host . ";dbname=" . $database;
                
                Connection::$connection = new PDO($dsn, $username, $password);
                
                if(!Connection::$connection)
                {
                    die("An issue has occured and the database could not be connected this time");
                }
                
            } //close if
            
            return Connection::$connection;
            
        }//close getInstance
        
    }//close class
?>