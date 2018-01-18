<?php

$db = new mysqli('localhost', 'amazonaws', 'amazon177', 'amazon');
if($db->connect_errno != null){
    echo "Error número ". $db->connect_errno;
    echo $db->connect_error;
}

   