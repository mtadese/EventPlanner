<?php

#declare class
$db = new Mysqli;

#declare function within Mysqli class 
$db->connect('localhost','root','','event_planner');

#test database connection
if($db){
    echo "";
}

?>