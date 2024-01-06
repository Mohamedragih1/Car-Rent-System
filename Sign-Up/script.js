function validateForm() {
    var fName = document.forms["myForm"]["name"].value;
    var lName = document.forms["myForm"]["Surname"].value;
    var email = document.forms["myForm"]["email"].value;
    var password = document.forms["myForm"]["password"].value;
    var phone = document.forms["myForm"]["phone"].value;
    var SSN = document.forms["myForm"]["SSN"].value;
    var birthdate = document.forms["myForm"]["Birthdate"].value;

    if((fName == "")){
        alert("Input Name");
        return false;
    }

    if((lName == "")){
        alert("Input Name");
        return false;
    }

    if((email == "")){
        alert("Input Email");
        return false;
    }

    if((password == "")){
        alert("Input Password");
        return false;
    }

    if((phone == "")){
        alert("Input phone number");
        return false;
    }

    if((SSN == "")){
        alert("input SSN");
        return false;
    }

    if((birthdate == "")){
        alert("Input date of birth");
        return false;
    }

    return true;
}