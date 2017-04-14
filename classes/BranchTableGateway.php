<?php

    
    //uses a branch object
    require_once 'Branch.php';
    
    class BranchTableGateway
    {
        private $connection;
        
        //Sets a connection from a parameter
        
        public function __construct($c)
        {
            $this->connection = $c;
        }
        
        /*
         * Gets all data from the branch table and returns all data from this table
         * if there is an issue connecting kills this process
         */
        
        public function getBranches()
        {
            //sql to get all branches
            $sql = "SELECT * FROM branchwebp";
            //uses conncection with the sql to connect to the database with the query            
            $statement = $this->connection->prepare($sql);
            $status = $statement->execute();
            
            //if there is an isse kiils app
            if(!$status)
            {
                die("Could not get the Branch information");
            }
            
            //returns all rows from branch table
            return $statement;
            
        }//closegetBranches
        
        
        /*
         * This function gets all data from a selected row from the branch table 
         * the selecte row is passed in as a parameter when this method is called
         * returns this row, if the row no is invalid or an issue arises this function dies
         */
        
        
        public function getBranchByNo($branchNo)
        {
            //sql statement to find a branch by branch no
            $sql = "SELECT * FROM branchwebp WHERE branchNo = :branchNo";
             
            $statement = $this->connection->prepare($sql);
            
            //uses the branch no paramater in this method to find locate a branch 
            $pramaters = array("branchNo" => $branchNo);
            
            //executes sql with the branchNo
            $status = $statement->execute($pramaters);
            
            //if database issue kill app
            if(!$status)
            {
                die("Could not get the Branch information");
            }
            //if found returns branch or null
            return $statement;
            
        }//close getBranchById
        
        

        /*
         * This function is used to create a new branch. A branch object containing the new branch details is passed
         * into this method as a paratmeter and these values are set into the sql statement so it writes to the table
         * if there is an issue the application dies 
         */
        
        public function newBranch($branch)
        {
            //this sql is used to insert a new row of data in the branch table 
            $sql = "INSERT INTO branchwebp (branchName, address, phoneNo, openHours, openDate)" .
                    "VALUES (:branchName, :address, :phoneNo, :openHours, :openDate)";
            
            $statement = $this->connection->prepare($sql);
            //sets the values to the properties of the branch object passed into this class
            $pramaters = array(
                
                "branchName"    => $branch->getBranchName(),
                "address"       => $branch->getAddress(),
                "phoneNo"       => $branch->getPhoneNo(),
                "openHours"     => $branch->getOpenHours(),
                "openDate"      => $branch->getOpenDate()
                
                    );
           
            //executes
            $status = $statement->execute($pramaters);
            
            //print_r($statement); used for testing
            
            //kills if issue
            if(!$status)
            {
                
                die("Could not create a new Branch");
            }
            
            return $statement;
            
        }//close newbranch
        
        /*
         * This function is used to update a Branch. A branch object the new values with the current Branch No is passed
         * into this method as a paratmeter and the objects values are set into the sql statement so it updates the Branch table
         * if there is an issue the application dies 
         */
        
        public function updateBranch($branch)
        {
            //this sql is used to update a branch in the databse
            $sql = "UPDATE branchwebp SET " .
                    "branchName = :branchName, " .
                    "address = :address, " .
                    "phoneNo = :phoneNo, " .
                    "openHours = :openHours, ".
                    "openDate = :openDate " .
                    "WHERE branchNo = :branchNo";
            
            
            $statement = $this->connection->prepare($sql);
            //updates the branch by locating it using the branch objects branch no and sets the
            //new properties from the branch object
            $pramaters = array(
                
                "branchName"    => $branch->getBranchName(),
                "address"       => $branch->getAddress(),
                "phoneNo"       => $branch->getPhoneNo(),
                "openHours"     => $branch->getOpenHours(),
                "openDate"      => $branch->getOpenDate(),
                "branchNo"      => $branch->getBranchNo()
                
                    );
            
            $status = $statement->execute($pramaters);
            
            //kills app if issue
            if(!$status)
            {
                die("Could not update branch");
            }
            //returns result
            return $statement;
            
        }//close update branch
        
        /*
         * This method deletes a branch. The branch to be deleted is located using a branch no 
         * passed in as a parameter.  
         * if the branch cant be deleted application dies
         */
        
        public function deleteBranch($branchNo)
        {
            //sql to delete a branch
            $sql = "DELETE FROM branchwebp WHERE branchNo = :branchNo";
                
            $statement = $this->connection->prepare($sql);
           
            //deletes the branch from the system using the branchNo passed into this method
            $pramaters = array("branchNo" => $branchNo);
            
//            echo print_r($statement);
//            echo print_r($pramaters);
            
            $status = $statement->execute($pramaters);
            echo "Status".print_r($status);
            
            //kills app
            if(!$status)
            {
                die("Could not get the Branch information");
            }
            
            //returns result
            return $statement;
            
        }//close gdeleteBranch
        
    }//close BranchTableGateway
    
?>