

document.body.onload = ()=>{
  const{signUpForm}=document.forms;
  signUpForm.onsubmit=function onFormSubmit(ev){
    if(validateSignUpForm()){
      return true;
    }
    ev.preventDefault();
  }
  const{logInForm}=document.forms;
  logInForm.onsubmit=function onFormSubmit(ev){
    if(validatelogInForm()){
      return true;
    }
    ev.preventDefault();
  }
  function validatelogInForm(){
    const {email,password}=logInForm.elements;
    if (!validateEmail(email.value)){return false;}
    if (!validatePassword(password.value)){return false;}
    return true;
  }

  function validateSignUpForm(){
    const {name,email,username,password,password_confirm}=signUpForm.elements;
    if (!validateNombreApellido(name.value)){return false;}
    if (!validateEmail(email.value)){return false;}
    if (!checkExiste(email.value)){return false;}
    if (!validateusername(username.value))return false;
    if (!validatePassword(password.value))return false;
    if (!validateRepass(password.value,password_confirm.value))return false;
    return true;
  }

  function validateEmail(email){
    var re=/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(re.test(email))return true;
    swal('Ingrese un email valido');
    return false;
  }


  function checkExiste(email){
    var ajax= $.ajax({
      method: 'GET',
      url: '/checkusers',
      data: {'email' : email},
      success: function(response)
      {
        if(ajax['responseText']==='true')
        {
          swal('El email existe en base de datos')
          return false;
        }
        if(ajax['responseText']==='false')
        {
          // swal('El email existe en base de datos')
          return false;
        }
      },
      error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      }
    });
    return true;

  }



  function validatePassword(password){
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
    if(re.test(password))return true;
    swal('Ingrese una contraseña de 8 digitos con una mayuscula, una miniscula y un numero');
    return false;
  }
  const validateRepass = (password,password_confirm)=> {
    if(password===password_confirm)return true;
    swal('Los Pass no coinciden');
    return false;
  }
  function validateNombreApellido(name){
    if(name.length >0)return true;
    swal ('Ingrese su nombre y Apellido');
    return false;
  }
  function validateusername(username){
    if(username.length >0)return true;
    swal ('Ingrese su usuario');
    return false;
  }



}
document.onload=getCount();
function getCount(){
  var ajax=$.ajax({
    method: 'GET',
    url: '/usersCount',
    success: function(){ // What to do if we succeed
      if(ajax['statusText']==='OK'){
        document.getElementById("userCount").innerHTML = ajax['responseText'];
      }
    },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
    }
  });}
  document.onload=setInterval(getCount,30000);






  var myIndex = 0;
  carousel();
  function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 5000); // Change image every 2 seconds
  }
  // console.log('hi');
