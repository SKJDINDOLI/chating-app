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
        <div class="container w-100">
        <div class="card">
        <div class="card-header d-flex flex-column justify-content-center align-items-center">
            <div>
            <span class="material-symbols-outlined p-5 border rounded-circle m-1 fs-1">person</span>
            </div>
            <h1 class="card-title"><?php echo $user_self; ?></h1>
        </div>
        <div class="card-body">
            <button id="added_users_btn" class="btn btn-primary">Users</button>
            <button id="my_posts_btn" class="btn btn-primary">Posts</button>
        </div>
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
        <div class="card" style="">
            <form class="card-body" method="post" action="welcome.php" enctype="multipart/form-data">
              <input type="text" class="card-subtitle mt-1 text-muted form-control border-info" name="location" placeholder="Location">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="img" id="imageUpload" class="card-img-top form-control border-info mt-1" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"><span class="material-symbols-outlined">edit</span></label>
                    </div>
                    <div class="avatar-preview card-img-top border border-info"style="width: 18rem;">
                        <div id="imagePreview" style="background-image: url(img/post_image_icon.png);">
                        </div>
                    </div>
                </div>
              <textarea class="card-text form-control border-info mt-1" name="description" placeholder="Description"></textarea>
              <button type="submit" class="btn btn-primary mt-1">Post</button>
            </form>
          </div>
        <?php

          if($_SERVER['REQUEST_METHOD']=="POST" && isset($_FILES['img'])){
            $location=$_POST['location'];
            $description=$_POST['description'];
            $img_name=$_FILES['img']['name'];
            $img_tmp_name=$_FILES['img']['tmp_name'];
            $img_type=$_FILES['img']['type'];
            $img_size=$_FILES['img']['size'];
            $sql="SELECT * FROM `$user_self.post`";
            $result=mysqli_query($conn,$sql);
            $sno=0;
            while($row=mysqli_fetch_assoc($result)){
              $sno=$row['sno'];
            }
            $sno+=1;
            $img_name=$sno.$img_name;
            if(move_uploaded_file($img_tmp_name,"users/".$user_self."/posts_pic/".$img_name)){
              $sql="INSERT INTO `$user_self.post` (`loc`, `pic_name`, `description`) VALUES ('$location', '$img_name', '$description')";
              $result=mysqli_query($conn,$sql);
              if(!$result){
                unlink("users/".$user_self."/posts_pic/".$img_name);
              }
            }
            
          }
          $sql="SELECT * FROM `$user_self.post`";
          $result=mysqli_query($conn,$sql);
          $count=0;
          while($row=mysqli_fetch_assoc($result)){
            $count++;
            echo '<div class="card mt-2" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">'.$user_self.'</h5>
              <h6 class="card-subtitle mb-2 text-muted">'.$row['loc'].'</h6>
              <img src="users/'.$user_self.'/posts_pic/'.$row['pic_name'].'" class="card-img-top" alt="...">
              <p class="card-text">'.$row['description'].'</p>
              <a href="welcome.php#like'.$count.'?like=true,user='.$user_self.',post_no='.$row['sno'].'" class="card-link" id="like'.$count.'"><span class="material-symbols-outlined">favorite</span></a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>';
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