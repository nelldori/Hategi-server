<?php

/**
 * MYSQL settings.  Update any of the following values if you don't use defaults recommended in the tutorial.
 */

function global_val($key) {
    $a = array();
    $a["servername"] = "localhost"; //mysql servername
    $a["username"] = "root"; //mysql username
    $a["password"] = "1234"; //mysql password
    $a["databasename"] = "turtlebot"; //mysql database
    if(!array_key_exists($key,$a)) {
        die("global value does not exist [$key]");
    }
    return $a[$key];
}
