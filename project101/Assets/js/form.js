document.getElementById('usertype').addEventListener('change', function() {
    var userType = this.value;
    if (userType === 'Admin') {
        document.getElementById('traineeForm').style.display = 'none';
        document.getElementById('adminForm').style.display = 'block';
        document.getElementById('managerForm').style.display = 'block';
        disableFields('traineeForm'); 
        disableFields('managerForm'); 
        enableFields('adminForm');   
        
    } else if (userType === 'Trainee') {
        document.getElementById('traineeForm').style.display = 'block';
        document.getElementById('managerForm').style.display = 'block';
        document.getElementById('adminForm').style.display = 'none';
        enableFields('traineeForm');  
        disableFields('managerForm'); 
        disableFields('adminForm');   

    } else if(userType === 'Manager'){
        document.getElementById('traineeForm').style.display = 'none';
        document.getElementById('managerForm').style.display = 'block';
        document.getElementById('adminForm').style.display = 'none';
        disableFields('traineeForm'); 
        enableFields('managerForm'); 
        disableFields('adminForm');   
    }
});

function enableFields(formId) {
    var form = document.getElementById(formId);
    var inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
}

function disableFields(formId) {
    var form = document.getElementById(formId);
    var inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.disabled = true;
    });
}
