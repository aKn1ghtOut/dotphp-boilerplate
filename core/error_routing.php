<?php

/*
 * The web error management file.
 * TODO: Manage HTTP errors better.
 * Also, implement all the remaining error codes according to the W3 guidelines.
 */
namespace clay_errors;

function error_404()
{
    header("Location: " . __host . "errors/404");
    die();
}

function error_login()
{
    header("Location: " . __host . "errors/login_required");
    die();
}

function error_unauth()
{
    die("Hey");
    header("Location: " . __host . "errors/unauthorised");
    die();
}
