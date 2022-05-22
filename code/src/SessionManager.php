<?php

namespace Returnnull;
session_start();

class SessionManager
{
    public function setAuthenticatedUser($username)
    {
        $_SESSION['username'] = $username;
        header("refresh:0;url=/admin");
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['username']);
    }

    public function getAuthenticatedUser()
    {
        return $_SESSION['username'];
    }

    public function logout()
    {
        session_destroy();
        header("Refresh:0");
    }

    public function commentLock()
    {
        if(!isset($_SESSION['s'])){
            $_SESSION['s'] = true;
        }
        return $_SESSION['s'];
    }

    public function setCommentLock()
    { //TODO: let that session expire
        if(!isset($_SESSION['s'])){
            $_SESSION['s'] = true;
        }

        if(!empty( $_POST ) && ($_SESSION['s']) )
        {
            $_SESSION['s'] = false;
        }
    }
}