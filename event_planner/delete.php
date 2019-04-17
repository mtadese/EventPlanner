<?php 

#call up connection string
include 'db.php'; 

#get corresponding id value of delete button clicked
$id = (int)$_GET['id'];  

$sql = "delete from plan where id = '$id'";
$val = $db->query($sql); 

if($val){
    # go back to landing page
    header('location: index.php');
}
 

?>