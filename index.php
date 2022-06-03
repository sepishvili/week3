<?php

$username='root';
$password='';


$pdo = new PDO("mysql:localhost;port=3306", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "CREATE DATABASE IF NOT EXISTS week3";
$pdo->exec($sql);
$sql = "use week3";
$pdo->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS rickandmorty(
                ID int(11) AUTO_INCREMENT PRIMARY KEY,
                name varchar(500) NOT NULL,
                status varchar(500)  NULL,
                image varchar(2048) NOT NULL)";
    $pdo->exec($sql); 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>
<body class="bg-slate-300">
  <div class="relative w-full text-star bg-slate-500 rounded-lg bg-opacity-75">
      <h1 class=" text-7xl mt-4  ml-4 font-serif">Rick And Morty api</h1>
    <div class=" py-4 flex relative">
      <div class=" relative w-screen    mt-6 flex justify-center items-center  ">     
                <form class="flex space-x-2 items-center p-1" action="" method='post'>
                <input type="text" class="rounded-l bg-slate-200 " placeholder="search by name" name="searchname"/>                       
                <button class="bg-sky-500  rounded-lg p-2" type="submit" name="submit" value="submit">submit</button>              
                <button class="bg-sky-500  rounded-lg p-2" type="submit" name="show" value="show">show all</button>
                </form>   
        </div> 
      </div>
  </div>
    <body>
<div>
 
<?php if(isset($_POST["submit"])&&strlen($_POST['searchname'])>0 ){ 
    require_once("decode.php") ; 
    }elseif(isset($_POST["show"])){
     require_once("database.php");    
 } ?>   
   </div>
   
</body> 
</html>