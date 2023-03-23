<?php
$sql="SELECT `add_user` FROM `$user_self.added_users`";
$result=mysqli_query($conn,$sql);
$count_user=0;
while($row=mysqli_fetch_assoc($result)){
    if($row['add_user']==$user_self){
        continue;
    }
    $count_user++;
    echo '
    <div class="card mb-1" role="button">
    <div class=" d-flex align-items-center justify-content-between px-3">
      <div class="text-center">
        <a class="text-decoration-none" href="chat.php?chat_user='.$row['add_user'].'">
        <span class="material-symbols-outlined p-3 border rounded-circle m-1">person</span>
        </a>
      </div>
      <div class="text-left">
        <div class="card-body">
          <h5 class="card-title" id="add_user'.$count_user.'">'.$row['add_user'].'</h5>
        </div>
      </div>
      <div>
      <form action="user_page.php#add_user'.$count_user.'" method="get">
      <button type="submit" class="btn btn-primary add_user" name="remove_user" value="'.$row['add_user'].'">Remove</button>
      </form>
      </div>
    </div>
  </div>';
    }
?>