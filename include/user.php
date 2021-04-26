<?php

class User extends mysqli
{
    function __construct()
    {
        parent::__construct("localhost","root","","user");
        if ($this->connect_error) {
            $_SESSION['error'] = "DB Connection error: ".$this->connect_error;
            return;
        }
    }

    public function register($data)
    {   
        $pass = password_hash($data['pass'],PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(4));
        $q = "SELECT * FROM users WHERE email='$data[email]'" ;
        $run = $this->query($q);
        if($run->num_rows>0){
            $_SESSION['error'] = "Email already exist.";
            return;
        }else{
            $q = "INSERT INTO users(name,email,password,token,active) VALUES('$data[name]','$data[email]',
                '$pass','$token',0)";
            $run = $this->query($q);
            if($run){
                $user=$this->getuser($data['email']);
                $_SESSION['id']=$user->id;
                $this->send_mail($user->email, $user->id, $token);
                header("location: http://localhost/user/activation.php");
            }else{
                $_SESSION['error'] = "Something went wrong";
            }

        }
    }

    public function getuser($email)
    {
        $q = "SELECT * FROM users WHERE email='$email'" ;
        $run = $this->query($q);
        if(false === $run){
            throw new Exception($this->error);
        }
        $row = $run->fetch_object();
        return $row;  
    }

    public function send_mail($email, $id, $token)
    {
        $subject = "Account Activation Code";

        $headers = "From: test app \r\n";
        $headers .= "Reply-To: abc@abc.com \r\n";
        $headers .= "CC: abc@abc.com \r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=ISO-8859-1 \r\n";
        $message = "<html><body>";
        $message .= "<h6>Your activation code</h6>";
        $message .= "<h3>$token</h3>";
        $message .= "<h1>or</h1>";
        $message .= '<h3>'.$_SERVER['SERVER_NAME'].'/user/activation.php?active='.$token.'&id='.$id.'<h/3>';
        $message .= '</body></html>';

        // echo $message;
        // die();
        mail($email,$subject,$message,$headers);
    }

    public function activate($id, $token)
    {
        $q = "UPDATE users SET active=1 WHERE id='$id' AND token='$token'";
        $run =$this->query($q);
        if($run){
            $user = $this->getuserbyid($id);
            $_SESSION['user']= $user;
            header("location: http://localhost/user/index.php");
        }else{
            $_SESSION['error'] = "Wrong Activation COde.";
        }
    }

    public function getuserbyid($id)
    {
        $q = "SELECT * FROM users WHERE id='$id'" ;
        $run = $this->query($q);
        $row = $run->fetch_object();
        return $row;  
    }

    public function auth($email,$pass){
        $q = "SELECT id FROM users WHERE email='$email' AND active =1" ;
        $run = $this->query($q);
        if($run->num_rows>0){
            $row=$run->fetch_object();

            $q = "SELECT * FROM users WHERE id='$row->id'" ;
            $run = $this->query($q);
            $row = $run->fetch_object();

            if(password_verify($pass,$row->password)){
                $_SESSION['id']= $row;
                header("location: http://localhost/user/index.php");
            }else{
                $_SESSION['error']="Invalid Password"; 
            }
        }else{
            $_SESSION['error']="Email doesn't Exist or User is not active";
        }
    }
}