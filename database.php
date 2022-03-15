<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Patient's Info</h1>
                <hr class="divider my-4" />
            </div>

        </div>
    </div>
</header>

<html>

<head>
</head>

<body>
    <?php				 
		if(isset($_POST['submit']))
		{
		$con=mysqli_connect("localhost","root","");
		if($con)//this is always true
		{
			//echo "Mysql connection ok..!<br>";
			mysqli_select_db($con,"doctors_appointment_db");
			$name = strval($_POST['name']);
			$address = strval($_POST['address']);
			$contact_no = strval($_POST['contact_no']);
			$insert = "insert into `patient_info` (name,address,contact_no) values('$name','$address','$contact_no')";
		if(mysqli_query($con,$insert))
		{
		//echo "Your Data has been inserted successfully<br>";
		}
		else
		{
			echo "Data not inserted..!<br>".mysqli_error($con);
		}
		$query = "select * from patient_info";
		$sldt = mysqli_query($con,$query);
		echo //"<table border='1'>
		//<tr>
		//<th>Name</th>
		//<th>Address</th>
		//<th>Contact No</th>
		//</tr>"
        
        "<section class='vh-100' style='background-color: #eee;'>
            <div class='container h-100'>
            <div class='row d-flex justify-content-center align-items-center h-100'>
            <div class='col-lg-12 col-xl-11'>
            <div class='card text-black' style='border-radius: 25px;'>
            <div class='card-body p-md-5'>
            <div class='row justify-content-center'>";
        
        echo "<table class='table table-bordered'>
            <thead>
            <tr>
                <th scope='col'>Name</th>
                <th scope='col'>Address</th>
                <th scope='col'>Contact No</th>
                </tr>
            </thead>"
        ;

		while($row = mysqli_fetch_array($sldt))
		{
        echo "<tbody>";
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['address']."</td>";
		echo "<td>".$row['contact_no']."</td>";
		echo "</tr>";
        echo "</tbody>";
		}
		echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</section>";
		mysqli_close($con);
		}
		}
		?>
</body>

</html>