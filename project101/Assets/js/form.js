document.getElementById('usertype').addEventListener('change', function() {

    var userType= this.value;
    if(userType === 'Admin') {
            document.getElementById('traineeFields').style.display='none';
            document.getElementById('adminFields').style.display='block';

            enableFields('adminFields');
            disableFields('traineeFields');

    }else if(userType==='Trainee') {
        document.getElementById('traineeFields').style.display='block';
        document.getElementById('adminFields').style.display='none';

            enableFields('traineeFields');
            disableFields('adminFields');
    }
});

function enableFields(fieldId){
    var fields = document.getElementById(fieldId).querySelectorAll('input, select, textarea ');
    fields.forEach (function(field) {
    field.disabled = false;

    });
}   

function disableFields(fieldId){
    var fields = document.getElementById(fieldId).querySelectorAll('input, select, textarea ');
    fields.forEach (function(field) {
    field.disabled = true;

    });
}   