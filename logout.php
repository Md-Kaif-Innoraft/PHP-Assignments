<?php 

    /* Starting the session. */
    session_start();

    /* Unset the session variable. */
    session_unset();

    /* Destroying the session. */
    session_destroy();
    
    /* Redirecting to login page.  */
    header("location: index.php");
    exit;
?>