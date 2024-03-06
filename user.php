<?php

//creating a class named User.
class User
{
    private $fname;
    private $lname;

    function __construct($fname, $lname)
    {
        $this->fname = $fname;
        $this->lname = $lname;
    }

    function getFname()
    {
        return $this->fname;
    }

    function getLname()
    {
        return $this->lname;
    }
}
?>