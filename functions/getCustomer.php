<?php


    // if getting form for first time retrieve details from database
    // into the formdata array
    if ($_SERVER['REQUEST_METHOD'] === "GET") 
    {
        //checks for a customer no if there is no customer no the application is killed
        if (!isset($_GET['customerNo'])) 
        {
            die("Invalid request here");
        }
        //sets customer no to match get request
        $customerNo = $_GET['customerNo'];
        
        /**
         * gets a customer row from the database uses the customer no to get that customer
         * and stores it in the array custrow
         */
        $connection = Connection::getInstance();
        $gateway = new CustomerTableGateway($connection);

        $branch = $gateway->getCustByNo($customerNo);

        $custRow = $branch->fetch(PDO::FETCH_ASSOC);
        
        if (!$custRow) 
        {
            //if the customer doses exist kills the application
            die("Invalid customer");
        }
  
        //fills formdata with the custoemrs information
        $formdata = array();
        $formdata['customerNo'] = $custRow['customerNo'];
        $formdata['branchNo'] = $custRow['branchNo'];
        $formdata['fName'] = $custRow['fName'];
        $formdata['lName'] = $custRow['lName'];
        $formdata['gender'] = $custRow['gender'];
        $formdata['address'] = $custRow['address'];
        $name = $formdata['fName']." " .$formdata['lName'];

        $formdata['email'] = $custRow['email'];

        $phone = $custRow['mobileNo'];

        //sets the session user in this session
        $user = $_SESSION['user'];
        
        /*       
         *              VIP
         * If a customer trys to hack and edit another
         * clients details deirect to their account page
         */
        if($_SESSION['role'] === 'customer')
        {
            
            
            //sets the customer to get getCustByEmail using the username (email andusername match)
            $cust = $gateway->getCustByEmail($user->getUsername());
            //gets this customer row from the database
            $custR = $cust->fetch(PDO::FETCH_ASSOC);
            //checks that user matches the get request cust no
            if($formdata['customerNo'] != $custR['customerNo'])
            {
                header('Location: myAccount.php');
            }
        }
 
    }
    //sets errors array
    if (!isset($errors)) 
    {
        $errors = array();
    }
    

