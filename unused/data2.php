<?php 

//files required by this page database connections, gatewaytables and functions
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'classes/BranchTableGateway.php';
    require_once 'classes/StockTableGateway.php';
    
    //starts session
    start_session();
    
    //if the user is not logged in redirect to login_form
    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }

    //sets the session user in this session
    $user = $_SESSION['user'];
    //used by the toolbar to display the correct menu
    $_SESSION['role'] = $user->getRole();

    //if the user is not a customer redirect to home
    if($_SESSION['role'] !="customer")
    {
        header("Location: login_form.php");
    }

    //connects to the databae
    $connection = Connection::getInstance();
    //opens connection to the CustomerTableGateway
    $gateway = new CustomerTableGateway($connection);
    //sets the customer to get getCustByEmail using the username (email andusername match)
    $customer = $gateway->getCustByEmail($user->getUsername());
    //gets this customer row from the database
    $custRow = $customer->fetch(PDO::FETCH_ASSOC);
    //opens connection to the StockTableGateway
    $stockgateway = new StockTableGateway($connection);
    //opens connection to the BranchTableGateway
    $branchgateway = new BranchTableGateway($connection);
    
    $stock = $stockgateway->getStockByCustomerNo($custRow['customerNo']);
    //
    $portvalue = $stockgateway->getPortfolioValueByCustomerNo($custRow['customerNo']);


    if (!$custRow) {
            die("Invalid Customer");
    }

    $branch = $branchgateway->getBranchByNo($custRow['branchNo']);
    $brRow = $branch->fetch(PDO::FETCH_ASSOC);
    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);

$stock2 = $stockgateway->getStockByCustomerNo($custRow['customerNo']);
                
                
                $data = array();
    
   $stockRow2 = $stock2->fetch(PDO::FETCH_ASSOC);
                                    //loops through all the rows of this table on the database
                                    while($stockRow2)                            
                                    {
                                     $no =   intval(($stockRow2['qty']));
         $data[] = array("type"=>($stockRow2['stockName']), "value"=>$no);
        
    
        $stockRow2 = $stock2->fetch(PDO::FETCH_ASSOC); 
                                    }
        
       // echo'<pre>';
       // print_r($data);
        //echo'</pre>';
        
    
    
   echo json_encode($data);  
    
 

    
                
                ?>