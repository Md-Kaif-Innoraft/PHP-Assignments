/**
 * @var string @regex.
 *  Expression to check Alphabets and spaces.
 */
const regex = /^[a-zA-Z ]+$/;

/**
 *Function to check user inputs and display errors.
 *
 * @param string @inputId
 * @param string @errorId
 * @param string @fieldName
 * @param int @maxLength
 * @return boolean.
 */
function validateInputs (inputId, errorId, fieldName, maxLength) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  if (input == "") {
    error.innerHTML = "* " + fieldName + " is required.<br>";
    return false;
  }
  else if (!regex.test(input)) {
    error.innerHTML = "* Only letters and white space allowed for " + fieldName + ".<br><br>";
    return false;
  }
  else if (input.length >= maxLength) {
    error.innerHTML = "* " + fieldName + " should not contain more than " + maxLength + " characters.<br><br>";
    return false;
  }
  return true;
}

/**
 * Validating user inputs on client side
 *
 * @returns boolean.
 */
function validate(){
  var fnameValid = validateInputs("fname", "ferror", "First Name", 20);
  var lnameValid = validateInputs("lname", "lerror", "Last Name", 20);
  return fnameValid && lnameValid;
}

