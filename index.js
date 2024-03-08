// Regular expression for validation.

const regex = /^[a-zA-Z ]+$/;
const numberRegex = /^[0-9]+$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

/* Function to validate user inputs fields */
function validateInputs(inputId, errorId, fieldName, maxLength, regex) {
    var input = document.getElementById(inputId).value.trim();
    var error = document.getElementById(errorId);
    if (input == "") {
        error.innerHTML = "* " + fieldName + " is required.<br>";
        return false;
    } else if (!regex.test(input)) {
        error.innerHTML = "* Invalid Input " + fieldName + ".<br><br>";
        return false;
    } else if (input.length >= maxLength) {
        error.innerHTML = "* " + fieldName + " should not contain more than " + maxLength + " characters.<br><br>";
        return false;
    }
    return true;
}

// Function to validate email input
function validateEmail(inputId, errorId, fieldName) {
    var input = document.getElementById(inputId).value.trim();
    var error = document.getElementById(errorId);
    if (input == "") {
        error.innerHTML = "* " + fieldName + " is required.<br>";
        return false;
    } else if (!emailRegex.test(input)) { // Using emailRegex for email validation
        error.innerHTML = "* Invalid " + fieldName + ". Please enter a valid email address.<br><br>";
        return false;
    }
    return true;
}

function validateNum(inputId, errorId, fieldName, maxLength, regex) {
    var input = document.getElementById(inputId).value.trim();
    var error = document.getElementById(errorId);
    if (input == "") {
        error.innerHTML = "* " + fieldName + " is required.<br>";
        return false;
    } else if (!regex.test(input)) {
        error.innerHTML = "* Invalid Input " + fieldName + ".<br><br>";
        return false;
    } else if (input.length != maxLength) {
        error.innerHTML = "* " + fieldName + " should only " + maxLength + " characters.<br><br>";
        return false;
    }
    return true;
}

function validateMarks(inputId, errorId) {
    var input = document.getElementById(inputId).value;
    var error = document.getElementById(errorId);
    var marksArray = input.split("\n");

    if (document.getElementById(inputId).value.trim() === "") {
        error.innerHTML = "* Invalid Marks Entered.<br>";
        return false;
    }

    var isValid = false;

    for (var i = 0; i < marksArray.length; i++) {
        var marks = marksArray[i].split("|");
        if (marks.length !== 2 || marks[0].trim() === "" || marks[1].trim() === "" || (!isNaN(marks[0]) && !isNaN(marks[1]))) {
            error.innerHTML = "* Invalid Marks Entered.<br>";
            return false;
        }
        // Set isValid to true if at least one element is a number
        if (!isNaN(marks[0]) || !isNaN(marks[1])) {
            isValid = true;
        }
    }

    if (!isValid) {
        error.innerHTML = "* At least one mark should be a non-empty string representing a number.<br>";
        return false;
    }

    return true;
}

/* Validating user inputs on client side. */
function validate() {
    var fnameValid = validateInputs("fname", "ferror", "First Name", 20, regex);
    var lnameValid = validateInputs("lname", "lerror", "Last Name", 20, regex);
    var emailValid = validateEmail("email", "emailErr", "Email");
    var numberValid = validateNum("number", "nerror", "Phone Number", 10, numberRegex);
    if (document.getElementById("number").value.trim().length != 10) {
        numberValid = false;
        nerror.innerHTML = "* Phone Number should contain exactly 10 characters.<br><br>";
    }
    var validMarks = validateMarks("sub", "serror");

    return fnameValid && lnameValid && emailValid && numberValid && validMarks;
}
