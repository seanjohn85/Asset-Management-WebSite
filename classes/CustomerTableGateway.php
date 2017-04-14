<?php

    //uses customer objects
    require_once 'Customer.php';
    
    class CustomerTableGateway
    {
        private $connection;
        
        //Sets a connection from a parameter
        
        public function __construct($c)
        {
            $this->connection = $c;
        }
        
        /*
         * Gets all data from the customer table and returns all data from this table
         * if there is an issue connecting kills this process
         */
        
        public function getCustomer()
        {
            //selects all customers
            $sql = "SELECT * FROM customerwebp";
                        
            $statement = $this->connection->prepare($sql);
            $status = $statement->execute();
            
            if(!$status)
            {
                die("Could not get the Customer information");
            }
            
            //returns results
            return $statement;
            
        }//close getCustomer
        
        
        /*
         * This function gets all data from a selected row from the customer table 
         * the selecte row is passed in as a parameter when this method is called
         * returns this row, if the row no is invalid or an issue arises this function dies
         */
        
        public function getCustByNo($customerNo)
        {
            //sql to get a customer row from the database by customer number
            $sql = "SELECT * FROM customerwebp WHERE customerNo = :customerNo";
             
            $statement = $this->connection->prepare($sql);
            
            //passes the customer number passed into this class to locate customer row
            $pramaters = array("customerNo" => $customerNo);
            
            //executes sql with the custom no paramater
            $status = $statement->execute($pramaters);
            
            //kiils application
            if(!$status)
            {
                die("Could not get the Customer information");
            }
            
            //retunrs customer if found or 0 if no match
            return $statement;
            
        }//close getCustByNo
        
        /*This finds a customer in the databaes by and its email which matches a 
            the customers user account username. We need this to ensure when the customer
         * is logged in we are displaying their details
         */
        
        public function getCustByEmail($email)
        {
            //sql to get customer by email parm
            $sql = "SELECT * FROM customerwebp WHERE email = :email";
             
            $statement = $this->connection->prepare($sql);
            
            //puts the email into the sql statement
            $pramaters = array("email" => $email);
            //excutes
            $status = $statement->execute($pramaters);
            
            //if issues kills app
            if(!$status)
            {
                die("Could not get the Customer information");
            }
            
            //if found returns customer
            return $statement;
            
        }//close getCustByEmail
        
        /*This finds a customer in the database by and its branchNo. It displays all
         * customers of a branch used by staff menues only
         */
        
        public function getCustomerByBranchNo($branchNo) 
        {
            //sql to locate Customer By BranchNo
            $sqlQuery = 
                    "SELECT c.* "
                    . "FROM customerwebp c "
                    . "WHERE c.branchNo = :branchNo";

            $statement = $this->connection->prepare($sqlQuery);

            //used the branchNo passed into this method to find customers
            $params = array(
                "branchNo" => $branchNo
            );
            //excutes
            $status = $statement->execute($params);

            //kills if any issues
            if (!$status) {
                die("Could not get the Customer information");
            }
            
            //returns all custoemrs of this branchNo
            return $statement;
        }//close getCustomerByBranchNo
        
        /*gets a customers that have a certain stock
         * uses sql to acess 3 tables customer, stock and customerStock
         * returns all customer with this stockId
         */
    
        public function getCustomerByStockId($stockId) 
        {
            // execute a query to get all customers with a certain stock
            $sqlQuery =
                    "SELECT cust.*, pivot.qty, br.branchName, sto.currentPrice
                    FROM customerwebp cust
                    LEFT JOIN customerStockwebp pivot ON cust.customerNo = pivot.customerNo 
                    LEFT JOIN stockwebp sto ON pivot.stockId = sto.stockId 
                    LEFT JOIN branchwebp br ON cust.branchNo = br.branchNo
                    WHERE sto.stockId = :stockId";

            $statement = $this->connection->prepare($sqlQuery);

            //uses the stockId parameter in the above sql
            $params = array(
                'stockId' => $stockId
            );
            //executes
            $status = $statement->execute($params);

            //kills app if any issues
            if (!$status) {
                die("Could not retrieve Customers");
            }

            //returns all customer with this stockId
            return $statement;
            
        }//close getCustomerByStockId
        
        /*
         * This function is used to create a new Customer. A customer object containing the new customer details is passed
         * into this method as a paratmeter and these values are set into the sql statement so it writes to the table
         * if there is an issue the application dies 
         */
        
        public function newCustomer($customer)
        {
            //sql to insert a new customer row to the database
            $sql = "INSERT INTO customerwebp (branchNo, fName, lName, address, gender, mobileNo, email)" .
                    "VALUES (:branchNo, :fName, :lName, :address, :gender, :mobileNo, :email)";
 
            
            $statement = $this->connection->prepare($sql);
            //gets the values from the customer object and passes them to the sql
            $pramaters = array(
                "branchNo"      => $customer->getBranchNo(),
                "fName"         => $customer->getfName(),
                "lName"         => $customer->getlName(),
                "address"       => $customer->getAddress(),
                "gender"        => $customer->getGender(),
                "mobileNo"      => $customer->getMobileNo(),
                "email"         => $customer->getEmail()
                );
           
            //executes
            $status = $statement->execute($pramaters);
            
            print_r($statement);
            
            //kills app if any issues
            if(!$status)
            {
                
                die("Could not create a new Customer");
            }
            //returns result
            return $statement;
            
        }//close newCustomer
        
        public function newCust($fName)
        {
            //this sql is used to insert a new row of data in the branch table 
             $sql = "INSERT INTO customerwebp (fName)" .
                    "VALUES (:fName)";
            
            $statement = $this->connection->prepare($sql);
            //sets the values to the properties of the branch object passed into this class
            $pramaters = array(
                
                "fName"         => $fName,
                
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
            
        }//close cust
        
        /*
         * This function is used to update a Customer. A customer object the new values with the current customer No is passed
         * into this method as a paratmeter and the objects values are set into the sql statement so it updates the customer table
         * if there is an issue the application dies 
         */
        
        public function updateCustomer($customer)
        {
            //sql to update a customer
            $sql = "UPDATE customerwebp SET " .
                    "branchNo = :branchNo, " .
                    "fName = :fName, " .
                    "lName = :lName, " .
                    "address = :address, " .
                    "gender = :gender, " .
                    "mobileNo = :mobileNo, ".
                    "email = :email " .
                    "WHERE customerNo = :customerNo";
            
            
            $statement = $this->connection->prepare($sql);
            
            //sets the poperties using the customer object parameter as the sql paramaters
            $pramaters = array(
                
                "branchNo"      => $customer->getBranchNo(),
                "fName"         => $customer->getfName(),
                "lName"         => $customer->getlName(),
                "address"       => $customer->getAddress(),
                "gender"        => $customer->getGender(),
                "mobileNo"      => $customer->getMobileNo(),
                "email"         => $customer->getEmail(),
                "customerNo"    => $customer->getCustomerNo()
                
                    );
            
            $status = $statement->execute($pramaters);
            
            //kills app if any issues
            if(!$status)
            {
                die("Could not update customer");
            }
            
            //returns result
            return $statement;
            
        }//close update Customer
        
        /*
         * This method deletes a customer. The customer to be deleted is located using a customer no 
         * passed in as a parameter.  
         * if the customer cant be deleted application dies
         */
        
        public function deleteCustomer($customerNo)
        {
            //sql to delete a customer
            $sql = "DELETE FROM customerwebp WHERE customerNo = :customerNo";
                
            $statement = $this->connection->prepare($sql);
           
            //uses the customerNo paramater for the sql pramaters
            $pramaters = array("customerNo" => $customerNo);
            
//            echo print_r($statement);
//            echo print_r($pramaters);
            
            $status = $statement->execute($pramaters);
            echo "Status".print_r($status);
            
            if(!$status)
            {
                die("Could not get the customer information");
            }
            
            //returns relut
            return $statement;
            
        }//close deleteCustomer 
       
    }//close CustomerTableGateway
    
?>