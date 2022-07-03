<?php

namespace App\model;

class User extends Model
{
    public function register($data)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$data[name]','$data[email]','$data[password]')";
        return mysqli_query($this->conn, $sql);
    }

    public function findUserByEmail($email){

        $sql = "SELECT * FROM users where email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
      }


      public function login($email, $password){
        $sql = "SELECT * FROM users where email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $hashed_password = $row['password'];
        if(password_verify($password, $hashed_password)){
          return $row;
        } else {
          return false;
        }
      }
      

}
?>