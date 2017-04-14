<?php
    
    class Branch
    {
        //varaibles used in a branch object
        
        private $branchNo;
        private $branchName;
        private $address;
        private $phoneNo;
        private $openHours;
        private $openDate;
      
        /* 
         * constructor for a branch object maching the branch table
         */
        
        public function __construct($brno, $brName, $brAddress, $brPhone, $brHours, $bropenDate) 
        {
            $this->branchNo = $brno;
            $this->branchName = $brName;
            $this->address = $brAddress;
            $this->phoneNo = $brPhone;
            $this->openHours = $brHours;
            $this->openDate = $bropenDate;
            //$this->createdDate = $brCreatedDate;  
        }
        
        
        /**********************************************/
       
        //The below fuctions are used to get a varaible (db column data) from a branch object
        
        public function getBranchNo() 
        {
            return $this->branchNo;
        }

        public function getBranchName() 
        {
            return $this->branchName;
        }

        function getAddress()
        {
            return $this->address;
        }

        function getPhoneNo() 
        {
            return $this->phoneNo;
        }

        function getOpenHours() 
        {
            return $this->openHours;
        }

        function getOpenDate() 
        {
            return $this->openDate;
        }

        function getCreatedDate() 
        {
            return $this->createdDate;
        }
        /**********************************************/
        
        //These methods are used to set the variables(column data on db) of a branch object
        //currently not in use

        function setBranchNo($branchNo) 
        {
            $this->branchNo = $branchNo;
        }

        function setBranchName($branchName) 
        {
            $this->branchName = $branchName;
        }

        function setAddress($address) 
        {
            $this->address = $address;
        }

        function setPhoneNo($phoneNo) 
        {
            $this->phoneNo = $phoneNo;
        }

        function setOpenHours($openHours) 
        {
            $this->openHours = $openHours;
        }

        function setOpenDate($openDate) 
        {
            $this->openDate = $openDate;
        }

        function setCreatedDate($createdDate) 
        {
            $this->createdDate = $createdDate;
        }
        
        /**********************************************/

    }//close class
    
?>
