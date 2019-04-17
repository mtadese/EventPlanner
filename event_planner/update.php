<!DOCTYPE html>

<!--test database connection from landing page -->
<?php include 'db.php'; 

#apply data validation using (int)
$id= (int)$_GET['id'];

$sql = "select * from plan where id='$id'";
$rows = $db->query($sql); 

$row= $rows->fetch_assoc();
#var_dump($row); 

            
if(isset($_POST['send'])){

#prevent sql injection by using data validation (htmlsecialchars)
$item = htmlspecialchars($_POST['item']); 
$due_date = htmlspecialchars($_POST['due_date']); 

$cost = htmlspecialchars($_POST['cost']);
$resource = htmlspecialchars($_POST['resource']);
$status = htmlspecialchars($_POST['status']);

$sql2 = "update plan set item='$item',due_date='$due_date',cost='$cost',resource='$resource',status='$status' where id = '$id'"; 
$db->query($sql2);

header('location: index.php');  
}



?>

<!--frontend design -->
<html>
<head>

<!--jquery plugin script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<!--bootstrap plugin script-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Update - Event Planner App</title>

    <style>
div {
  background-color: #4E1004;
  color: white;
}
</style>

</head>

<body>
<div class="container"> 
<div class="row" style="margin-top: 70px;">
<center><h1> Update Event Routine </h1></center>

<div class="col-md-10 col-md-offset-1">


<hr> <br/> 


      <!-- post new data from webpage form to database -->
        <form method="post">
        <div class="form-group">
            
            <label>Routine:</label>
            <input type="text" required name="item" value="<?php echo $row['item'];?>" class="form-control">
            <br/>
            
            <label>Due Date:</label>
            <input type="text" name="due_date" value="<?php echo $row['due_date'];?>" class="form-control">

            <br/>
            <label>Amount Required:</label>
            <input type="text" name="cost" value="<?php echo $row['cost'];?>" class="form-control">
            
            <br/>
            <label>Resource Responsible:</label>
            <!--
            <input type="text" required name="resource" value="<?php echo $row['resource'];?>" class="form-control">
            -->
            <select required name="resource" class="form-control">
            <option value="<?php echo $row['resource'];?>"><?php echo $row['resource'];?></option>;
            <option value="BRIDE">BRIDE</option>
            <option value="GROOM">GROOM</option>
            <option value="EVENT-PLANNER">EVENT PLANNER</option>
            <option value="VENDOR">VENDOR</option>
            <option value="OTHER">OTHER</option>              
            </select>

            <br/>
            <label>Completion Status:</label>
            <!-- 
                <input type="text" name="status" value="<?php echo $row['status'];?>" class="form-control">
            -->

            <select name="status" class="form-control">
            <option value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>;
            <option value="PENDING">PENDING</option>
            <option value="COMPLETED">COMPLETED</option>
              
            </select>

            <br/>

        
        <input type="submit" name="send" value="Save" class="btn btn-primary">
        &nbsp;
        <a href="index.php" class="btn btn-warning">Cancel</a>
        <hr>
        </div>
        </form>

   

</div>
</div>
</div>

</body>


</html>