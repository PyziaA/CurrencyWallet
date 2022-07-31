<?php

namespace App\provider;
use Exception;
use ErrorException;

class DataProvider {

public function getValue(){

    set_error_handler(
        function ($severity, $message, $file, $line) {
            throw new ErrorException($message, $severity, $severity, $file, $line);
        }
    );

    try {

    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $dataNBP = file_get_contents("http://www.nbpt.pl/Kursy/KursyA.html",  false, $context);
    $dataNBP = explode("tbody", $dataNBP);
    $dataNBP = explode("<tr", $dataNBP[1]);
    array_shift($dataNBP);
    $currencyValue = array(); 
    $currencyScaler = array();
  
    foreach ($dataNBP as $value) {

        $value = explode("<td class=", $value);
        $firstValue = $value[2];
        $secondValue = $value[3];
        $firstValue = strstr($firstValue, ">");
        $currencyCode = substr($firstValue, 1, -28);
        $secondValue= strstr( $secondValue, ">");
        $secondValue= substr( $secondValue, 1, -46);
        $currencyPrice = str_replace("</td", "",  $secondValue);
        $currencyPrice = str_replace(",", ".",  $currencyPrice);
        $currencyPrice= (float)  $currencyPrice;
        $currencyCode = explode(" ", $currencyCode);
        $currencyConversionFactor = $currencyCode[0]; 
        $currencyCode = $currencyCode[1];
        $currencyConversionFactor = (float) $currencyConversionFactor;
        $currencyCode = (string) $currencyCode;
        $currencyValue = array_merge($currencyValue, array($currencyCode =>  $currencyPrice));
        $currencyScaler= array_merge($currencyScaler, array($currencyCode => $currencyConversionFactor));
        
    }
} catch (Exception $e) {
    $currencyValue = array(); 
    $currencyScaler = array();
    $api=file_get_contents("http://api.nbp.pl/api/exchangerates/tables/a");
    $api=json_decode($api, 1);
    $api=$api[0]['rates'];
    foreach($api as $currencySingleValue){
        $currencySingleValue=array_slice($currencySingleValue,1);
        $key=$currencySingleValue['code'];
        $currencySingleValue[$key]=$currencySingleValue['mid'];
        unset($currencySingleValue['mid']);
        $currencySingleValue=array_slice($currencySingleValue,1);
        $currencyValue[$key]=$currencySingleValue[$key];
        $tabScaler= (float) 1;
        $currencyScaler[$key] = $tabScaler;
    }
}

restore_error_handler();
    return [
        'tabValue' =>  $currencyValue, // wartość pieniędzy 
        'tabScaler' => $currencyScaler // przelicznik 
    ];
}

}

?>