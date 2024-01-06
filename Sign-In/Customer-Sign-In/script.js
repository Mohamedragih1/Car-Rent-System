function validateForm() {
    var email = document.forms["myForm"]["email"].value;
    var password = document.forms["myForm"]["password"].value;

    if((email == "")){
        alert("Input Email");
        return false;
    }
    if((password == "")){
        alert("Input Password");
        return false;
    }
}
