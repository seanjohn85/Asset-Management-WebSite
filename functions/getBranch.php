<?php


    // if getting form for first time retrieve details from database
    // into the formdata array
    if ($_SERVER['REQUEST_METHOD'] === "GET") 
    {
        //checks for a branch no if there is no branch no the application is killed
        if (!isset($_GET['branchNo'])) 
        {
            die("Invalid request here");
        }
        
        $branchNo = $_GET['branchNo'];
        
        /**
         * gets a branch row from the database uses the branch no to get that branch
         * and stores it in the array row
         */
        $connection = Connection::getInstance();
        $gateway = new BranchTableGateway($connection);

        $branch = $gateway->getBranchByNo($branchNo);

        $custRow = $branch->fetch(PDO::FETCH_ASSOC);
        if (!$custRow) 
        {
            //if the branch doses exist kills the application
            die("Invalid branch");
        }
  

        $formdata = array();
        $formdata['branchNo'] = $custRow['branchNo'];
        $formdata['name'] = $custRow['branchName'];
        $formdata['address'] = $custRow['address'];
        $name = $formdata['name'];

        //reformats opendate
        if ($custRow['openDate'] != Null || $custRow['openDate'] != False || $custRow['openDate'] != "") {
            $date = explode('-', $custRow['openDate']);
            $formdata['openDate'] = $date[2] . "/" . $date[1] . "/" . $date[0];
        }
        $formdata['opening'] = $custRow['openHours'];
        $formdata['webpage'] = "http://www.ma.com";

        $phone = $custRow['phoneNo'];

        //checks if a phone number is present
        if (strlen($phone) >1) {

            $formdata['phone'] = $phone;
        }  else {
            $formdata['phone'] = "Please Update Phone No:";
        }
    }
    

    if (!isset($errors)) 
    {
        $errors = array();
    }
    

