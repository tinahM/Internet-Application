<?php
include "crud.php";

class User implements Crud{
 private $user_id;
 private $first_name;
 private $last_name;
 private $city_name;


function __construct($first_name,$last_name,$city_name){
	$this->first_name=$first_name;
	$this->last_name=$last_name;
	$this->city_name=$city_name;

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
	//$jes=mysqli_connect('localhost','root','','btc3205');
	$res=mysqli_query($conn->conn,"INSERT INTO `user`(first_name,last_name,user_city)VALUES ('$fn','$ln','$city')") or die ("ERROR".mysqli_error());
	return $res;
	//Closing the database connection
    $jes->close();

}


public function readAll(){
$mysqli=new DBConnector();
$con=$mysqli->conn;
$query="SELECT * FROM `btc3205`";
// $rest=mysqli_query($mysqli->conn,"SELECT * FROM `btc3205`");
// echo "<b> <center>DataBase Records</center> </b> <br> <br>";
 
if ($rest= $con->query($query)) {
 
    while ($row = $rest->fetch_assoc()) {
        $field1name = $row["first_name"];
        $field2name = $row["last_name"];
        $field3name = $row["city_name"];
     echo '<tr>
     <td>'. $field1name.'</td>
     <td>'. $field2name.'</td>
     <td>'. $field3name.'</td>      
     </tr>';
    }
 
/*freeresultset*/
$result->free();
}













// $jessi=mysqli_connect('localhost','root','','btc3205');
// $ressi=mysqli_query($jessi,"SELECT * FROM `btc3205`") or die ("ERROR".mysqli_error());
// return $ressi;
// $jessi->close();//close the database connection






}








//public function readAll(){return null;}
public function readUnique(){return null;}
public function search(){return null;}
public function update(){return null;}
public function removeOne(){return null;}
public function removeAll(){return null;}







}

?>










?>