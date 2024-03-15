<?php

/**
 * Class User.
 *
 * @var string @fname private.
 * Stores first Name of user.
 * @var string @lname private.
 * Stores Last Name of user.
 */
class User
{
    private $fname;
    private $lname;

    /**
     * Constructer to set instance variables.
     *
     * @param string @fname.
     *
     * @param string @lname.
     */

    function __construct(string $fname, string $lname) {
      $this->fname = $fname;
      $this->lname = $lname;
    }

    /**
     * Method to return First name.
     *
     * @return $fname type string.
     */

    function getFname() {
      return $this->fname;
    }
    /**
     * Method to return Last name.
     *
     * @return $lname type string
     */
    function getLname() {
      return $this->lname;
    }
}
?>
