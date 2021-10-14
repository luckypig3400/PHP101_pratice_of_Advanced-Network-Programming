function validateForm() {
    account_input_check();
}

function account_input_check() {
    //https://stackoverflow.com/questions/3937513/javascript-validation-for-empty-input-field
    var accInput = document.forms["loginForm"]["account"].value;

    if (accInput == null || accInput == "") {
        alert("Please Fill the Account Field");
        return false;
    }
}