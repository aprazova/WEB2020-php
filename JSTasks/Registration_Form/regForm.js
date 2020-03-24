function validate() {

    let password = document.getElementById("password").value;
    let regexUppercase = /[A-Z]/;
    let regexLowercase = /[a-z]/;
    let regexDigit = /\d/;

    let validatePass = document.getElementById("validatePassword").value;

    let result = true;

    if (!validateField(password, regexUppercase) || !validateField(password, regexLowercase) || !validateField(password, regexDigit)) {
        let msg = "<em> <font color='red'>Invalid password: </font> The password must contain uppercase, lowercase, and number.</em>";
        errorMsg("passwordError", msg);
        result = false;
    } else {
        hideMesg("passwordError");
    }

    if (password != validatePass) {
        let msg = "<em> <font color='red'> Wrong password: </font> Password and Validate password do not match.</em>";
        errorMsg("validatePasswordError", msg);
        result = false;
    } else {
        hideMesg("validatePasswordError");
    }

    if (result) {
        document.getElementById('msg').innerHTML = "<div>Your registration form has been processed. </div>"
    } else {
        document.getElementById('msg').innerHTML = "<div>Your registration form has not been processed. </div>"
    }

    return result;
}

function validateField(str, pattern) {
    let res = str.match(pattern);
    if (res == null) {
        return false;
    };

    return true;
}

function hideMesg(element) {
    let elementMsg = document.getElementById(element);
    if (elementMsg.innerHTML != "") {
        elementMsg.innerHTML = "";
    };
}

function errorMsg(element, msg) {
    document.getElementById(element).innerHTML = msg;
}