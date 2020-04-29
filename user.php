<?php
	include "crud.php";
	include "authenticator.php";
	include_once 'DBConnector.php';
	class User implements Crud, Authenticator{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;

		private $username;
		private $password;

		function __construct ($first_name,$last_name,$city_name,$username, $password){
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;
			$this->username = $username;
			$this->password = $password;
		}
		public static function create(){
			$instance = new self();
			return $instance;
		}
		public function setUsername($username){
			$this->username = $username;
		}
		public function getUsername(){
			return $this->username;
		}
		public function setPassword($password){
			$this->password = $password;
		}
		public function getPassword(){
			return $this->password;
		}
		public function setUser_id($user_id){
			$this->user_id = $user_id;
		}
		public function getUser_id(){
			return $this->$user_id;
		}
		public function save(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$uname = $this->username;
			$this->hashPassword();
			$pass = $this->password;
			$jes= mysqli_connect('localhost','root','','btc3205');
			$res = mysqli_query($jes,"INSERT INTO user(first_name,last_name,user_city,username,password) VALUES('$fn','$ln','$city','$uname','$pass')") or die("ERROR" . mysqli_error());
			return $res;
			$jes->close();
		}
		public function readAll(){
			
			$con = new DBConnector;
			$res = mysqli_query("SELECT id, first_name, last_name, user_city FROM user") or die("ERROR" . mysqli_error());

			if (mysqli_num_rows($res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"]. " - Firstname: " . $row["first_name"]. " - Lastname: ". $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";
}

			
		}
		public function readUnique(){
			return null;
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}
		public function valiteForm(){
			//Return true if the values are not empty
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this -> city_name;
			if($fn == " || $ln == " || $city == ""){
				return false;
			}
			return true;
		}
		public function createFormErrorSessions(){
			session_start();
			$_SESSION['form_errors'] = "All fields are required";
		}
		public function hashPassword(){
			$this->password=password_hash($this->password, PASSWORD_DEFAULT);
		}
		public function isPasswordCorrect(){
			$con = new DBConnector;
			$found=false;
			$res = mysqli_query("SELECT * FROM user") or die("Error" . mysqli_error());
			while($row=mysqli_fetch_array($res)){
				if(password_verify($this->getPassword(), $row['password'])&& $this->getUsername()==$row['username']){
					$found = true;
				}
			}
			$con->closeDatabase();
			return $found;
		}
		
		public function createUserSession(){
			session_start();
			$_SESSION['username'] = $this->getUsername();
		}
		public function logout(){
		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("Location:lab1.php");
	}
	public function login(){
			if($this->isPasswordCorrect()){
				header ("Location:private_page.php");
				}	
		}
}
?>