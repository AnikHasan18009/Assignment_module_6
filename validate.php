<?php


if($_SERVER['REQUEST_METHOD']=='POST')
{
  if ( empty( $_POST['name'] ) || empty( $_POST['email'] ) || empty( $_POST['password'] ) || empty( $_FILES['picture'] ) ) {
    die("Error! Data is missing.");
}
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_pic = $_FILES['picture'];

    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
      die( 'Error! Invalid email format.' );
  }
  if ( $profile_pic['size']>2097152  ) {
    die( 'Error! File is too big.' );
}
 
  $old=explode('.',$profile_pic['name']);
  $extension=end($old);
  $fname=substr(sha1(time()),0,15)."_".date("d-M-Y_H-i-s").".".strtolower($extension);
  $dir='uploads/'.$fname;
  if(!move_uploaded_file($profile_pic['tmp_name'],$dir))
   die("Error! Cannot upoad photo.");

  $data= array($name,$email,$fname);
   $contents=[];
  $file=fopen("users.csv","r+");
  while($content=fgetcsv($file)){
    if(!empty($content[0]))
    array_push($contents,$content);
  }
  fclose($file);
  $file=fopen("users.csv","w+");
  foreach($contents as $content)
  {
    if(!empty($content))
      fputcsv($file,$content);
  }
  if(fputcsv($file,$data)===false)
  die("Error! Cannot write the file.");
  fclose($file);
  session_start();
  setcookie("username",$name,time()+86400);
  
  header( 'Location: list.php' );
    exit();

}


?>