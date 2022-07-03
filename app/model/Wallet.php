<?php

namespace App\model;

class Wallet extends Model
{
    public function all()
    {
        $sql = 'SELECT * FROM wallet';
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function paginate($start = 0, $count = 10, $userid)
    {
        $sql = "SELECT * FROM wallet WHERE user_id = '$userid' limit $start, $count ";
        $result = mysqli_query($this->conn, $sql);
        return  mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function count($userid)
    {
        $sql = "SELECT * FROM wallet WHERE user_id = '$userid'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    public function create($currency, $amount, $price, $userid)
    {
        $sql = "INSERT INTO wallet (currency, amount, price, user_id) VALUES ('$currency','$amount','$price', '$userid')";
        return mysqli_query($this->conn, $sql);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM wallet where id = '$id'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function update($currency, $amount, $price, $id)
    {
        $sql = "UPDATE wallet SET  currency='$currency', amount='$amount', price='$price' WHERE id='$id'";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM wallet WHERE id='$id'";
        
        return mysqli_query($this->conn, $sql);
    }

    public function selectAll($userid)
    {
        $sql = "SELECT DISTINCT currency FROM wallet WHERE user_id = '$userid' ";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
 
    public function calculation($userid)
    {
        $sql = "SELECT `currency`, SUM(`amount`*`price`) AS moneySum FROM wallet WHERE user_id = '$userid' GROUP BY `currency`";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function sum($userid)
    {
        $sql = "SELECT `currency`, SUM(`amount`) AS amountSum FROM wallet WHERE user_id = '$userid' GROUP BY `currency`";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function selectLastId($userid)
    {
        $sql = "SELECT id FROM wallet WHERE user_id = '$userid' ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function selectLastCurrency($userid, $lastId)
    {
        $sql = "SELECT currency FROM wallet WHERE user_id = '$userid' ORDER BY id = '$lastId' DESC LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }
}
