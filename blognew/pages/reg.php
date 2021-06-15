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
    <div class="text-center"><h1>Регистрация</h1></div>





<form action="reg.php" method="POST">
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              
              <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="exampleInputName">Имя</label>
              
              <input type="Name" class="form-control" name="name" id="exampleInputName" placeholder="Имя" required>
            </div>

          <div class="form-group">
              <label for="exampleInputPassword1">Пароль</label>
              
              <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Пароль" required>
              <small id="passHelp" class="form-text text-muted">Пароль должен содержать 9 символов</small>
            </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Введите пароль еще раз</label>
              
              <input type="password" class="form-control" name="password_2" id="exampleInputPassword1" placeholder="Пароль" required>
              
            </div>

<?php
  $data=$_POST;
  if (isset($data['do_reg']))
  {
$name = strip_tags($_POST['name']);
    $errors=array();
   /* if (trim($data['email']) == '') {
      $errors[]='Введите email';
    }
*/

    if (mb_strlen($data['password']) <1 ) {
      $errors[]='Пароль должен содержать более 9 символов';
    }

   
    /*if (count(['login'] == @$data['login'] OR ['email'] == $data['email']) > 0) 
    {
      $errors[]='Такой пользователь уже есть';
    }
*/



    if ($data['password_2'] != $data['password']) {
      $errors[]='Пароли не совпадают';
    }

         /*  $em = "SELECT COUNT(id) as count FROM `user` WHERE 'email' = '".$data['email']."'";
            $ema=mysqli_query($connection, $em);
            
            $a = mysqli_fetch_assoc($ema);
           // echo $a['email'];
            echo $a['count'];

           if ($ema !== 0) {
              $errors[]='Пользователя нет';

            }*/

/*
            
     $em=mysqli_query($connection, "SELECT * FROM `user` WHERE 'email' = '".$data['email']."'");

     print_r(mysqli_num_rows($em));

     if (mysqli_num_rows($em)>0)
     {
       $errors[]='Пользователь уже есть';
}*/




            /* $na = "SELECT COUNT(id) as count FROM `user` WHERE name = '".$data['name']."'";
            $nam=mysqli_query($connection, $na);
            
           if ($nam !== '') {
              $errors[]='Пользователь с таким именем уже существует';

            }
*/



      if (empty($errors)) {
        mysqli_query($connection, "INSERT INTO `user` (`email`,`name`, `password`) VALUES ('".$_POST['email']."','".$_POST['name']."','".password_hash($data['password'], PASSWORD_DEFAULT)."') ");
        echo '<div style="color: green;"> Вы успешно зарегистрированы </div>';


    /*    $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
      //  header('location:' index.php)
        header("Location: http://blog.loc/create.php");
        if ($name) {
    echo "<h3>Привет, $name!</h3>";}
        //  $user = "SELECT id FROM `user`";
         //             $ema=mysqli_query($connection, $em);
        //              if (var_dump(mysql_num_rows($ema))) {
         //               $errors[]='Пjkmpjdfntkm c nfr';

*/

      } else

        echo '<div style="color: red;">'.array_shift($errors).'</div>';


  }

?>


            <button type="submit" class="btn btn-primary" name="do_reg">Отправить</button>
            <div class="text"> <a href="login.php">Уже зарегистрированы?</a></div>
          </div>
</form>
 
 </body>
</html>
