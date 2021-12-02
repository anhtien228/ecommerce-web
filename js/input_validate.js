  function login_validation(){
      var input_username = document.querySelector("#input_username");
      var input_password = document.querySelector("#input_password");
      var error_msg = document.querySelector(".error_msg");
    
      if(input_username.value.length <= 5){
        error_msg.style.display = "inline-block";
        input_username.style.border = "1px solid #f74040";
        return false;
      }
      else if(input_password.value.length < 8){
        error_msg.style.display = "inline-block";
        input_password.style.border = "1px solid #f74040";
        return false;
      }
      else{
        // alert("Logged in Succesfully!")
        return true;
      }
    }

  function register_validation(){
    var user_level = document.getElementById('user_level');

    var input_firstname = document.querySelector("#input_firstname");
    var input_lastname = document.querySelector("#input_lastname");
    var input_username_user = document.querySelector("#input_username_user");
    var input_password_user = document.querySelector("#input_password_user");
    
    var error_name = document.querySelector(".error_name");
    var error_username = document.querySelector(".error_username");
    var error_password = document.querySelector(".error_password");
    
    if(input_firstname.value.length <= 1 && !user_level.checked){
      error_name.style.display = "inline-block";
      input_firstname.style.border = "1px solid #f74040";
      return false;
    }
    if(input_lastname.value.length <= 1 && !user_level.checked){
      error_name.style.display = "inline-block";
      input_lastname.style.border = "1px solid #f74040";
      return false;
    }
    else if(input_username_user.value.length <= 5 && !user_level.checked){
      error_username.style.display = "inline-block";
      input_username_user.style.border = "1px solid #f74040";
      return false;
    }
    else if(input_password_user.value.length < 8 && !user_level.checked) {
      error_password.style.display = "inline-block";
      input_password_user.style.border = "1px solid #f74040";
      return false;
    }
    else{
      // alert("Logged in Succesfully!")
      return true;
    }
  }
  
  var input_fields = document.querySelectorAll(".input");
  var login_btn = document.querySelector("#login_btn");
  
  input_fields.forEach(function(input_item){
    input_item.addEventListener("input", function(){
      if(input_item.value.length > 5){
        login_btn.disabled = false;
        login_btn.className = "btn enabled"
      }
    })
  })