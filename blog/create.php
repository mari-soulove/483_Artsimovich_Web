<?php

require "includes/config.php";

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
    <div class="text-center"><h1>Добавление статьи</h1>
    </div>





<form action="create.php" method="POST">
            <div class="form-group">
          
           <input type="text" class="form-control" name="title" placeholder="Заголовок" aria-label="Название" required>
            </div>
            <div class="form-group">
              <label for="editor" class="form-label">Текст записи</label>
              
              <textarea class="form-control" name="text" id="editor" rows="6"> </textarea> 
            </div>

          <div class="form-group">
              
              
              <input type="file" class="form-control" id="InputGroupfile02" name="img">
              <label class="form-group-text" for="InputGroupfile02">Загрузить</label>
              
            </div>

              <select class="form-select mb-2" aria-label="" name="year">
                <option selected>Open</option>
                <option value="1">Open</option>
                <option value="2">Open</option>
                <option value="3">Open</option>
              </select>



              <div class="form-group">
             
            <button type="submit" class="btn btn-primary" name="add_post">Опубликовать запись</button>
          </div>
</form>
 

<?php
/*

$id='';
$err='';
$title='';
$text='';
$year='';
$ing='';


          if($_SERVER['REQUEST_METHOD'] ==='post' && isset($_POST['add_post'])) {
            $title=trim($_POST['title']);
            $text=trim($_POST['text']);


            if ($title==='' || $text==='' || $year==='') {
              $err="Не все поля заполнены";

            } else {
              
              $ref_date=date('Y-m-d');
          mysqli_query($connection, "INSERT INTO `articles` (`title`,`text`, /*`user_id`*///, //`img`, `date`) VALUES ('".$_POST['title']."','".$_POST['text']."', '".$_POST['img']."', '".$ref_date."') ");
                                             /*  ^'"$_SESSION['id']"',*/

     //   echo '<div style="color: green;"> Запись опубликована </div>';

              # code...
           // }



         // }




          if(isset($_POST['add_post'])) 
          {
            $title=trim($_POST['title']);
            $text=trim($_POST['text']);
            $errors=array();

            if ($title=='' || $text=='' /*|| $year==''*/) {
              $errors[]="Не все поля заполнены";

            } 

            if (empty ($errors)) 
                    {
                     
              
              $ref_date=date('Y-m-d');
          mysqli_query($connection, "INSERT INTO `articles` (`title`,`text`, `user_id`, `img`, `date`) VALUES ('".$_POST['title']."','".$_POST['text']."', '".$_SESSION['id']."', '".$_POST['img']."', '".$ref_date."') ");
                                          

        echo '<div style="color: green;"> Запись опубликована </div>';

              # code...
            }

            



          }


?>





 </body>
</html>
