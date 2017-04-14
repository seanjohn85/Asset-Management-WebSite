<?php
    
    class StockTableGateway
    {
        private $connection;
        
        //Sets a connection from a parameter
        
        public function __construct($c)
        {
            $this->connection = $c;
        }
        
        /*
         * Gets all data from the stock table and returns all data from this table
         * if there is an issue connecting kills this process
         */
        
        public function getStock()
        {
            //sql to det all stock
            $sql = "SELECT * FROM stockwebp";
                        
            $statement = $this->connection->prepare($sql);
            $status = $statement->execute();
            
            //kills app if any issues
            if(!$status)
            {
                die("Could not get the Stock information");
            }
            
            //returns all stock
            return $statement;
            
        }//closegetStock
        
        
        /*
         * This function gets all data from a selected row from the stock table 
         * the selecte row is passed in as a parameter when this method is called
         * returns this row, if the row no is invalid or an issue arises this function dies
         */
        
        public function getStockByNo($stockId)
        {
            //sql to get stock by stock id
            $sql = "SELECT * FROM stockwebp WHERE stockId = :stockId";
             
            $statement = $this->connection->prepare($sql);
            
            //uses the stockId paramater in the sql
            $pramaters = array("stockId" => $stockId);
            
            $status = $statement->execute($pramaters);
            
            //kills app if any issues
            if(!$status)
            {
                die("Could not get the stock information");
            }
            
            //returns stock with the id
            return $statement;
            
        }//close getStockById
        
        
        /*gets customers stock porfolio
         * uses the customer, stock and customerStock tables to find 
         * which custemers stock a customer has and how may shares they have
         */
        
        public function getStockByCustomerNo($customerNo) 
        {
            // execute a query to get all projects
            $sqlQuery =
                    "SELECT sto.*, pivot.qty
                    FROM stockwebp sto 
                    LEFT JOIN customerStockwebp pivot ON sto.stockId = pivot.stockId 
                    LEFT JOIN customerwebp cust ON pivot.customerNo = cust.customerNo 
                    WHERE cust.customerNo = :customerNo";

            $statement = $this->connection->prepare($sqlQuery);

            //inserts the customer no param into the sql
            $params = array(
                'customerNo' => $customerNo
            );
            $status = $statement->execute($params);

            //kills app if any issues
            if (!$status) {
                die("Could not retrieve stocks");
            }

            //returns results
            return $statement;
        }//close getStockByCustomerNo
        
        /*
         * matches the customer with a stock and gets the qty of shares they have
         * used when by ordering stock by the cart
         * ands this qty to the amount of new shares and preforms an update
         * using the below method see the buy stock page
         */
        public function getStockByCustomerNoStockId($customerNo, $stockId) 
        {
            //sql to getqty of shares a cust has of a stock
            $sqlQuery ="SELECT  pivot.qty
                    FROM customerStockwebp pivot
                    LEFT JOIN stockwebp sto  ON sto.stockId = pivot.stockId 
                    LEFT JOIN customerwebp cust ON pivot.customerNo = cust.customerNo 
                    WHERE cust.customerNo = :customerNo AND sto.stockId = :stockId";

            $statement = $this->connection->prepare($sqlQuery);

            //inserts the customer no and stock id into the sql
            $params = array(
                'customerNo' => $customerNo,
                'stockId' => $stockId
            );
            $status = $statement->execute($params);

            //kills if any issues
            if (!$status) {
                die("Could not retrieve stocks");
            }

            //returns qty value of portfolio
            return $statement;
            
        }//close getStockByCustomerNoStockId
        
        /*
         * matches the customer and stock tables and returns the total value of their 
         * portfolio used for the dashboard on my account page
         */
        
        public function getPortfolioValueByCustomerNo($customerNo) 
        {
            //sql to get the value of a customers portfolio
            $sqlQuery =
                    "SELECT round(sum(sto.currentPrice*pivot.qty), 2)
                    FROM stockwebp sto 
                    LEFT JOIN customerStockwebp pivot ON sto.stockId = pivot.stockId 
                    LEFT JOIN customerwebp cust ON pivot.customerNo = cust.customerNo 
                    WHERE cust.customerNo = :customerNo";

            $statement = $this->connection->prepare($sqlQuery);

            //uses the customer number as a parameter
            $params = array(
                'customerNo' => $customerNo
            );
            $status = $statement->execute($params);

            if (!$status) {
                die("Could not retrieve stocks");
            }

            //returns qty value of portfolio
            return $statement;
            
        }//close getPortfolioValueByCustomerNo
        
        /*
         * matches the customer and stock tables and returns the total value of their 
         * portfolio used for the dashboard on my account page
         */
        
        public function getstoByCustomerNo($customerNo) 
        {
            //sql to get the value of a customers portfolio
            $sqlQuery =
                    "SELECT sto.stockName, sto.currentPrice, pivot.qty
                    FROM stockwebp sto 
                    LEFT JOIN customerStockwebp pivot ON sto.stockId = pivot.stockId 
                    LEFT JOIN customerwebp cust ON pivot.customerNo = cust.customerNo 
                    WHERE cust.customerNo = :customerNo";

            $statement = $this->connection->prepare($sqlQuery);

            //uses the customer number as a parameter
            $params = array(
                'customerNo' => $customerNo
            );
            $status = $statement->execute($params);

            if (!$status) {
                die("Could not retrieve stocks");
            }

            //returns qty value of portfolio
            return $statement;
            
        }//close getPortfolioValueByCustomerNo
        
        
        /*
         * This function is used to create a new stock. A branch object containing the new stock details is passed
         * into this method as a paratmeter and these values are set into the sql statement so it writes to the table
         * if there is an issue the application dies 
         */
        
        public function newStock($stock)
        {
            //sql to insert a new stock to the database
            $sql = "INSERT INTO stockwebp (stockName, stockCode, qty, openPrice, currentPrice, image)" .
                    "VALUES (:stockName, :stockCode, :qty, :openPrice, :currentPrice, :image)";
            
            $statement = $this->connection->prepare($sql);
            
            //passes the values from the stock object to the sql
            $pramaters = array(
                
                "stockName"       => $stock->getStockName(),
                "stockCode"       => $stock->getStockCode(),
                "qty"             => $stock->getQty(),
                "openPrice"       => $stock->getOpenPrice(),
                "currentPrice"    => $stock->getCurrentPrice(),
                "image"           => $stock->getImage()
                
                    );
           
            //executes sql
            $status = $statement->execute($pramaters);
            
            //print_r($statement); testing
            
            //kills if any issues
            if(!$status)
            {
                
                die("Could not create a new Stock");
            }
            
            //returns result
            return $statement;
            
        }//close newStock
        
        /*
         * This function is used to update a Stock. A Stock object the new values with the current Stock No is passed
         * into this method as a paratmeter and the objects values are set into the sql statement so it updates the Stock table
         * if there is an issue the application dies 
         */
        
        public function updateStock($stock)
        {
            //sql to update a stock
            $sql = "UPDATE stockwebp SET " .
                    "stockName = :stockName, " .
                    "stockCode = :stockCode, " .
                    "qty = :qty, " .
                    "openPrice = :openPrice, ".
                    "currentPrice = :currentPrice, " .
                    "image= :image ".
                    "WHERE stockId = :stockId";
            
            
            $statement = $this->connection->prepare($sql);
            //sets the sql paramaters using the values from the stock object paramater
            $pramaters = array(
                
                "stockName"       => $stock->getStockName(),
                "stockCode"       => $stock->getStockCode(),
                "qty"             => $stock->getQty(),
                "openPrice"       => $stock->getOpenPrice(),
                "currentPrice"    => $stock->getCurrentPrice(),
                "stockId"         => $stock->getStockId(),
                "image"           => $stock->getImage()
                
                    );
            
            $status = $statement->execute($pramaters);
            
            //kills app
            if(!$status)
            {
                die("Could not update Stock");
            }
            
            //returns result
            return $statement;
            
        }//close updateStock
        
        /*
         * This method deletes a stock. The stock to be deleted is located using a stockId 
         * passed in as a parameter.  
         * if the stock cant be deleted application dies
         */
        
        public function deleteStock($stockId)
        {
            //sql to delete a stock
            $sql = "DELETE FROM stockwebp WHERE stockId = :stockId";
                
            $statement = $this->connection->prepare($sql);
           
           //stockId of stock to be deleted 
            $pramaters = array("stockId" => $stockId);
            
//            echo print_r($statement);
//            echo print_r($pramaters);
            
            $status = $statement->execute($pramaters);
            echo "Status".print_r($status);
            
            //kills app if any issues
            if(!$status)
            {
                die("Could not get the Stock information");
            }
            //returns result
            return $statement;
            
        }//close deleteStock
        
        /*
         * adds a stock to the customer
         * updates the customerStock table 
         * uses params qty, customerNo and stockId
         * only used if this is a stock the customer doesnt already own
         */
        
        public function addStockToCustomer($qty, $customerNo, $stockId) 
        {
            //sql to add a row to the customerStock table
            $sql = "INSERT INTO customerStockwebp(qty, customerNo, stockId)" .
                    "VALUES (:qty, :customerNo, :stockId)";

            $statement = $this->connection->prepare($sql);
            //uses the customerNo stockId and qty to create a new row in this table
            $params = array(
                "qty"         => $qty,
                "customerNo"  => $customerNo,
                "stockId"     => $stockId
            );

            $status = $statement->execute($params);

            if (!$status) {
                die("Could not insert stock");
            }
            //inserts to the database
            $id = $this->connection->lastInsertId();

            return $id;
            
        }//close addStockToCustomer

    
        /*
         * chages the amaount of shares of a stock a customer has
         * updates the customerStock table 
         * uses params qty, customerNo and stockId
         * only used if this is a stock the customer does already own this stock
         */
    
        public function updateCustStock($qty, $customerNo, $stockId) 
        {
            //sql to update customerStock table
            $sql = "UPDATE customerStockwebp SET ".
                    "qty = :qty ".
                    "WHERE customerNo = :customerNo".
                    " AND stockId = :stockId";

            $statement = $this->connection->prepare($sql);
            //sets new qty using the params passed into this method
            $params = array(

                "qty"         => $qty,
                "customerNo"  => $customerNo,
                "stockId"     => $stockId
            );
            //print_r($params);
            $status = $statement->execute($params);

            if (!$status) {
                die("Could not update stock");
            }
        }//close updateCustStock
        
    
    //deletes a cust stock item
    public function delCustStock($customerNo, $stockId) 
    {
            //sql to delete customerStock table
            $sql = "DELETE FROM customerStockwebp ".
                    "WHERE customerNo = :customerNo".
                    " AND stockId = :stockId";

            $statement = $this->connection->prepare($sql);
            //sets new qty using the params passed into this method
            $params = array(
                "customerNo"  => $customerNo,
                "stockId"     => $stockId
            );
            //print_r($params);
            $status = $statement->execute($params);

            if (!$status) 
            {
                die("Could not delete stock");
            }
        }//close delCustStock
        
    }//close StockTableGateway
    
    
    
?>