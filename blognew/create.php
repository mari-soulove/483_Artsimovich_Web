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

<div class="col-1">
         </div>

     <div class="col-4">
 <div class="text-center"><h1>Добавление статьи</h1>
    </div>





<form action="create.php" method="POST" enctype="multipart/form-data">
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



          if(isset($_POST['add_post'])) 
          {
          
          	 $errors=array();

          	 print_r($_FILES);
          		if (!empty ($_FILES['img']['name'])) 
                    {
                    	$imgName=$_FILES['img']['name'];
                    	$fileTmpName=$_FILES['img']['tmp_name'];
                    	$destination= "C:\\xampp\htdocs\blog\images\\". $imgName;
                    	
                    	$result=move_uploaded_file($fileTmpName, $destination);
                    	if ($result) {
                    		$_POST['img']=$imgName;
                    	} else {
                    		$errors[]="Ошибка загрузки изображения на сервер";

                    	}


                 	}else {
                 		$errors[]="Ошибка получения изображения";
                 	}


            $title=trim($_POST['title']);
            $text=trim($_POST['text']);
            

            if ($title=='' || $text=='') {
              $errors[]="Не все поля заполнены";

            } 

            if (empty ($errors)) 
                    {
                     
              
              $ref_date=date('Y-m-d');
          mysqli_query($connection, "INSERT INTO `articles` (`title`,`text`, `user_id`, `img`, `date`, `author`) VALUES ('".$_POST['title']."','".$_POST['text']."', '".$_SESSION['id']."', '".$_POST['img']."', '".$ref_date."', '".$_SESSION['name']."') ");
                                          

        echo '<div style="color: green;"> Запись опубликована </div>';

             
            }

            



          }


?>

<div class="text-center"><h2>Мои статьи:</h2>

<ul class="list-group list-group-flush">


<?php
      $articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `user_id` = '".$_SESSION['id']."'");


    ?>

        <?php
  if ($art=mysqli_fetch_assoc($articles)) {
          while ($art=mysqli_fetch_assoc($articles)) 
            
          { ?>
           
               <li class="list-group-item"><a href="/article.php?id=<?php echo $art['id']; ?>">
                 
                <?php echo $art['title'];?>
               </a></li>
         <?php
          }
        } else echo 'Пока статей нет';
        ?>  
         </div>
</div>

      <div class="col-1"></div>   

   <div class="col-3">

                      <div class="text-center"><h1>Изменить пароль</h1></div>
                       

<form action="create.php" method="POST">
          <div class="form-group">
             
              <input type="password" class="form-control" name="pass_o" id="exampleInputPassword1" placeholder="Старый пароль" required>
            </div>

              <div class="form-group">
          
              <input type="password" class="form-control" name="pass_n" id="exampleInputPassword1" placeholder="Новый пароль" required>
              
            </div>
            

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



<button type="submit" class="btn btn-primary" name="do_pass">Изменить пароль</button>
</form>



   
               
        
      




 </body>
</html>
