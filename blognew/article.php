<?php

require "includes/config.php";

?>

<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Блог</title>
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

     <li class="list-group-item"><a href="../pages/statia.html">2021 март</a></li>
     <li class="list-group-item"><a href="#">2021 февраль</a></li>
     <li class="list-group-item"><a href="#">2021 январь</a></li>
     <li class="list-group-item"><a href="#">2020 декабрь</a></li>
     <li class="list-group-item"><a href="#">2020 ноябрь</a></li>
     <li class="list-group-item"><a href="#">2020 октябрь</a></li>
     <li class="list-group-item"><a href="#">2020 сентябрь</a></li>
     </ul> 







      


      <?php
      $result = mysqli_query($connection, "SELECT * FROM `articles`");
      $art = mysqli_fetch_assoc($articles);

        
        $date = $art['date'];
     $dateToPrint = date('F', strtotime($date) ) ;
         

     $articles = array();
    while ($row = mysqli_fetch_array($result)) {
        $articles[] = $row['date'];
}
  ?>

  <ul>
    <?php foreach ($articles as $article): ?>
      <li><a href="?date="><?= $article['date'] ?> </a></li>
    <?php endforeach; ?>
  </ul>

     </div>
     
<?php
     $article=mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);

     if (mysqli_num_rows($article)<=0)
     {
        ?>
                  <div class="col-10">
                  <h2>Статья не найдена</h2>
                  <p>Такой статьи у нас нет:(</p>
                  <div class="row"><br></div>
                    <?php
        } else
          {
            $art=mysqli_fetch_assoc($article)
          ?>

    <div class="col-10">
      <div class="row">
      <h2><?php echo $art['title'];?></h2>
      <p>
        <img src="..\images\<?php echo $art['img'];?>" class="float-left" style="float: left;margin-right: 15px; max-width: 500px">
    <?php echo $art['text'];?></p>
    </div>
    <div class="row"><br></div>
<div class="row">
     <div class="col-2">
     

     <p><?php 
     $date = $art['date'];
     $dateToPrint = date('d.m.Y | h:i', strtotime($date) ) ;
     echo $dateToPrint ; ?></p>  </div>



     <div class="col-1"><p>Автор:</p> </div>
     <div class="col-1"><p><?php echo $art['author'];?></p> </div>
</div>

<div class="row">
  <div class="col-3">
  <p>Статья была полезна?</p>  </div>

  <div class="col-1">

    <img src="https://img.icons8.com/material-sharp/24/000000/facebook-like--v1.png"/ width="18" style="float: left">
    <p style="float: left"> <?php echo $art['like'];?></p></div>
   <div class="col-1"> 

    <img src="https://img.icons8.com/material-sharp/24/000000/thumbs-down.png"/ width="18" style="float: left">
     <p style="float: left"><?php echo $art['dislike'];?></p></div>
</div>


                <div id="comment-add-form" class="row">
                  <div class="col-5">
                <h3>Оставить комментарий</h3>
                <form class="form" method="POST" action="/article.php?id=<?php echo $art['id']; ?>#comment-add-form">

                 <?php 
                 if (isset($_POST['do_post']))
                  {
                    $errors=array();

                 /*    if ( $_POST['email'] == '') 
                    {
                      $errors[]='Введите email!';
                    }

                    if ( $_POST['name'] == '') 
                    {
                      $errors[]='Введите имя!';
                    }*/


                     if ( $_POST['text'] == '') 
                    {
                      $errors[]='Введите комментарий';
                    }

                    if (empty ($errors)) 
                    {
                     if (isset($_SESSION['id'])) {

                                 mysqli_query($connection, "INSERT INTO `comments` (`name`, `text`, `date`, `articles_id`) VALUES ('".$_SESSION['name']."','".$_POST['text']."', NOW(), '".$art['id']."') ");

                              } else{
                                # code...
                              
                    mysqli_query($connection, "INSERT INTO `comments` (`email`,`name`, `text`, `date`, `articles_id`) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['text']."', NOW(), '".$art['id']."') ");
                    }
                    //* FROM `articles` WHERE `id` = " . (int) $_GET['id']);
                              
                              


                    echo '<span style="color: green"> Комментарий отправлен </span>';

                    } else
                    {
                      echo '<span style="color: red">' . $errors['0'] . '</span>';

                    }


                    }
                  ?>   

<div class="mb-50">

 <form>  
<?php
if (isset($_SESSION['id'])):     ?>


        <?php echo $_SESSION['name']; ?>
        

    <!-- <div class="col-5">-->
       <div class="mb-3">
          
              <label for="exampleFormControlTextarea1" class="form-label">Ваш комментарий:</label>
              <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          <button type="submit" name="do_post" class="btn btn-primary">Отправить</button>
        
</div>


<?php
    else: ?>
      

                    <label for="exampleInputEmail1"  class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?php 
                    if (isset($_POST['email']))
                    {echo ($_POST['email']);} ?>">
                <!--  </div> -->
                        <div class="mb-3">
                          <label for="exampleInputName"  class="form-label">Имя</label>
                          <input type="name" name="name" class="form-control" id="exampleInputName" value="<?php echo @$_POST['name']; ?>"> 
                        </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1"  class="form-label">Ваш комментарий:</label>
                    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"><?php echo @$_POST['text']; ?></textarea>
                  </div>
                <button type="submit" name="do_post" class="btn btn-primary">Отправить</button>
                
</div>
<?php
    endif;
?>
</form>
                </div>

</div>




                  
                

        


    <div class="col-6">
    <h3>Комментарии:</h3>


<?php
     $comments=mysqli_query($connection, "SELECT * FROM `comments` WHERE `articles_id` = " . (int) $art['id']); //. "ORDER BY `id` DESC";

     if (mysqli_num_rows($comments)<=0)
     {
        
                  
                  echo "Нет комментариев:(";
                  
        } 



        while ($com= mysqli_fetch_assoc ($comments)) {
          ?>


              <div class="media-body">
                        <div class="media-heading">
                          <div class="author"><?php echo $com['name'];?></div>
                          <div class="email"><?php echo $com['email'];?></div>
                        </div>
                    <div class="media-text text-justify"><?php echo $com['text'];?></div>
             </div>
       <div class="row">
            <div class="col-8">
              <span class="date"><?php 
     $date = $com['date'];
     $dateToPrint = date('d.m.Y | h:i', strtotime($date) ) ;
     echo $dateToPrint ; ?></span>
            </div>
          



     <div class="col-2">

        <img src="https://img.icons8.com/material-sharp/24/000000/facebook-like--v1.png"/ width="18" style="float: left">
        <p style="float: left"> <?php echo $com['like'];?></p>
    </div>

   <div class="col-2"> 

    <img src="https://img.icons8.com/material-sharp/24/000000/thumbs-down.png"/ width="18" style="float: left">
     <p style="float: left"><?php echo $com['dislike'];?></p></div>
</div>



      
      <?php
}
?>


<?php
}
?>

  </div>
 
 </body>
</html>
