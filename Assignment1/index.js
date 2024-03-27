/**
 * @var string regex
 *  Expression to check Alphabets and spaces.
 */
const REGEX = /^[a-zA-Z ]+$/;

/**
 *Function to check user inputs and display errors.
 *
 * @param string inputId
 *  Input id of input field.
 * @param string errorId
 *  Error id of input field.
 * @param string fieldName
 *  Field name of input field.
 * @param int maxLength
 *  length of input from user.
 *
 * @return boolean
 *  Return true if validation is correct else false.
 */
function validateInputs (inputId, errorId, fieldName, maxLength) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  if (input == "") {
    error.innerHTML = "* " + fieldName + " is required.<br>";
    return false;
  }
  else if (!REGEX.test(input)) {
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
 * @return boolean
 *  Return true if all validations are correct else false.
 */
function validate(){
  var fnameValid = validateInputs("fName", "ferror", "First Name", 20);
  var lnameValid = validateInputs("lName", "lerror", "Last Name", 20);
  return fnameValid && lnameValid;
}
