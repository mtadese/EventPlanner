<!DOCTYPE html>

<!--test database connection from landing page -->
<?php include 'db.php'; 

# set search parameter 
if(isset($_POST['search'])){

#prevent sql injection 
$item = htmlspecialchars($_POST['search']);
$sql = "select * from plan where item like '%$item%' ";

$rows = $db->query($sql); 
   
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

    <title>Search - Event Planner App</title>

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
<center><h1> Find Routines </h1></center>

<div class="col-md-10 col-md-offset-1"> 

<!-- set condition for search field  if nothing is found-->
<?php if(mysqli_num_rows($rows) < 1): ?>
    <h2 class="text-danger text-center">Nothing Found</h2>
    <a href="index.php" class="btn btn-warning">Back</a>
<?php else: ?>

<!-- end set condition for search field -->


<table class="table">

<a href="index.php" class="btn btn-warning">Cancel</a>
<button type="button" class="btn btn-info pull-right" onclick="print()">Print
</button>
<hr> <br/> 

<!-- insert Search Functionality -->
<div class="col-md-12 text-center">
  <p>Search</p>
  <form action="search.php" method="post" class="form-group">
  
  <input type="text" placeholder="Search" 
  name="search" class="form-control">
  </form>

<br/>
</div>



  <thead>
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Routine</th>

      <th scope="col">Due-Date</th>
      <th scope="col">Cost</th>
      <th scope="col">Resource</th>
      <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>

    <!-- fetch row data from database into webpage -->    
     <?php while($row = $rows->fetch_assoc()): ?>
     
      <th><?php echo $row['id'] ?></th>
      
      <td class="col-md-6"><?php echo $row['item'] ?></td>
      <td class="col-md-2"><?php echo $row['due_date'] ?></td> 
      <td class="col-md-2"><?php echo $row['cost'] ?></td>
      <td class="col-md-2"><?php echo $row['resource'] ?></td>
      <td class="col-md-2"><?php echo $row['status'] ?></td>


      <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-primary">Update</a></td>
    <!-- delete from webpage to database -->
    <!--
        <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
    -->
    </tr>
    <?php endwhile; ?>
       
  </tbody>
  </table> 
    <!-- search parameter contd.--> 
<?php endif; ?>


    <!-- ends search parameter contd.-->




<!-- display page numbers and navigations -->

<!-- end display page numbers and navigations -->

<hr>
</div>
</div>
</div>
 
</body>


</html>