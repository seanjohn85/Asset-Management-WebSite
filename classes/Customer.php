<?php
    
    class Customer
    {
        //varaibles used in a branch object
        private $customerNo;
        private $branchNo;
        private $fName;
        private $lName;
        private $address;
        private $gender;
        private $mobileNo;
        private $email;
        //private $openDate;
      
        /* 
         * constructor for a customer object maching the customer table
         */
        
        public function __construct($customerNo, $branchNo, $fName, $lName, $address, $gender, $mobileNo, $email ) 
        {
            $this->customerNo   =     $customerNo;
            $this->branchNo     =     $branchNo;
            $this->fName        =     $fName;
            $this->lName        =     $lName;
            $this->address      =     $address;
            $this->gender       =     $gender;
            $this->mobileNo     =     $mobileNo;
            $this->email        =     $email;
            //$this->openDate = $bropenDate;
        }
        
        //getter methods to get details from a customer object
        
        function getCustomerNo() {
            return $this->customerNo;
        }

        function getBranchNo() {
            return $this->branchNo;
        }

        function getFName() {
            return $this->fName;
        }

        function getLName() {
            return $this->lName;
        }

        function getAddress() {
            return $this->address;
        }

        function getGender() {
            return $this->gender;
        }

        function getMobileNo() {
            return $this->mobileNo;
        }

        function getEmail() {
            return $this->email;
        }

        function setCustomerNo($customerNo) {
            $this->customerNo = $customerNo;
        }

        function setBranchNo($branchNo) {
            $this->branchNo = $branchNo;
        }

        function setFName($fName) {
            $this->fName = $fName;
        }

        function setLName($lName) {
            $this->lName = $lName;
        }

        function setAddress($address) {
            $this->address = $address;
        }

        function setGender($gender) {
            $this->gender = $gender;
        }

        function setMobileNo($mobileNo) {
            $this->mobileNo = $mobileNo;
        }

        function setEmail($email) {
            $this->email = $email;
        }



    }//close class
?>
