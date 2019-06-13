<?php
include "../includes/connection.php";
extract($_POST);
/*echo "<pre>";
print_r(extract($_POST));
echo "</hr>";*/

if(isset($Submit))
{
//print_r($_POST);
	if(
	!empty($fname)&&
	!empty($lname) &&
	!empty($email)&&
	!empty($english)&&
	!empty($maths)&&
	!empty($science)){
		
		$sql = "INSERT INTO data 
			VALUES ('', 
			'".mysqli_real_escape_string($conn, $fname)."',
			'".mysqli_real_escape_string($conn, $lname)."',
			'".mysqli_real_escape_string($conn, $email)."',
			
			'".mysqli_real_escape_string($conn, $english)."',
			'".mysqli_real_escape_string($conn, $maths)."',
			'".mysqli_real_escape_string($conn, $science)."')";
	//echo $sql;die;
			if ($conn->query($sql) === TRUE) {
				echo "<script type='text/javascript'>alert('new record inserted');</script>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

					
	}
}
	


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Happy Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="jquery331.js"></script>
  <script src="dataTable.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  
  
</head>
<body>

<div class="jumbotron text-center">
  <h1>Happy Registration</h1>
  <p>Noitce : if you Register you get access else register</p> 
</div>
  
<div class="container">
   <h2>Data Table</h2>
   <button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-target="#myModal"> <span class="glyphicon glyphicon-list-alt"></span> Add Record</button>
  <table class="table" id = "sData">
    <thead>
      <tr>
        <th>Id <button id = 'sData'>Sort</button></th>
        <th>Firstname <button id = 'sData'>Sort</button></th>
        <th>Lastname <button id = 'sData'>Sort</button></th>
        <th>Email <button id = 'sData'>Sort</button></th>
        <th>English <button id = 'sData'>Sort</button></th>
        <th>Maths <button id = 'sData'>Sort</button></th>
        <th>Science <button id = 'sData'>Sort</button></th>
      </tr>
    </thead>
    <tbody>
	
	<?php
		
		$sql = "SELECT id,fname, lname,email,english,maths,science FROM data";
		$result = $conn->query($sql);

		if (!empty($result) && $result->num_rows  > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				
				echo "<tr>";
				echo "<td>".$row["id"]."</td>";
				echo "<td>".$row["fname"]."</td>";
				echo "<td>".$row["lname"]."</td>";
				echo "<td>".$row["email"]."</td>";
				echo "<td>".$row["english"]."</td>";
				echo "<td>".$row["maths"]."</td>";
				echo "<td>".$row["science"]."</td>";
				echo "</tr>";
				
				//echo $row["id"]. " - Name: " . $row["fname"]. " " . $row["lname"]. "<br>";
			}
		} else {
			echo "0 results";
		}
		$conn->close();
				
	?>
      
      
    </tbody>
  </table>
</div>

 <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Record</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="index.php" method = "POST" id="add_form">
			  <div class="form-group">
				<label for="first Name">First Name</label>
				<input type="text" class="form-control" name = "fname" placeholder="Alex" required>
			  </div>
			  <div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lname" name ="lname" placeholder="Lunatic" required>
			  </div>
			  
			  <div class="form-group">
				<label for="exampleFormControlInput1">Email address</label>
				<input type="email" class="form-control" id="email" name = "email" required">
			  </div>
			  <div class="form-group">
				<label for="lastName">English</label>
				<input type="number" class="form-control" id="english" name ="english" min="1" max="100" required">
			  </div>
			  <div class="form-group">
				<label for="lastName">Maths</label>
				<input type="number" class="form-control" id="maths" name ="maths" min="1" max="100" required">
			  </div>
			  <div class="form-group">
				<label for="lastName">Science</label>
				<input type="number" class="form-control" id="science" name ="science" min="1" max="100" required">
			  </div>
			 
				
			  
			  
			  <button type="submit" onclick="form_submit()" name = "Submit" class="btn btn-primary">Submit</button>
			  <button type="reset" class="btn btn-danger">Reset</button>
			</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</body>
<script type="text/javascript">
  function form_submit() {
    document.getElementById("add_form").submit();
		
   }
  
</script>

<script>
$('#myModal').modal({
    backdrop: 'static',
    keyboard: false
}) 
</script>
<script>
$(document).ready(function() {
    $('#sData').DataTable( {
        order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    } );
} );
</script>
</html>
