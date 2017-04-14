<?php
    
    class Stock
    {
        //varaibles used in a stock object
        private $stockId;
        private $stockName;
        private $stockCode;
        private $qty;
        private $openPrice;
        private $currentPrice;
        private $image;
      
        /* 
         * constructor for a stock object maching the customer table
         */
        
        public function __construct($stockId, $stockName, $stockCode, $qty, $openPrice, $currentPrice, $image) 
        {
            $this->stockId      =     $stockId;
            $this->stockName    =     $stockName;
            $this->stockCode    =     $stockCode;
            $this->qty          =     $qty;
            $this->openPrice    =     $openPrice;
            $this->currentPrice =     $currentPrice;
            $this->image        =     $image;
        }
        
        //geters to get a stock object properties
        
        function getStockId() {
            return $this->stockId;
        }

        function getStockName() {
            return $this->stockName;
        }

        function getStockCode() {
            return $this->stockCode;
        }

        function getQty() {
            return $this->qty;
        }

        function getOpenPrice() {
            return $this->openPrice;
        }

        function getCurrentPrice() {
            return $this->currentPrice;
        }

        function setStockId($stockId) {
            $this->stockId = $stockId;
        }

        function setStockName($stockName) {
            $this->stockName = $stockName;
        }

        function setStockCode($stockCode) {
            $this->stockCode = $stockCode;
        }

        function setQty($qty) {
            $this->qty = $qty;
        }

        function setOpenPrice($openPrice) {
            $this->openPrice = $openPrice;
        }

        function setCurrentPrice($currentPrice) {
            $this->currentPrice = $currentPrice;
        }
        function getImage() {
            return $this->image;
        }




    }//close class
?>
