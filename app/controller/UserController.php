<?php

namespace App\Controller;
use App\model\User;

class UserController{

    private $user;


    public function __construct()
    {
        $this->user= new User();
        
    }
  
    public function register()
     
    {  
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
              'name' => trim($_POST['name']),
              'email' => trim($_POST['email']),
              'password' => trim($_POST['password']),
              'confirm_password' => trim($_POST['confirm_password']),
              'name_err' => '',
              'email_err' => '',
              'password_err' => '',
              'confirm_password_err' => ''
            ];
    
            // Validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter an email';
                // Validate name
                if(empty($data['name'])){
                  $data['name_err'] = 'Please enter a name';
                }
            } else{
              //Check Email
              if($this->user->findUserByEmail($data['email'])){
              $data['email_err'] = 'Email is already taken.';
              }
            }
    
            // Validate password
            if(empty($data['password'])){
              $password_err = 'Please enter a password.';     
            } elseif(strlen($data['password']) < 6){
              $data['password_err'] = 'Password must have atleast 6 characters.';
            }
    
            // Validate confirm password
            if(empty($data['confirm_password'])){
              $data['confirm_password_err'] = 'Please confirm password.';     
            } else{
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Password do not match.';
                }
            }
             
            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
              // SUCCESS - Proceed to insert
    
              // Hash Password
              $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
              //Execute
              if($this->user->register($data)){
                // Redirect to login
               session_set('success', 'You are now registered and can log in');
               redirect('user/login');
              } else {
                die('Something went wrong');
              }
               
            } else {
              // Load View
              return view('user/register', compact('data'));
              
            }
          } else {
            // IF NOT A POST REQUEST
    
            // Init data
            $data = [
              'name' => '',
              'email' => '',
              'password' => '',
              'confirm_password' => '',
              'name_err' => '',
              'email_err' => '',
              'password_err' => '',
              'confirm_password_err' => ''
            ];
    
            // Load View
            return view('user/register', compact('data'));
          }


    }

    public function login(){
 

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [       
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),        
          'email_err' => '',
          'password_err' => '',       
        ];

        // Check for email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email.';
        }

        // Check for name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name.';
        }

        // Check for user
        if($this->user->findUserByEmail($data['email'])){
          // User Found
        } else {
          // No User
          $data['email_err'] = 'This email is not registered.';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){

          // Check and set logged in user
          $loggedInUser = $this->user->login($data['email'], $data['password']);

          if($loggedInUser){
            // User Authenticated!
            $this->createUserSession($loggedInUser);
           
          } else {
            $data['password_err'] = 'Password incorrect.';
            // Load View
            return view('user/login', compact('data'));
          }
           
        } else {
          // Load View
          return view('user/login', compact('data'));
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
        ];

        // Load View
        return view('user/login', compact('data'));
      }
    }

    public function createUserSession($userCreate){
      session_set('user_id',$userCreate['id']);
      session_set('user_email',$userCreate['email']);
      session_set('user_name',$userCreate['name']);
      session_set('success', 'You are log in');
      redirect('home');
    }


    public function logout(){
      session_del('user_id');
      session_del('user_email');
      session_del('user_name');
      session_destroy();
      redirect('user/login');
    }
}

?>