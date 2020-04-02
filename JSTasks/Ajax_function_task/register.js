function submitAction(){

  let url = './register.php'; 

  let callback = function (text) {
    console.log(text);                    
  };

  let uname = document.getElementById("username").value;
  let pass = document.getElementById("password").value;
  let validatePass= document.getElementById("validatePassword").value;

  let input = { uname,pass , validatePass};
  let inputJSON = JSON.stringify(input);

  ajax(url, {success: callback}, inputJSON);
}

function ajax(url, settings, json){
  let xhr = new XMLHttpRequest();

  xhr.onload = function(){
    if (xhr.status == 200) {
      settings.success(xhr.responseText);
    } else {
      console.error(xhr.responseText);
    }
  };
  
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/json")
  xhr.send(json);  
}


