function validateForm() {
    account_input_check();
}

function account_input_check() {
    //https://stackoverflow.com/questions/3937513/javascript-validation-for-empty-input-field
    var accInput = document.forms["loginForm"]["account"].value;
    
    if (accInput == null || accInput == "") {
        alert("Please Fill the Account Field");
        returnToPreviousPage();
        return false;
    }else if(accInput.length < 4 || accInput.length >10){
        alert("Account Length should between 4~10 characters");
        returnToPreviousPage();
        return false;
    }else{
        return true;
    }

}

//stop form post request
//https://stackoverflow.com/questions/8664486/javascript-code-to-stop-form-submission
function returnToPreviousPage(){
    window.location.replace("../login.php");
    window.history.back();
}