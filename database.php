<?php
if(isset($_POST["show"])){




  $callfromdatabase=$pdo->prepare('SELECT * FROM rickandmorty');
  $callfromdatabase->execute();
  $databaseinfo=$callfromdatabase->fetchAll(PDO::FETCH_ASSOC);
}
?>





<div class=" flex flex-wrap mx-auto" >
 <?php foreach($databaseinfo as $i=> $data) { ?>
    <div class=" px-7 mx-5 left-28 rounded-md  border-2 border-sky-500  mt-7 h-max relative flex flex-col bg-amber-400 w-1/5 items-center pb-3">     
       <div id="information" class="  w-full  flex  flex-col  ">
           <div class="flex-row pt-2">
                <p ><?php echo $i+1 ?>)</p>
            </div>
           <div id="name" class="   flex flex-row pt-2 border-b-2 border-black  ">
                <h1 class=" ml-7 font-semibold ">Name :</h1>
                <p class=" ml-10 text-lg"><?php echo $data['name'] ?></p>
           </div>
           <div id="status" class=" w-11/12 flex flex-row pb-4  ">
               <h1 class=" ml-7 font-semibold "  >Status :</h1>
               <p class=" ml-10 text-lg"><?php echo $data['status'] ?></p>
           </div>
       </div>
            <div id="image"><img   class=" rounded-lg border-slate-700 border-4 " src="<?php echo $data['image'] ?>" alt="img"></div>
   </div>
   <?php } ?>  
   </div>

