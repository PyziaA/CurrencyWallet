<?php

namespace App\Controller;

use App\model\Wallet;
use App\model\Currency;

class WalletController
{
    private $wallet;
    private $currencyBase;

    public function __construct()
    {
        $this->wallet = new Wallet();
        $this->currencyBase = new Currency();

        if (!session_has('user_id')) {
            redirect('user/login');
        }
    }


    public function index()
    {
        $title = 'All Money';
        $userid = session_get('user_id') ?? '';
        $start = $_GET['start'] ?? 0;
        $count = 5;
        $wallets = $this->wallet->paginate($start, $count, $userid);
        $total = $this->wallet->count($userid);
        $lastId = $this->wallet->selectLastId($userid);
        $lastId=$lastId['id'];
        $lastCurrency = $this->wallet-> selectLastCurrency($userid, $lastId);
        return view('wallet/index', compact('title', 'wallets', 'start', 'total', 'count', 'lastId', 'lastCurrency'));
    }
    
    public function create()
    {
        $title = 'Add your money!';
        $currencyBase = $this->currencyBase->all();
        return view('wallet/create', compact('title', 'currencyBase'));
    }

    public function store()
    {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $currency = trim($_POST['currency'] ?? '');
        $amount = trim($_POST['amount'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $userid = trim(session_get('user_id') ?? '');

        if ($currency && $amount && $price && $userid) {
            $result = $this->wallet->create($currency, $amount, $price, $userid);
            if ($result) {
                session_set('success', 'Created.');
                return redirect('wallet');
            }
        }
        session_set('fail', 'All fields are required.');
        return redirect('wallet/create');
    }

    public function edit($id)
    {
        $title = 'Edit Row';
        $wallet = $this->wallet->find($id);
        $currencyBase = $this->currencyBase->all();

        return view('wallet/edit', compact('title', 'wallet', 'currencyBase'));
    }

    public function update($id)
    {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $currency = trim($_POST['currency'] ?? '');
        $amount = trim($_POST['amount'] ?? '');
        $price = trim($_POST['price'] ?? '');

        if ($currency && $amount && $price) {
            $result = $this->wallet->update($currency, $amount, $price, $id);

            if ($result) {
                session_set('success', 'Row updated.');
                return redirect('wallet');
            }
        }

        session_set('fail', 'All fields are required.');
        return redirect('wallet/edit');
    }

    public function delete($id)
    {
        $result = $this->wallet->delete($id);
        if ($result) {
            session_set('success', 'Row deleted.');
            return redirect('wallet');
        }
        session_set('fail', 'Something went wrong.');
        return redirect('wallet');
    }

}
