<?php

namespace App\model;

class Currency extends Model
{
    public function all()
    {
        $sql = 'SELECT * FROM `currencies`';
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}