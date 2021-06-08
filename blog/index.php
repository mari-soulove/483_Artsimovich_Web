<?php

require "includes/config.php";

?>

<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Блог Главная</title>
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
     </div>
     
     
     <div class="col-10">

   <div class="row">
     
    

        <?php
      $articles = mysqli_query($connection, "SELECT * FROM `articles`");
    ?>

        <?php
          while ($art = mysqli_fetch_assoc($articles)) 
          {
            ?>
            <div class="col-6">
     <h2><?php echo $art['title']; ?></h2>
     <div class="row">
      <div class="col-4">
     <img src="https://i.picsum.photos/id/640/180/180.jpg?hmac=ZNk3UYYKQwk43jr8LahXP1pAa4-RNfqFL_gsWdYKJrM"/>
    </div>
    <div class="col-8">
   
  <?php echo mb_substr(strip_tags($art['text']), 0, 257, 'utf-8') . "..."; ?>

    </div>
     <div class="row">
      <div class="col-2">

      <p><?php 
     $date = $art['date'];
     $dateToPrint = date('d.m.Y', strtotime($date) ) ;
     echo $dateToPrint ; ?></p>  </div>
      <div class="col-4"><p>Автор: <?php echo $art['author']; ?></p>
      </div>
      <div class="col-6"><div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-outline-success" href="/article.php?id=<?php echo $art['id']?>" role="button">Читать далее</a></div>
      </div>
    </div>
  </div>
</div>
<?php
         }
         ?>  

     <div class="col-6">
      <h2>Название статьи 2</h2>
      <div class="row">
       <div class="col-4">
      <img src="https://i.picsum.photos/id/549/180/180.jpg?hmac=S0SI8zzwzWTOEhu8JpqbHNd5Xup4FtyJNhAZRhrpyNM"/>
     </div>
     <div class="col-8">
      <p>Таким образом новая модель организационной деятельности позволяет оценить значение систем массового участия. Равным образом рамки и место обучения кадров играет важную роль в формировании дальнейших направлений развития. Консультация с широким активом способствует подготовки и реализации форм развития.</p>
     </div>
      <div class="row">
       <div class="col-2">
       <p>23.03.2020</p>  </div>
       <div class="col-4"><p>Автор: Петр Петров</p></div>
        <div class="col-6"> <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-outline-success" href="https://bootstrap-4.ru/" role="button">Читать далее</a></div>
       
       </div>
       
     </div>
     
   </div>
     
   
 </div>


 </body>
</html>