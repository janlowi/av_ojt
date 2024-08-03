
  document.addEventListener('DOMContentLoaded', function() {
    const changePasswordLink = document.getElementById('changePasswordLink');
    const changePass = document.getElementById('changePass');
    changePasswordLink.addEventListener('click', function(event) {
      event.stopPropagation(); // Stop propagation to prevent dropdown from closing
      
    });
    changePass.addEventListener('click', function(event) {
      event.stopPropagation(); // Stop propagation to prevent dropdown from closing
      
    });
  });

const toggleCurrPassword = document.querySelector("#showCurrPassword");
const toggleNewPassword = document.querySelector("#showNewPassword");
const toggleConfirmPassword = document.querySelector("#showConfirmPassword");
const currPassword = document.querySelector("#currPass");
const password = document.querySelector("#password");
const confirmPass = document.querySelector("#confirmPass");

toggleNewPassword.addEventListener("click", function () {
    if(password.type === 'password'){
        password.type = 'text';
        toggleNewPassword.classList.remove('fa-eye');
        toggleNewPassword.classList.add('fa-eye-slash');
    }else{
        password.type = 'password';
        toggleNewPassword.classList.remove('fa-eye-slash');
        toggleNewPassword.classList.add('fa-eye');
    }

});
toggleCurrPassword.addEventListener("click", function () {
    if(currPassword.type === 'password'){
        currPassword.type = 'text';
        toggleCurrPassword.classList.remove('fa-eye');
        toggleCurrPassword.classList.add('fa-eye-slash');
    }else{
        currPassword.type = 'password';
        toggleCurrPassword.classList.remove('fa-eye-slash');
        toggleCurrPassword.classList.add('fa-eye');
    }

});
toggleConfirmPassword.addEventListener("click", function () {
    if(confirmPass.type === 'password'){
        confirmPass.type = 'text';
        toggleConfirmPassword.classList.remove('fa-eye');
        toggleConfirmPassword.classList.add('fa-eye-slash');
    }else{
        confirmPass.type = 'password';
        toggleConfirmPassword.classList.remove('fa-eye-slash');
        toggleConfirmPassword.classList.add('fa-eye');
    }

});

