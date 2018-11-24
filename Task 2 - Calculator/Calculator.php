<?php 
    class Calculator{
        
        private $policy;
        private $commission_percentage = 17/100;

        private $base_price;
        private $commission;
        private $tax;
        private $total;

        private $instalment_price;
        private $instalment_commission;
        private $instalment_tax;
        private $instalment_total;



        public function __construct($carValue, $taxPercentage, $instalments){
            $currentDay = date('w');
            $currentHour = date('H');

            if($currentDay == 5 && $currentHour >= 15 && $currentHour < 20){
                $this->policy = 13/100;
            }
            else {
                $this->policy = 11/100;
            }

            $this->base_price = $this->policy * $carValue;
            $this->commission = $this->commission_percentage * $this->base_price;
            $this->tax = $taxPercentage * $this->base_price / 100;
            $this->total = $this->base_price + $this->commission + $this->tax;;

            if($instalments > 1){
                $this->instalment_price = $this->base_price / $instalments;
                $this->instalment_commission = $this->commission / $instalments;
                $this->instalment_tax = $this->tax / $instalments;
                $this->instalment_total = $this->total / $instalments;
            }
        }

        public function getPolicy(){
            return $this->policy;
        }

        public function getCommissionPercentage(){
            return $this->commission_percentage;
        }

        public function getBasePremium(){
            return $this->base_price;
        }

        public function getCommission(){
            return $this->commission;
        }

        public function getTax(){
            return $this->tax;
        }

        public function getTotal(){
            return $this->total;
        }

        public function getInstalmentPrice(){
            return $this->instalment_price;
        }

        public function getInstalmentCommission(){
            return $this->instalment_commission;
        }

        public function getInstalmentTax(){
            return $this->instalment_tax;
        }

        public function getInstalmentTotal(){
            return $this->instalment_total;
        }
    }
?>