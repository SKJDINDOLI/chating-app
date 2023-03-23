<?php
include "connection.php";
$checkuser=false;
$failed=false;
$success=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);
    $email=htmlspecialchars($_POST['email']);
    $sql="SELECT `username` FROM `users`";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if($username==$row['username']){
            $failed= "username already exist please choose different username";
            $checkuser=true;
        }
    }
    if($checkuser==false){
    $sql="INSERT INTO `users` (`username`,`email`, `password`) VALUES ('$username','$email', '$password') ";
    $result=mysqli_query($conn,$sql);
    if($result){
        $success='you are successfully sign up now you can login';
    }else{
        $failed='You can not sign in please try later or choose other email or username';
    }
    $sql="CREATE TABLE `php_chat`.`$username.chat` (`sno` INT(10) NOT NULL AUTO_INCREMENT , `dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`)) ENGINE = InnoDB";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT `username` FROM `users` WHERE `username`!='$username'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $add_user= $row['username'];
        $sqla="ALTER TABLE `$username.chat` ADD `$add_user` TEXT NOT NULL AFTER `sno`";
        $resulta=mysqli_query($conn,$sqla);
        $sqla="ALTER TABLE `$add_user.chat` ADD `$username` TEXT NOT NULL AFTER `sno`";
        $resulta=mysqli_query($conn,$sqla);
    }
    $sql="CREATE TABLE `php_chat`.`$username.added_users` (`sno` INT(10) NOT NULL AUTO_INCREMENT ,`add_user` VARCHAR(50) NOT NULL, `dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`)) ENGINE = InnoDB";
    $result=mysqli_query($conn,$sql);
    $sql="CREATE TABLE `php_chat`.`$username.post` (`sno` INT(10) NOT NULL AUTO_INCREMENT , `loc` VARCHAR(100) NOT NULL , `pic_name` VARCHAR(100) NOT NULL , `description` TEXT NOT NULL , `dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`)) ENGINE = InnoDB";
    $result=mysqli_query($conn,$sql);
    if(!file_exists("users/$username")){
        mkdir("users/$username");
    }
    $file_names=array("profile_pic","posts_pic");
    foreach ($file_names as $value) {
    if(!file_exists("users/$username/$value")){
        mkdir("users/$username/$value");
    }
    }
}
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
</head>

<body class="bg-dark text-primary">
<?php
    include "nav.php";
    if($failed){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Permission Denied</strong> '.$failed.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
            
    if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> '.$success.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
        
    ?>
    <main>
    <div class="w-100 h-100 bg-dark position-absolute z-3 d-flex justify-content-center align-items-center bg-opacity-75 top-0 start-0 " id="loading">
        <div class="spinner-border text-primary p-5" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
        </div>
        <div class="container mt-4 w-50 manu-min-width-300">
            <h3 class="text-center">Sign Up</h3>
            <form class="mt-2 " action="signup.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control border-info" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control border-info" name="email" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control border-info" id="password">
                </div>
                <button type="submit" class="btn btn-outline-primary ">Sign Up</button>
            </form>
            
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>