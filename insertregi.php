<?php
include 'configpost.php';

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$cPassword=$_POST['cpassword'];
$number=$_POST['number'];


$duplicate_username= mysqli_query($conn,"SELECT * FROM `user_login` WHERE name='$name'");
$duplicate_mobile= mysqli_query($conn,"SELECT * FROM `user_login` WHERE number='$number'");
$duplicate_email= mysqli_query($conn,"SELECT * FROM `user_login` WHERE email='$email'");

$username_patt = "/[A-Za-z _]{3,20}/";
$mobile_patt ="/(\+88 |88)?-?01[3-9]{1}[0-9]{8}$/";
$pass_patt="/[a-zA-Z0-9]/";
$email_patt="/[a-z _]{1}[a-z 0-9 _]{3,20}@(gmail|yahoo|outlook){1}\.com/";

if(mysqli_num_rows(
  $duplicate_username)){
    echo"<script>alert('Username Already taken!!')</script>";

  }

  else if(mysqli_num_rows(
    $duplicate_mobile)){
      echo"<script>alert('Mobilee Already taken!!')</script>";
  
    }
    else if(mysqli_num_rows(
      $duplicate_email)){
        echo"<script>alert('Email Already taken!!')</script>";
    
      }
      

else if(!preg_match($username_patt,$name)){

  echo"<script>alert('Invalid Username!!')</script>";
  
  echo"<script>location.href='regi.php'</script>";
}

else if(!preg_match($pass_patt,$password)){

  echo"<script>alert('Invalid Password!!')</script>";
  
  echo"<script>location.href='regi.php'</script>";
}


else if($password !== $cPassword){

  echo"<script>alert('Pass and Confirm is not matching!!')</script>";
  
  echo"<script>location.href='regi.php'</script>";
}


else if(!preg_match($mobile_patt,$number)){

  echo"<script>alert('Mobile invalid!!')</script>";
  
  echo"<script>location.href='regi.php'</script>";
}

else if(!preg_match($email_patt,$email)){

  echo"<script>alert('email invalid!!')</script>";
  
  echo"<script>location.href='regi.php'</script>";
}

else{
  $inserQuery="INSERT INTO `user_login`(`name`, `email`, `number`, `password`) VALUES ('$name','$email','$number','$password')";
 if(  !mysqli_query($conn, $inserQuery)){
  die ("Registration Not Completed!");
 }else{
    
  echo"<script>alert('Registration Completed')</script>";
    
  echo"<script>location.href='login.php'</script>";
 }
}







?>