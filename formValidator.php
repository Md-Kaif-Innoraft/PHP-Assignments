<?php

  require 'fetchApi.php';
  // Include Composer's autoloader.
  require_once './vendor/autoload.php';
  use Dotenv\Dotenv;
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
     * @var string.
     *  Regular expression to check Number.
     */
    const regexNum = "/^[0-9]+$/";
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
     * @var string @imgTEmpName.
     *  It stores Temp File name of image File.
     */
    private $imgTempName;
    /**
     * @var string @imgName.
     *  It stores File name of image File.
     */
    private $imgName;
    /**
     * @var string @numErr.
     *  It stores Phone number error message.
     */
    private $numErr;
    /**
     * @var string @numMSg.
     *  It stores Phone number message.
     */
    private $numMsg;
    /**
     * @var string @emailErr.
     *  It stores Email id error message.
     */
    private $emailErr;
    /**
     * @var string @tableErr.
     *  It stores Marks Table error message.
     */
    private $tableErr;
    /**
     * @var string @emailMsg.
     *  It stores Email message upon successful validation of email id.
     */
    private $emailMsg;
    /**
     * @var string @emailSuccess.
     *  It stores Email Success message upon successful validation of email id.
     */
    private $emailSuccess;
    /**
     * @var string @email.
     *  It stores Email iduse Dotenv\Dotenv; from user input.
     */
    private $email;
    /**
     * @var string @num.
     *  It stores Phone number from user input.
     */
    private $num;
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
      $this->numErr = "";
      $this->email = "";
      $this->emailErr = "";
      $this->tableErr = "";
      $this->emailSuccess = "";
      $this->emailMsg = "";
      $this->num = "";
      $this->numMsg = "";
      $this->tableErr = "";
    }
    /**
     * Function to return Error in first name.
     *
     * @return string.
     *  return error message of first name.
     */
    public function getFirstNameErr(): string {
      return $this->fNameErr;
    }
    /**
     * Function to return Error in Last name.
     *
     * @return string.
     *  return error message of last name.
     */
    public function getLastNameErr(): string {
      return $this->lNameErr;
    }
    /**
     * Function to return Error in Full name.
     *
     * @return string.
     *  return error message of full name.
     */
    public function getFullNameError(): string {
      return $this->fullNameError;
    }
    /**
     * Function to return Full name.
     *
     * @return string.
     *  return full name.
     */
    public function getFullName(): string {
      return $this->fullName;
    }
    /**
     * Function to return Greeting Message.
     *
     * @return string.
     *  return greeting message of full name.
     */
    public function getMessage(): string {
      return $this->message;
    }
    /**
     * Function to return Temporary File name of Image file.
     *
     * @return string.
     *  return temporary image file name.
     */
    public function getImgTempName(): string {
      return $this->imgTempName;
    }
    /**
     * Function to return File name of Image file.
     *
     * @return string.
     *  return image file name.
     */
    public function getImgName(): string {
      return $this->imgName;
    }
    /**
     * Function to return email error message.
     *
     * @return string.
     *  return error message of email id.
     */
    public function getEmailErr(): string {
      return $this->emailErr;
    }
    /**
     * Function to return Number error message.
     *
     * @return string.
     *  return error message of phone number.
     */
    public function getNumErr(): string {
      return $this->numErr;
    }
    /**
     * Function to return Email success message upon email validation.
     *
     * @return string.
     *  return success message upon email validation.
     */
    public function getEmailSuccess(): string {
      return $this->emailSuccess;
    }
    /**
     * Function to return Email message upon email validation.
     *
     * @return string.
     *  return  message uopn email validation.
     */
    public function getEmailMsg(): string {
      return $this->emailMsg;
    }
    /**
     * Function to return MArks Table Error.
     *
     * @return string.
     *  return error upon wrong entered marks.
     */
    public function getTableErr(): string {
      return $this->tableErr;
    }
    /**
     * Function to return Phone Number.
     *
     * @return string.
     *  return number message.
     */
    public function getNumMsg(): string {
      return $this->numMsg;
    }
    public function getMarksTable(): array {
      return $this->result;
    }

    /**
     * Function to check and sanitize user inputs.
     *
     * @param string $data.
     *
     * @return string.
     *  retun data afer sanitize.
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
     *
     * @return string.
     *  return input upon validation otherwise null.
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
     * Function to validate Phone Number.
     *
     * @param string @num.
     *  Phone number from user input field.
     * @param string @errorId.
     *  Error id of input field.
     *
     * @return void.
     */
    public function validateNum(string $num, string &$error): void {
      //Check for empty Name.
      $this->num = $this->checkInput($num);
      if (!empty ($this->num) && strlen($this->num) == 10 && preg_match(self::regexNum, $this->num)) {
        $this->num = "+91 {$this->num}";
        $this->numMsg = "Your Phone number is: " .$this->num;
      }
      else {
       $this->numErr = "Invalid Phone number.";
      }
    }
    /**
     * Function to validate user email.
     *
     * @param string @email.
     *  Email id of user from input field.
     * @param string @emailErr.
     *  MmialErr to store error message.
     * @param string @emailSuccess.
     *  Success message upon successful email validation from input field.
     * @param string @emailMsg.
     *  Message upon successful email validation from input field.
     *
     * @return string.
     *  return input email upon validation otherwise null.
     */
    public function validateEmail($email, &$emailErr, &$emailSuccess, &$emailMsg): string {
      //Check empty $email.
      if (empty($email)) {
        $this->emailErr = "* Email is required";
        return "";
        }
        else {
          $this->email = $this->checkInput($email);
          if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "* Invalid email format.";
            return "";
          }
          else {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            $data = (new FetchApi($_ENV['API_KEY'] . $email))->callApi();
            //Check if email deliverability is not "DELIVERABLE" and it's not a disposable email or has an invalid format.
            if ($data['deliverability'] != "DELIVERABLE" && $data['is_disposable_email']['value'] != "false" && $data['is_valid_format']['text'] != "true") {
              // Set an error message for invalid email
              $this->emailErr = "* Invalid email.";
              // Return an empty string to indicate validation failure.
              return "";
            }
            // If email is valid, set success messages and return the email address.
            $this->emailMsg = "Your email id is: $email";
            $this->emailSuccess = "Email validated successfully.";
            return $this->email;
          }
        }
    }

    /**
     * Function to check user marks and store in a array.
     *
     * @param string $marksData.
     *  Marks data from user input.
     *
     * @return array.
     *  retun an array of subjects and marks.
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
      //Checking if the form is submitted or not.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->fName = $this->validateInput($_POST['fName'], $this->fNameErr, "First");
        $this->lName = $this->validateInput($_POST['lName'], $this->lNameErr, "Last");
        $this->email = $this->validateEmail($_POST['email'], $this->emailErr, $this->emailSuccess, $this->emailMsg);
        $this->validateNum($_POST['number'], $this->numErr);

        //Checking First name and Last name is not empty to set full name and message.
        if (!empty ($this->fName) && !empty ($this->lName)) {
          $this->fullName = "$this->fName $this->lName";
          $this->message = "Hello, $this->fullName.";
        }
        //Checking if Full name field is not filled otherwise display error.
        if (!empty ($_POST['fullName'])) {
          $this->fullNameError = "* Invalid Input, You can't enter any value in Full Name.";
        }
        //Storing Image file and uploading.
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
  //Creating formValidator object from FormValidator.
  $formValidator = new FormValidator();
  //Calling processForm() Method.
  $formValidator->processForm();

?>
