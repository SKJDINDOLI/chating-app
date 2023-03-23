if(document.getElementById("user1")){
  let search_box=document.getElementById("search_box");
search_box.addEventListener("input",()=>{
    for(let i=1;i<=4;i++){
        let user=document.getElementById("user"+i).innerHTML.toUpperCase();
        let search_user=search_box.value.toUpperCase()
       if(user.indexOf(search_user)>-1){
        document.getElementById("select_user"+i).style.display="";
       }else{
        document.getElementById("select_user"+i).style.display="none";
       }
    }
})
}

window.addEventListener("load", (event) => {
    document.getElementById("loading").classList.remove("d-flex");
    document.getElementById("loading").classList.add("d-none");
  });

  let add_user=document.getElementsByClassName("add_user");
  
  Array.from(add_user).forEach((e)=>{
    e.addEventListener("click",()=>{
        if(e.innerHTML!="Remove"){
            e.innerHTML="Remove";
        }else{
            e.innerHTML="Add";
        }
    })
    
  })
  if(document.getElementById("added_users_btn")){
  document.getElementById("added_users_btn").addEventListener("click",()=>{
    document.getElementById("added_users").classList.remove("d-none");
    document.getElementById("my_posts").classList.add("d-none");
  })
}
if(document.getElementById("my_posts_btn")){
  document.getElementById("my_posts_btn").addEventListener("click",()=>{
    document.getElementById("added_users").classList.add("d-none");
    document.getElementById("my_posts").classList.remove("d-none");
  })
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

let message_id=document.getElementById("message_id").value-1;
if(document.getElementById("message_delete")){
  let chat_user=document.getElementById("chat_user").value;
  // let message_id=document.getElementById("message_id").value-1;
  window.location=`chat.php?chat_user=${chat_user}#${message_id}`;
}
window.addEventListener("load", (event) => {
document.getElementById("loading").classList.remove("d-flex");
document.getElementById("loading").classList.add("d-none");
});
  setInterval( () =>{
  // $(`#${message_id}`).load(window.location.href +  ` #${message_id}`);
  // $(`#${message_id}`).load(window.location.href +  ` #chat_div`+ ` #${message_id}`);
  window.location=`#chat_div`;
  window.location=`#${message_id}`;
}, 3000);  
