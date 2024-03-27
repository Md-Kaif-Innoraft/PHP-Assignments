<?php

/**
 * FormValidator Class to validate form data.
 */
class FormValidator {

  /**
   * @var string $REGEXALPHA
   *  Regular expression to check alphabets and space.
   */
  const REGEXALPHA = "/^[a-zA-Z-\s' ]*$/";

  /**
   * @var string $fName
   *  First Name from user input.
   */
  private $fName;

  /**
   * @var string $lName
   *  Last Name from user Input.
   */
  private $lName;

  /**
   * @var string $fullName
   *  Full Name by adding first name and last name.
   */
  private $fullName;

  /**
   * @var string $fNameErr
   *  It stores first name error.
   */
  private $fNameErr;

  /**
   * @var string $lNameErr
   *  It stores Last name error.
   */
  private $lNameErr;

  /**
   * @var string $message
   *  It stores greeting message.
   */
  private $message;

  /**
   * @var string $fullNameErr
   *  It stores full name error.
   */
  private $fullNameError;

  /**
   * @var string $imgTEmpName
   *  It stores Temp File name of image File.
   */
  private $imgTempName;

  /**
   * @var string $imgName
   *  It stores File name of image File.
   */
  private $imgName;

  /**
   * @var string $tableErr
   *  It stores Marks Table error message.
   */
  private $tableErr;

  /**
   * @var array $result
   *  Array will store the marks and subjects of user.
   */
  private $result = [];

  /**
   * Constructor to set fName, lName, fullName,
   * fNameErr, lNameErr, fullNameErr, message.
   */
  public function __construct() {
    $this->fName = "";
    $this->lName = "";
    $this->fullName = "";
    $this->fNameErr = "";
    $this->lNameErr = "";
    $this->fullNameError = "";
    $this->message = "";
    $this->imgTempName = "";
    $this->imgName = "";
    $this->tableErr = "";
  }

  /**
   * Function to return Error in first name.
   *
   * @return string
   *  Return error message of first name.
   */
  public function getFirstNameErr(): string {
    return $this->fNameErr;
  }

  /**
   * Function to return Error in Last name.
   *
   * @return string
   *  Return error message of last name.
   */
  public function getLastNameErr(): string {
    return $this->lNameErr;
  }

  /**
   * Function to return Error in Full name.
   *
   * @return string
   *  Return error message of full name.
   */
  public function getFullNameError(): string {
    return $this->fullNameError;
  }

  /**
   * Function to return Full name.
   *
   * @return string
   *  Return full name.
   */
  public function getFullName(): string {
    return $this->fullName;
  }

  /**
   * Function to return Greeting Message.
   *
   * @return string
   *  Return greeting message of full name.
   */
  public function getMessage(): string {
    return $this->message;
  }

  /**
   * Function to return Temporary File name of Image file.
   *
   * @return string
   *  Return temporary image file name.
   */
  public function getImgTempName(): string {
    return $this->imgTempName;
  }

  /**
   * Function to return File name of Image file.
   *
   * @return string
   *  Return image file name.
   */
  public function getImgName(): string {
    return $this->imgName;
  }

  /**
   * Function to return MArks Table Error.
   *
   * @return string
   *  Return error upon wrong entered marks.
   */
  public function getTableErr(): string {
    return $this->tableErr;
  }

  /**
   * Function to return Marks and subejcts Array.
   *
   * @return array
   *  Return array of subject and marks.
   */
  public function getMarksTable(): array {
    return $this->result;
  }

  /**
   * Function to check and sanitize user inputs.
   *
   * @param string $data
   *  Data from input field.
   *
   * @return string
   *  Return data after sanitize.
   */
  public function checkInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /**
   * Function to validate user inputs.
   *
   * @param string $name
   *  Name from user input.
   * @param string $error
   *  Error for updating error.
   * @param string $fildname
   *  Field Name of user input.
   *
   * @return string
   *  Return input upon validation otherwise null.
   */
  public function validateInput(string $name, string &$error, string $fieldName): string {
    // Check for empty Name.
    if (empty($name)) {
      $error = "* $fieldName Name is required";
      return "";
    }
    else {
      $name = $this->checkInput($name);
      // Matching Regex.
      if (!preg_match(self::REGEXALPHA, $name)) {
        $error = "* Only letters and white space allowed";
        return "";
      }
      else if (empty ($name)) {
        $error = "* Empty! Please enter valid $fieldName Name.";
        return "";
      }
      return $name;
    }
  }

  /**
   * Function to check user marks and store in a array.
   *
   * @param string $marksData
   *  Marks data from user input.
   *
   * @return array
   *  Return an array of subjects and marks.
   */
  public function storeMarks (string $marksData): array {
    $marksArray = explode("\n", $marksData);
    $result = [];
    // Loop through each subject and marks pair.
    foreach ($marksArray as $mark) {
      // Splitting subject and marks pair.
      $marks = explode ("|", $mark);
      if (count($marks) == 2) {
        if (is_numeric($marks[0]) && !is_numeric($marks[1])) {
          $result[$marks[1]] = $marks[0];
        }
        else if (is_numeric($marks[1]) && !is_numeric(($marks[0]))) {
          $result[$marks[0]] = $marks[1];
        }
        else {
          $this->tableErr = "* Invalid Marks Input.";
        }
      }
    }
    return $result;
  }

  /**
   * Function to process form data by checking form post method.
   */
  public function processForm() {
    // Checking if the form is submitted or not.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $this->fName = $this->validateInput($_POST['fName'], $this->fNameErr, "First");
      $this->lName = $this->validateInput($_POST['lName'], $this->lNameErr, "Last");

      // Checking First name and Last name is not empty to set full name and message.
      if (!empty ($this->fName) && !empty ($this->lName)) {
        $this->fullName = "$this->fName $this->lName";
        $this->message = "Hello, $this->fullName.";
      }
      // Checking if Full name field is not filled otherwise display error.
      if (!empty ($_POST['fullName'])) {
        $this->fullNameError = "* Invalid Input, You can't enter any value in Full Name.";
      }
      // Storing Image file and uploading.
      if (!empty($_FILES['image']['name'])) {
      $this->imgTempName = $_FILES['image']['tmp_name'];
      $this->imgName = $_FILES['image']['name'];
      move_uploaded_file($this->getImgTempName(), "uploads/$this->imgName");
      }
      if (!empty($_POST['sub'])) {
        $this->result = $this->storeMarks($_POST['sub']);
      }
    }
  }
}

// Creating formValidator object from FormValidator.
$formValidator = new FormValidator();
// Calling processForm() Method.
$formValidator->processForm();
