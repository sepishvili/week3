<?php
error_reporting(E_ALL ^ E_WARNING);
if(isset($_POST["submit"])&&strlen($_POST['searchname'])>0){
    $name= $_POST['searchname'];
    $name=str_replace(" ","%",$name);
    
    // $pdo= new PDO('mysql:localhost;port=3306;dbname=week3','root','');
    // $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    
    $callfromdatabase=$pdo->prepare("SELECT * FROM rickandmorty WHERE name LIKE '%$name%' ");
    $callfromdatabase->execute();

    $result=$callfromdatabase->fetch(PDO::FETCH_ASSOC );  
    
    
    if(!$result){
        $name= $_POST['searchname'];
        $name=str_replace(" ","%20",$name);
        $url="https://rickandmortyapi.com/api/character/?name=$name";
        $jsondata=file_get_contents($url);
        if(!$jsondata){         
          $error_msg=" ";
        }else{         
            $decoded=json_decode($jsondata,true);  

            $name = $decoded['results'][0]['name'];
            $status =  $decoded['results'][0]['status'];           
            $img = $decoded['results'][0]['image'];

            if(!is_dir('images/')){
                mkdir('images/');
            }

            $images='images/';
            $imagename=basename($img);
            $imagelocation=$images . $imagename;
            file_put_contents($imagelocation,file_get_contents($img));


            $addindatabase = $pdo->prepare (" INSERT INTO rickandmorty (name,status,image)
            VALUE(:name,:status,:image)");
            $addindatabase->bindValue(':name', $name);
            $addindatabase->bindValue(':status', $status);             
            $addindatabase->bindValue(':image', $imagelocation);

            $addindatabase ->execute();

            $callfromdatabase=$pdo->prepare("SELECT * FROM rickandmorty WHERE name='$name'");
            $callfromdatabase->execute();

            $result=$callfromdatabase->fetch(PDO::FETCH_ASSOC );                     
        }       
    }
}
?>



<?php if($error_msg){?>
    <body style="background-image: url(https://i.kym-cdn.com/entries/icons/original/000/019/224/Look_Morty.jpg);" 
        class=" w-full h-screen relative  ">
        <div  class=" w-full h-screen flex items-center justify-center absolute   ">
            <p class=" text-8xl bg-red-700 p-7 rounded-lg bg-opacity-75 mb-40  ">look carefully before search</p>
        </div>
</body>
    <?php
    die();
    } else {?>
   <div class="rounded-l border-2 border-sky-500 mx-auto mt-7 h-max relative flex flex-col bg-amber-400 w-1/5 items-center pb-3">     
       <div id="information" class="  w-full  flex  flex-col  ">
           <div id="name" class="   flex flex-row pt-2 border-b-2 border-black  ">
                <h1 class=" ml-7 font-semibold ">Name :</h1>
                <p class=" ml-10 text-lg"><?php echo $result['name'] ?></p>
           </div>
           <div id="status" class=" w-11/12 flex flex-row pb-4  ">
               <h1 class=" ml-7 font-semibold "  >Status :</h1>
               <p class=" ml-10 text-lg"><?php echo $result['status'] ?></p>
           </div>
       </div>
            <div id="image"><img   class=" rounded-lg border-slate-700 border-4 " src="<?php echo $result['image'] ?>" alt="img"></div>
   </div>
   <?php } ?>