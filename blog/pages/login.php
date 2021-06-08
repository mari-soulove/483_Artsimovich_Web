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

   /* if (trim($data['email']) == '') {
      $errors[]='Введите email';
    }

    if (trim($data['name']) == '') {
      $errors[]='Введите имя';
    }

    if ($data['password'] == '') {
      $errors[]='Введите пароль';
    }*/


    /*if (count(['login'] == @$data['login'] OR ['email'] == $data['email']) > 0) 
    {
      $errors[]='Такой пользователь уже есть';
    }
*/

            $ex=selectOne(table 'user', ['email'] => $email);
            if ($ex['email'] === $email) {
              $errors[]='Пjkmpjdfntkm c nfr';
            }


   /* if ($data['password_2'] !== $data['password']) {
      $errors[]='Пароли не совпадают';
    } */

      if (empty($errors)) {
        mysqli_query($connection, "INSERT INTO `user` (`email`,`name`, `password`) VALUES ('".$_POST['email']."','".$_POST['name']."','".password_hash($data['password'], PASSWORD_DEFAULT)."') ");
        echo '<div style="color: green;"> Вы успешно зарегистрированы </div>';

      } else

        echo '<div style="color: red;">'.array_shift($errors).'</div>';


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
                <div class="text"> <a href="reg.html">Регистрация</a></div>
              </div>
              </form>
 
 </body>
</html>
