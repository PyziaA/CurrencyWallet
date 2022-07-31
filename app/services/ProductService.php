<?php

namespace App\services;

class ProductService{

    public function getValueOnBoughtDay ($value){
        $cash=round($value['moneySum'],2); // value of money (on purchase day) 
        return ($cash);
       
    }

    public function getValueOnDay ($singleSum, $actualData){
            $name = $singleSum['currency']; // code from database
            $singleSum = $singleSum['amountSum']; //total amount from database
            $scaler=$actualData['tabScaler'][$name]; // scaler from database
            $valueOnDay=$actualData['tabValue'][$name]; //current value of currency data from NBP
        return (($singleSum *$valueOnDay)/$scaler);
    }

}

?>