<?php
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
header("location:#$message_id");
?>