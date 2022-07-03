<?php

namespace App\services;

class ProductService{

    public function getValueOnBoughtDay ($actualData, $value){
        $code=$value['currency'];
        $scaler=$actualData['tabScaler'][$code]; //przelicznik z data provider -- array EUR- 1 USD -1 itd
        $cash=round($value['moneySum'],2); // wartość pieniędzy z bazy 
        return ($cash/$scaler);
       
    }

    public function getValueOnDay ($singleSum, $actualData){
            $name = $singleSum['currency']; // code z bazy 
            $singleSum = $singleSum['amountSum']; //suma z bazy 
            $scaler=$actualData['tabScaler'][$name]; // pobieranie odpowiedniego przelicznika z bazy 1, 100 
            $valueOnDay=$actualData['tabValue'][$name]; //aktualna wartość waluty dane z NBP
        return (($singleSum *$valueOnDay)/$scaler);
    }

}

?>