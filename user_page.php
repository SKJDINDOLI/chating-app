<?php
include "connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header("location:index.php");
}
$user_self=$_SESSION['username'];

if(isset($_GET['text_message'])){
  $username=htmlspecialchars($_GET['username']);
  $text_message=htmlspecialchars($_GET['text_message']);
  $sql="INSERT INTO `message` ( `_$username`,`_from`,`_to`) VALUES ('$text_message','_$user_self','_$username')";
  $result=mysqli_query($conn,$sql);
}
if(isset($_GET['add_user'])){
    $add_user=$_GET['add_user'];
    $sql="INSERT INTO `$user_self.added_users` (`add_user`) VALUES ('$add_user')";
    $result=mysqli_query($conn,$sql);
}
if(isset($_GET['remove_user'])){
  $remove_user=$_GET['remove_user'];
  $sql="DELETE FROM `$user_self.added_users` WHERE `$user_self.added_users`.`add_user`='$remove_user'";
  $result=mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
        <div class="container mt-4 manu-min-width-300 w-50 d-flex flex-column align-items-center">
            <h1 class="mb-4 text-center">Users</h1>
        <div class="d-flex flex-column manu-v-width-50">
        <?php
        echo '<div class="alert">Added</div>';
        include "added_users.php";

        $sql="SELECT `users`.`username` FROM `users` LEFT JOIN `$user_self.added_users` ON `$user_self.added_users`.`add_user` =`users`.`username` WHERE `$user_self.added_users`.`add_user` IS NULL";
        $result=mysqli_query($conn,$sql);
        $count_user=0;
        echo '<div class="alert">Add More.....</div>';
        while($row=mysqli_fetch_assoc($result)){
            if($row['username']==$user_self){
                continue;
            }
            
            $count_user++;
            echo '
            <div class="card mb-1" role="button">
            <div class=" d-flex align-items-center justify-content-between px-3">
              <div class="text-center">
                <a class="text-decoration-none " id="select_user'.$count_user.'" href="chat.php?chat_user='.$row['username'].'">
                <span class="material-symbols-outlined p-3 border rounded-circle m-1">person</span>
                </a>
              </div>
              <div class="text-left">
                <div class="card-body">
                  <h5 class="card-title" id="user'.$count_user.'">'.$row['username'].'</h5>
                </div>
              </div>
              <div>
              <form action="user_page.php#user'.$count_user.'" method="get">
              <button type="submit" class="btn btn-primary add_user" name="add_user" value="'.$row['username'].'">Add</button>
              </form>
              </div>
            </div>
          </div>';
          }
        
        ?>
        </div>
</div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>