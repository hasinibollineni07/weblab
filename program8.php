<!DOCTYPE html> 
<html lang="en"> 
<head> <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 <title>Student Management System</title> 
</head> 
<body> 
	<h2>Student Management System</h2> 
	<form method="POST"> 
		<h3>Insert a Student</h3> 
		<label>USN:</label>
		<input type="text" name="usn" required><br> 
		<label>Name:</label>
		<input type="text" name="name" required><br> 
		<label>Branch:</label> 
		<input type="text" name="branch" required><br> 
		<label>Semester:</label>
		<input type="number" name="Semester" required><br> 
		<label>College:</label> 
		<input type="text" name="college" required><br> 
		<button type="submit" name="action" value="insert">Insert</button> 
	</form> 
	<form method="POST"> 
		<h3>Display All Students</h3> 
		<button type="submit" name="action" value="display">Display</button> 
	</form> 
	<form method="POST"> <h3>Delete a Student</h3> 
		<label>USN:</label> 
		<input type="text" name="usn_delete" ><br>
		<button type="submit" name="action" value="delete">Delete</button> 
	</form> 
	<?php 
		 
		$conn = new mysqli('localhost', 'root', '', '5bDatabase');
		if ($conn->connect_error)
		 { 
			die("Connection failed: " . $conn->connect_error); 
		} 

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			 $action = $_POST['action']; 

			 if ($action == 'insert')
			 { 
			 	$usn = $conn->real_escape_string($_POST['usn']); 
			 	$name = $conn->real_escape_string($_POST['name']); 
				$branch = $conn->real_escape_string($_POST['branch']);
				$Semester = (int)$_POST['Semester']; 
			 	$college = $conn->real_escape_string($_POST['college']); 

			 	$query = "INSERT INTO studentTable (usn, name, branch, semester, college) VALUES ('$usn', '$name', '$branch', $Semester, '$college')"; 

			 	if ($conn->query($query))
			 	{
			 		echo "Student with USN '$usn' inserted successfully.";
			 	}
			 	else
			 	{ 
			 		echo "Error: " . $conn->error;
			 	}
		  } 
		 	
		 elseif ($action == 'delete')
		 { 
		 		if (!empty($_POST['usn_delete'])) 
		 		{ 
		 			$usn = $conn->real_escape_string($_POST['usn_delete']); 
		 			$query = "DELETE FROM studentTable WHERE usn = '$usn'";
		 			if ($conn->query($query))
		 			{ 
		 				echo $conn->affected_rows > 0 ? "Student with USN '$usn' deleted." : "No student found with USN '$usn'.";
		 			} 
		 			else
		 			{ 
		 				echo "Error: " . $conn->error;
		 			 } 
		 		}
		 		else
		 		{
		 			echo "Please provide a valid USN to delete."; 
		 		}
		  } 
		 		
		 elseif ($action == 'display')
		 { 
		 		$result = $conn->query("SELECT * FROM studentTable"); 
		 		if ($result->num_rows > 0)
		 		{
		 			echo "<h3>Student Records</h3>"; .
		 			echo "<table border='10'><tr><th>USN</th><th>Name</th><th>Branch</th><th>Semester</th><th>College</th></tr>"; 

		 			 while ($row = $result->fetch_assoc())
		 			 { 
		 			 	echo "<tr>
		 			 			 <td>{$row['usn']}</td> 
		 			 			 <td>{$row['name']}</td> 
		 			 			 <td>{$row['Branch']}</td> 
		 			 			 <td>{$row['semester']}</td>
		 			 			 <td>{$row['college']}</td>
		 			 		 </tr>"; } 
		 			 	echo "</table>";
		 			 } 
		 		else 
		 		{ 
		 			echo "No student records found.";
		 		 } 
		 	} 
		} 
$conn->close();
?> 
</body> 
</html>
