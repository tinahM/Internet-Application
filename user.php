<?php
include "crud.php";
include "authenticator.php";
class User implements Crud,Authenticator{//Authenticator
 private $user_id;
 private $first_name;
 private $last_name;
 private $city_name;
 private $username;
 private $password;



public function setUsername($username){
  $this->username=$username;
}
public function getUsername(){
  return $this->username=$username;
}
public function setPassword($password){
  $this->password=$password;
}
public function getPassword(){
  return $this->password=$password;
}




function __construct($first_name,$last_name,$city_name,$result,$username,$password){//add the new variables
	$this->first_name=$first_name;
	$this->last_name=$last_name;
	$this->city_name=$city_name;
  $this->result=$result;
  $this->username=$username;
  $this->password=$password;
}
   public function setUserId($user_id){
   	$this->user_id=$user_id;
   }

    public function getUserId(){
   	return $this->$user_id;
   }

public function save(){
	$conn=new DBConnector();
	$fn=$this->first_name;
	$ln=$this->last_name;
	$city=$this->city_name;
  $uname=$this->username;
  $this->hashPassword();
  $pass=$this->password;
  $res=mysqli_query($conn->conn,"INSERT INTO user(`first_name`,`last_name`,`user_city`,`username`,`password`) VALUES ('$fn','$ln','$city','$uname','$pass')") or die ("Error".mysqli_error($conn));
  return  $res;
    $jes->close();

}



public function isUserExist(){
$con=new DBConnector();
$username=$this->username;
$result=mysqli_query($con->conn,"SELECT username FROM user WHERE username='$username'")or die ("Error".mysqli_error($con));
if ($result->num_rows>0){
  return true;
}
else{return false;}

$con->close();

}


public function readAll(){
 // return null;
      $connection=new DBConnector();
      $result=mysqli_query($connection->conn,"SELECT * FROM `user`")or die ("ERROR".mysqli_error());
      return $result;
     
      //$clc->close();
}



 public function validateForm(){
  //return true if the values are empty
 $fn=$this->first_name;
 $ln=$this->last_name;
 $city=$this->city_name;
 if ($fn==''||$ln==''||$city==''){
  return false;
 }
 return true;
}

 public function createFormErrorSessions(){
  session_start();
  $_SESSION['form_errors']="All Fields are required";
 }










   public static function create($first_name,$last_name,$city_name,$result,$username,$password){
   $instance=new self();
   return $instance;
  }
//new method






public function hashPassword()
 {
  $this->password=password_hash($this->password,PASSWORD_DEFAULT);
}



public static function isPasswordCorrect($username,$password)
 {
  $cone=new DBConnector;
 $found=false;
 $res=mysqli_query($cone->conn,"SELECT * FROM user")or die ("Error".mysqli_error($con->conn));
  while($row=mysqli_fetch_array($res)){
   if(password_verify($password,$row['password'])&& $username==$row['username'])
   {
    $found=true;
  }

  }
 $cone->closeDatabase();
 return $found;
}



public function login()
{
  if($this->isPasswordCorrect())
  {
    header("Location:private_page.php");
   }
}

public static function logout()
 {
  session_start();
  unset($_SESSION['username']);
  session_destroy();
  header("Location:lab1.php");}

//public function createFormErrorSessions();

public static function createUserSession($username)
 {
  session_start();
 $_SESSION['username']=$username;
}












































public function readUnique(){return null;}
public function search(){return null;}
public function update(){return null;}
public function removeOne(){return null;}
public function removeAll(){return null;}







}

?>









