
<?php

include_once 'DBConnector.php';
include 'user.php';
$con=new DBConnector;

if(isset($_POST['btn-save']))
{

   $first_name=$_POST['first_name'];
   $last_name=$_POST['last_name'];
   $city=$_POST['city_name'];
   $username=$_POST['username'];
   $password=$_POST['password'];
   $user=new User($first_name,$last_name,$city,'',$username,$password);


    






    if (!$user->validateForm()) {
     $user->createFormErrorSessions();
     header("Refresh:0");
     die();
    }
    else if($user->isUserExist()){
      session_start();
      echo "Username has already been taken";
      header("Refresh:0");
     die();
      // echo "Username has already been taken";
    }


    $res=$user->save();
  if($res){
	echo "Save operation was successfull";
	
    }
else
{echo "An error occured!";}

}





//Code to be added after disabling js
// <tr>
//   <div id="form-errors">
//   php
//    session_start();
//    if(!empty($_SESSION['form_errors'])){
//     echo "".$_SESSION['form_errors'];
//     unset($_SESSION['form_errors']);
//    }
//  php
//  </div>
//  </td>
//  </tr>



















?>

















































<html>
  <head>
  	<title>Title goes here</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
  </head>
 <body>
 	<form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
 		<table align="centre">
     
 <tr>
  <div id="form-errors">
   <?php
    session_start();
    if(!empty($_SESSION['form_errors'])){
     echo "".$_SESSION['form_errors'];
     unset($_SESSION['form_errors']);
    }
  ?>
  </div>
  </td>
  </tr>






           <tr>
           <td><input type="text" name="first_name" required="" placeholder="First Name"/></td>
           </tr>

  	       <tr>
           <td><input type="text" name="last_name" placeholder="Last Name"/></td>
           </tr>

            <tr>
           <td><input type="text" name="city_name" placeholder="city"/></td>
           </tr>


           <tr>
           <td><input type="text" name="username" placeholder="Username"/></td>
           </tr>
     

          <tr>
           <td><input type="password" name="password" placeholder="Password"/></td>
           </tr>




           <tr>
           	<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>

           </tr>

            
    
           
<!--  -->













         </table>
<!--          <button type="submit" name="btn-show"><strong><a href="displayrecords.php">Show All Records</a></strong></button> -->
      </form>
       <button type="submit" name="btn-show"><strong><a href="displayrecords.php">Show All Records</a></strong></button>
   </body>  
</html>