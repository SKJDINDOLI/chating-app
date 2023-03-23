<?php
include "connection.php";
$checkuser=false;
$failed=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);
    $sql="SELECT * FROM `users`";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if($username==$row['username'] && $password==$row['password']){
        $checkuser=true;
        break;
        }
    }
    if($checkuser==true){
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("Location:welcome.php");
}else{
    $failed=true;
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
                <strong>Permission Denied</strong> You should check username or password and try again.
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
        <div class="container mt-4 manu-min-width-300 w-50">
            <h3 class="text-center">Login</h3>
            <form class="mt-2" action="index.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control border-info" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control border-info" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="alert alert-primary d-flex mt-3 " role="alert">
                New at Chatroom <a class="nav-link bg-light mx-1" href="signup.php"> Sign Up </a> first.
              </div>
        </div>
        <?php
        // INSERT INTO `sk.post` (`sno`, `loc`, `pic_name`, `description`, `dt`) VALUES (NULL, 'dindoli', 'ram_ji', 'god ram pic', current_timestamp());
        ?>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>