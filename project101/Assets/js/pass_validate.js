
const inputValue = document.g
let lower = document.getElementById('lower');
let upper = document.getElementById('upper');
let number = document.getElementById('number');
let length = document.getElementById('length');



 inputValue.onfocus = function() {
     document.getElementById('message').style.display = "block";

      
 }
 inputValue.onblur = function() {
     document.getElementById('message').style.display = 'none';
    
 }



 inputValue.onkeyup = function (){
    var lowerCase = /[a-z]/g;
    if(inputValue.value.match(lowerCase)) {
        lower.classList.remove("invalid");
        lower.classList.add("valid");
    } 
    else {
        lower.classList.remove("valid");
        lower.classList.add("invalid");
    }

    var upperCase = /[A-Z]/g;
    if(inputValue.value.match(upperCase)){
        upper.classList.remove("invalid");
        upper.classList.add("valid");
    } 
    else {
        upper.classList.remove("valid");
        upper.classList.add("invalid");
    }

    var numbers = /[0-9]/g;
    if(inputValue.value.match(numbers)){
        number.classList.remove("invalid");
        number.classList.add("valid");
    } 
    else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    if(inputValue.value.length >=9){
        length.classList.remove("invalid");
        length.classList.add("valid");
    } 
    else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    
}
//  function validate(){
//     if(email.value=="" && pass.value==""){
//         alert("Please fill all the fields...");
//         return false;
//     }
//     if(inputValue.value != reInput.value ){
//     alert("password does not match, please try again");
//     return false;
// }
//     if(email.value.length <8 || email.value == " "){
//         alert("please fill email and  must be greater than 9 characters");
//         return false;
//     }
//     if(username.value.length <8 || username.value == " "){
//         alert("please fill username and  must be greater than 9 characters");
//         return false;
//     }

//  } 

 //createbutton first modal
 const nextForm = document.getElementById('nextform');
 console.log(nextForm);