<?php

require "../includes/config.php";

?>

<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Bootstrap</title>
  <style>
  </style>
 </head>
 <body>
  <?php
      include "../includes/header.php";
    ?>
   
    <div class="row">
     <div class="col-2">
     <ul class="list-group list-group-flush">
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
    <div class="text-center"><h1>Авторизация</h1></div>

            
            <?php
  $data=$_POST;
  if (isset($data['do_login']))
  {
 $errors=array();
  	/*$login=$_POST['email'];
  	$pass=password_hash($data['password'], PASSWORD_DEFAULT);
   

      $result = mysqli_query($connection, "SELECT * FROM `user` WHERE `email` = 'email' AND `password` ='$pass'");
            $user=mysqli_fetch_assoc($result);
            if (count($user)==0) {
            	$errors[]='Пользователь не зарегистрирован';
               exit();
            }

            print_r($user);
            exit();*/

       /*  $ema=mysqli_query($connection, $em); 
       if ($ema !== '') {
            echo "<h3>Привет!</h3>";
              $errors[]='Пользователь с таким email не зарегистрирован';



    <?php
      $articles = mysqli_query($connection, "SELECT * FROM `articles`");
    ?>

        <?php
          while ($art = mysqli_fetch_assoc($articles)) 
          {
            ?>
            <div class="col-6">
     <h2><?php echo $art['title']; ?></h2>





            }*/
          
            $ema=mysqli_query($connection, "SELECT * FROM `user` WHERE `email` = '".$_POST['email']."'");
            $p = mysqli_fetch_assoc($ema);
            
           if (password_verify(@$data['password'], @$p['password'])) {
              
                echo "Авторизация";


             
              $_SESSION['id'] = $p['id'];
              $_SESSION['email'] = $p['email'];  
              $_SESSION['name'] = $p['name'];           
              header("Location: http://blog.loc/create.php");



            } else {
              
                $errors[]='Почта или пароль введены неверно';
                echo '<div style="color: red;">'.array_shift($errors).'</div>';

            }


            /* {
              
              $_SESSION['id'] = $id;
              $_SESSION['email'] = $email;
                    //  header('location:' index.php)
             // header("Location: http://blog.loc/create.php");
              if ($email) {
              echo "<h3>Привет, $email!</h3>";}*/


            }







  

?>        






              <form action="login.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
              
              <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Пароль</label>
                  
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Пароль" required>               
                     </div>

                <button type="submit" class="btn btn-primary mt-2" name="do_login">Войти</button>
                <div class="text"> <a href="../pages/reg.php">Регистрация</a></div>
              </div>
              </form>
 
 </body>
</html>
