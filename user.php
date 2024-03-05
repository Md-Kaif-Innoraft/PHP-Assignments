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

    function get_Fname()
    {
        return $this->fname;
    }

    function get_Lname()
    {
        return $this->lname;
    }
}
?>