<?php

require "includes/config.php";

?>

<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Личный кабинет</title>
  <style>
  </style>
 </head>
 <body>

  <?php
      include "includes/header.php";
    ?>
    <?php
      $year = mysqli_query($connection, "SELECT * FROM `archive_year`");
    ?>
    <div class="row">
     <div class="col-2">
     <ul class="list-group list-group-flush">

      <?php
          while ($ye = mysqli_fetch_assoc($year)) 
          {
            ?>
               <li class="list-group-item"><a href="/categorie.php?id=<?php echo $ye['id'];?>"><?php echo $ye['year'];?></a></li>

            <?php
          }
        ?>


     <li class="list-group-item"><a href="#">2021 март</a></li>
     <li class="list-group-item"><a href="#">2021 февраль</a></li>
     <li class="list-group-item"><a href="#">2021 январь</a></li>
     <li class="list-group-item"><a href="#">2020 декабрь</a></li>
     <li class="list-group-item"><a href="#">2020 ноябрь</a></li>
     <li class="list-group-item"><a href="#">2020 октябрь</a></li>
     <li class="list-group-item"><a href="#">2020 сентябрь</a></li>
     </ul> 
     </div>

     <div class="col-3">
         </div>
   <div class="col-4">

                      <div class="text-center"><h1>Изменить пароль</h1></div>
                       

<form action="lk.php" method="POST">
          <div class="form-group">
             
              <input type="password" class="form-control" name="pass_o" id="exampleInputPassword1" placeholder="Старый пароль" required>
            </div>

              <div class="form-group">
          
              <input type="password" class="form-control" name="pass_n" id="exampleInputPassword1" placeholder="Новый пароль" required>
              
            </div>
  



<button type="submit" class="btn btn-primary" name="do_pass">Изменить пароль</button>
</form>


<?php
                                $data=$_POST;

                                if (isset($_POST['do_pass']))
                                {
                            
                                
                               $db=mysqli_query($connection, "SELECT * FROM `user` WHERE `id` = '".$_SESSION['id']."'");
            $pass = mysqli_fetch_assoc($db);
    

           if (password_verify(@$data['pass_o'], @$pass['password'])) {

                                 
        mysqli_query($connection, "UPDATE `user` SET `password`= '".password_hash($data['pass_n'], PASSWORD_DEFAULT)."' WHERE `id` = '".$_SESSION['id']."' ");
        echo '<div style="color: green;"> Пароль изменен</div>';
 } else

        echo '<div style="color: red;"> Старый пароль введен неверно</div>';
}
                              ?>
  
        
 


 </body>
</html>
