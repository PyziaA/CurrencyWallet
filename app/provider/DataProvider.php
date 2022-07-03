<?php

namespace App\provider;

class DataProvider {

public function getValue(){

    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    
    $dataNBP = file_get_contents("http://www.nbp.pl/Kursy/KursyA.html",  false, $context);
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
    return [
        'tabValue' =>  $currencyValue, // wartość pieniędzy 
        'tabScaler' => $currencyScaler // przelicznik 
    ];
}

}

?>