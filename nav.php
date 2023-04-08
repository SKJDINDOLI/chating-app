<?php
echo '<nav class="navbar navbar-expand-lg bg-body-primary bg-primary  sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="welcome.php"><img src="img/chating app-logos_transparent.png" style="height: 70px;" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">';
      if(isset($_SESSION['loggedin'])){
        echo '<li class="nav-item ">
          <a class="nav-link active text-light" aria-current="page" href="welcome.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="user_page.php">Users</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="post.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>';
      }
      if(!isset($_SESSION['loggedin'])){
        echo '<li class="nav-item ">
          <a class="nav-link text-light" href="index.php">Login</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="signup.php">Sign Up</a>
        </li>
        ';
      }
      echo '</ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2 " id="search_box" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>';



?>