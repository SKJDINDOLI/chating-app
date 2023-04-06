<?php
include "connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header("location:index.php");
}
$message_delete=false;
$user_self=$_SESSION['username'];

if(isset($_GET['text_message'])){
  $username=htmlspecialchars($_GET['username']);
  $text_message=htmlspecialchars($_GET['text_message']);
  $sql="INSERT INTO `$user_self.chat` ( `$username`,`_from`,`_to`) VALUES ('$text_message','$user_self','$username')";
  $result=mysqli_query($conn,$sql);
  $sql="INSERT INTO `$username.chat` ( `$username`,`_from`,`_to`) VALUES ('$text_message','$user_self','$username')";
  $result=mysqli_query($conn,$sql);
  $message_delete=true;
  echo '<input type="hidden" id="message_delete">';
}
if(isset($_GET['chat_user'])){
    $chat_user=$_GET['chat_user'];
}else{
    $chat_user=$username;
}
echo '
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body class="bg-dark text-primary">
    <main>';
        $sqlm="SELECT * FROM `$chat_user.chat` WHERE (`_from`='$user_self' OR `_to`='$user_self') AND (`_from`='$chat_user' OR `_to`='$chat_user')";
        $resultm=mysqli_query($conn,$sqlm);
        $num_row=mysqli_num_rows($resultm);
        $message_id=1;
        while($rowm=mysqli_fetch_assoc($resultm)){

            
          if($rowm[$chat_user]!=null){

            echo '<div class="d-flex justify-content-start">
                    <div class="alert text-white bg-primary rounded-4 rounded-start manu-max-width-75 " id="'.$rowm['sno'].'" role="alert">
                      '.$rowm[$chat_user].'
                    </div>
                  </div>';
          }
          if($rowm[$user_self]!=null){
            echo '<div class="d-flex justify-content-end">
                    <div class="alert text-white bg-success rounded-4 rounded-end  manu-max-width-75" id="'.$rowm['sno'].'" role="alert">
                      '.$rowm[$user_self].'
                    </div>
                  </div>
              ';
          }
          $message_id=$rowm['sno']+1;
        }
        echo '<input type="hidden" id="message_id" value="'.$message_id.'">';
        
        ?>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
      
    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>