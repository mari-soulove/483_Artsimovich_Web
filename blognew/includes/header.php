<header>
 <div class="container-fluid">
   <div class="row">
    <div class="col">
     <nav class="nav">
      <a class="nav-link active" aria-current="page" href="/index.php">Главная</a>
      
      <a class="nav-link" href="../pages/login.php">Вход</a>

      <?php
      if (isset($_SESSION['id'])):     ?>

        <a class="nav-link" href="#"></a>

        <?php echo $_SESSION['name']; ?>
        

      <a class="nav-link" href="../create.php">Разместить пост</a>
      <a class="nav-link" href="<?php echo "http://blog.loc/includes/logout.php"; ?>">Выход</a>




<?php
    else: ?>
      
<a class="nav-link" href="../pages/reg.php">Регистрация</a>

<?php
    endif;
?>

 <?php
{}
?>

      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </nav>
    </div>   
   </div>
   <div class="row">
     <div class="col">
        <img src="http://akant-ogrody.pl/wp-content/uploads/slider-automatyczne-podlewa.jpg" class="img img-fluid">
    </div>
    </div>
  </header>