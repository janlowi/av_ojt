const inputValue = document.getElementById('pass')
let lower = document.getElementById('lower');
let upper = document.getElementById('upper');
let number = document.getElementById('number');
let length = document.getElementById('length');


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