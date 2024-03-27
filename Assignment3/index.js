/**
 * @var string regex.
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
function validateInputs(inputId, errorId, fieldName, maxLength) {
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
 * Function to validate user marks and subjects.
 * @param string inputId
 *  Input id of input field.
 * @param string errorId
 *  Error id of input field.
 *
 * @return boolean
 *  Return true if marks and subject inputs are correct otherwise false.
 */
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
    // Set isValid to true if at least one element is a number.
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

/**
 * Validating user inputs on client side.
 *
 * @return boolean
 *  Return true if all the validations are correct otherwise false.
 */
function validate(){
  var fnameValid = validateInputs("fName", "ferror", "First Name", 20);
  var lnameValid = validateInputs("lName", "lerror", "Last Name", 20);
  var validMarks = validateMarks("sub", "serror");
  return fnameValid && lnameValid && validMarks;
}
