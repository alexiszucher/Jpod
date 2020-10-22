<?php
    function check_user()
    {
        if(!isset($_SESSION['email']))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
?>