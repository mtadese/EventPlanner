<!DOCTYPE html>

<!--test database connection from landing page -->
<?php include 'db.php'; 

# creating pagination
$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
# specify total number of records to display per page
$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <= 50 ? (int)$_GET['per-page'] : 20);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0; 

$sql = "select * from plan limit ".$start.", ".$perPage." ";

# get the total number of records in the database
$total = $db->query("select * from plan")->num_rows; 

#get the total number of pages for all records
#using ceil funtion to round numbers to nearest integer
$pages = ceil($total / $perPage);
# ends creating pagination 

$rows = $db->query($sql); 

?>

<!--frontend design -->
<html>
<head>

<!--jquery plugin script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<!--bootstrap plugin script-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <title>Event Planner App</title>

<style>
div {
  background-color: #4E1004;
  color: white;
}
</style>

</head>

<body>
<div class="container" > 
<div class="row" style="margin-top: 70px;">
<center><h1> Event Planner App </h1></center>

<div class="col-md-10 col-md-offset-1">

<table class="table">

<a href="add.php" class="btn btn-primary">Add Routine</a>

<button type="button" class="btn btn-info pull-right" onclick="print()">Print
</button>
<hr> <br/> 

<!-- insert Search Functionality -->
<div class="col-md-12 text-center">
  <h3>Search</h3>
  <form action="search.php" method="post" class="form-group">
  
  <input align="right" type="text" placeholder="Search" 
  name="search" class="form-control">
  </form>

<br/>
</div>




<!-- Delete Modal HTML -->
<!--
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>

				</div>				
				<h4 class="modal-title">Delete Item</h4>	
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer"> 

      <input type="button" class="btn btn-info" data-dismiss="modal" value="Cancel">
      <<button type="button" href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-default" value="Delete"></button>

      
			</div>
		</div>
	</div>
</div>

-->

<!-- end delete Modal -->



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
    <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger" data-toggle="modal">Delete</a>
    </td> 
    -->

    </tr>
    <?php endwhile; ?>
       
  </tbody>
</table> 

<!-- display page numbers and navigations -->
<center>
  <ul class="pagination">
  <?php for($i = 1; $i <= $pages; $i++): ?>
  <li><a href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage;?>"><?php echo $i;?></a></li>

  <?php endfor; ?>
  </ul>
</center>
<!-- end display page numbers and navigations -->

<hr>
</div>
</div>
</div>

</body>


</html>