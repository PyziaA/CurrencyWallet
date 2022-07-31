<?php

namespace App\Controller;

use App\model\Wallet;
use App\provider\DataProvider;
use App\services\ProductService;

class HomeController
{
    private $data;
    private $productService;

    public function __construct()
    {   
        $this->actualCurrencyValue = new DataProvider();
        $this->productService = new ProductService();
        $this->data = new Wallet();
        if(!session_has('user_id')){
            redirect('user/login');
        }
    }

    public function index()
    {
        $title = 'Home';
        $userid = session_get('user_id') ?? '';
        $data = $this->data->calculation($userid);
        $sum = $this->data->sum($userid);
        $actualData = $this -> actualCurrencyValue -> getValue(); 
        $substract=array();
        $cashNotAct=array();
        $cashAct=array();
        $profitLose=0;
// Value of cash held at the date of purchase:
        foreach($data as $value){
            $code=$value['currency']; //code EUR USD 
            $cashNotAct[$code]= $this ->productService->getValueOnBoughtDay($value);
        }
//Value of cash held today (profit/loss)
        foreach ($sum as $singleSum) {
            $name = $singleSum['currency'];
            $cashAct[$name]= $this -> productService -> getValueOnDay ($singleSum, $actualData);
            $substract[$name]= bcsub($cashAct[$name], $cashNotAct[$name], 2);
            $profitLose+= round($substract[$name],2);
        }
        return view('home', compact('title', 'cashNotAct', 'cashAct', 'substract', 'profitLose'));
    }

  
}
