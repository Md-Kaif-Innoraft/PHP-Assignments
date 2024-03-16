<?php

  /**
   * FormValidator Class to validate form data.
   */
  class FormValidator {
    /**
     * @var string.
     *  Regular expression to check alphabets and space.
     */
    const regexAlpha = "/^[a-zA-Z-\s' ]*$/";
    /**
     * @var string @fName.
     *  First Name from user input.
     */
    private $fName;
    /**
     * @var string @lName.
     *  Last Name from user Input.
     */
    private $lName;
    /**
     * @var string @fullName.
     *  Full Name by adding first name and last name.
     */
    private $fullName;
    /**
     * @var string @fNameErr.
     *  It stores first name error.
     */
    private $fNameErr;
    /**
     * @var string @lNameErr.
     *  It stores Last name error.
     */
    private $lNameErr;
    /**
     * @var string @message.
     *  It stores greeting message.
     */
    private $message;
    /**
     * @var string @fullNameErr.
     *  It stores full name error.
     */
    private $fullNameError;
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
    }
    /**
     * Function to return Error in first name.
     *
     * @return string.
     */
    public function getFirstNameErr(): string {
      return $this->fNameErr;
    }
    /**
     * Function to return Error in Last name.
     *
     * @return string.
     */
    public function getLastNameErr(): string {
      return $this->lNameErr;
    }
    /**
     * Function to return Error in Full name.
     *
     * @return string.
     */
    public function getFullNameError(): string {
      return $this->fullNameError;
    }
    /**
     * Function to return Full name.
     *
     * @return string.
     */
    public function getFullName(): string {
      return $this->fullName;
    }
    /**
     * Function to return Greeting Message.
     *
     * @return string.
     */
    public function getMessage(): string {
      return $this->message;
    }
    /**
     * Function to check and sanitize user inputs.
     *
     * @param string $data.
     * @return string.
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
     * @param string $name.
     *  Name from user input.
     * @param string $error.
     *  Error for updating error.
     * @param string $fildname.
     *  Field Name of user input.
     * @return string.
     */
    public function validateInput(string $name, string &$error, string $fieldName): string {
      //Check for empty Name.
      if (empty($name)) {
        $error = "* $fieldName Name is required";
        return "";
      }
      else {
        $name = $this->checkInput($name);
        //Matching Regex.
        if (!preg_match(self::regexAlpha, $name)) {
          $error = "* Only letters and white space allowed";
          return "";
        }
        else if (empty ($name)) {
          $error = "* Empty! Please enter valid $fieldName Name.";
          return "";
        }
        else {
          return $name;
        }
      }
    }
    /**
     * Function to process form data by checking form method.
     */
    public function processForm() {
      //Checking if the form is submitted or not.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->fName = $this->validateInput($_POST['fName'], $this->fNameErr, "First");
        $this->lName = $this->validateInput($_POST['lName'], $this->lNameErr, "Last");
        //Checking First name and Last name is not empty to set full name and message.
        if (!empty ($this->fName) && !empty ($this->lName)) {
          $this->fullName = "$this->fName $this->lName";
          $this->message = "Hello, $this->fullName.";
        }
        //Checking if Full name field is not filled otherwise display error.
        if (!empty ($_POST['fullName'])) {
          $this->fullNameError = "* Invalid Input, You can't enter any value in Full Name.";
        }
      }
    }
  }
?>

