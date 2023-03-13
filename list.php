<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    img{
height: 50px;
width:50px ;
border-radius: 10px;
    }
    table{
      
      border:3px solid white;
      color: darkblue;
      font-weight: bolder;
      position:relative;
      margin:auto;
      top:200px;
      
    }
    th{
      text-align: center;
      background-color: blueviolet;
      color: white;
    padding:15px;
    }
    td{text-align: center;
      background-color: silver;
      color: purple;
    padding:10px;}
  </style>
  <title>Registered List</title>
</head>
<body>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Profile picture</th>
    </tr>
    <?php
    $file=fopen("users.csv","r");
    while(($data=fgetcsv($file))!==false):
      echo <<<EOD
      <tr>
      <td>$data[0]</td>
      <td>$data[1]</td>
      <td><img src='uploads/$data[2]'></td>
      </tr>
      EOD;
    endwhile;
    
    ?>
  </table>
</body>
</html>