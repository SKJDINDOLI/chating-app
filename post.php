<?php
include "connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header("location:index.php");
}
$user_self=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="bg-dark text-primary">
    <?php
    include "nav.php";
    
    ?>
    <main>
    <div class="w-100 h-100 bg-dark position-absolute z-3 d-flex justify-content-center align-items-center bg-opacity-75 top-0 start-0 " id="loading">
        <div class="spinner-border text-primary p-5" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
        </div>
        
        <div class="container mt-4 manu-min-width-300 w-50 d-flex flex-column align-items-center d-none" id="added_users">
        <div class="d-flex flex-column manu-v-width-50">
        <?php
            include "added_users.php";
        ?>
        </div>
        </div>
        <div class="container mt-4 manu-min-width-300 w-50 d-flex flex-column align-items-center" id="my_posts">
        <div class="d-flex flex-column manu-v-width-50">
        
        <?php
          $sql="SELECT * FROM `$user_self.added_users`";
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
          $sqlp="SELECT * FROM `$row[add_user].post` ORDER BY `dt` desc";
          $resultp=mysqli_query($conn,$sqlp);
          $count=0;
          while($rowp=mysqli_fetch_assoc($resultp)){
            $count++;
          echo '<div class="card mt-2" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">'.$row['add_user'].'</h5>
              <h6 class="card-subtitle mb-2 text-muted">'.$rowp['loc'].'</h6>
              <img src="users/'.$row['add_user'].'/posts_pic/'.$rowp['pic_name'].'" class="card-img-top" alt="...">
              <p class="card-text">'.$rowp['description'].'</p>
              <a href="#like'.$count.'?like=true,user='.$row['add_user'].',post_no='.$rowp['sno'].'" class="card-link" id="like'.$count.'"><span class="material-symbols-outlined">favorite</span></a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>';
        }
        }
        ?>
        </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>