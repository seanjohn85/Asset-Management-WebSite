 <?php
    
    /*this is used to delete a customer from the database*/

    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    //sets the customer no using the get request
    $customerNo = $_GET['customerNo'];
    //creates db connection
    $connection = Connection::getInstance();
    //uses connection in CustomerTableGateway
    $gateway = new CustomerTableGateway($connection);
    
    //deltes the customer from the database using the customer no
    $gateway->deleteCustomer($customerNo);
    
    //loads viewAllCustomers after delete
    header('Location: viewAllCustomers.php');

    
    
