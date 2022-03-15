<?php include 'admin/db_connect.php'; 

	$special = $conn->query("SELECT * FROM medical_specialty");
	$ms_arr = array();
	while ($row=$special->fetch_assoc()) {
		$ms_arr[$row['id']] = $row['name'];
	}
?>
<!-- Slider starts here -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="https://source.unsplash.com/1600x700/?doctor,hospital" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/1600x700/?clinic,patient" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/1600x700/?medicines,hospital" class="d-block w-100">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container my-4">
    <div class="jumbotron">
        <?php if(isset($_GET['sid']) && $_GET['sid'] > 0): ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <?php $s = $conn->query("SELECT * from medical_specialty where id = ".$_GET['sid'])->fetch_array()['name'];
				?>
                <h2><b>Doctor's who are in titled as <?php echo $s ?></b></h2>
            </div>
        </div>
        <!-- <hr class="divider"> -->
        <hr class="my-4">
        <?php endif; ?>

        <?php 
				$where = "";
				if(isset($_GET['sid']) && $_GET['sid'] > 0)
				$where = " where  (REPLACE(REPLACE(REPLACE(specialty_ids,',','\",\"'),'[','[\"'),']','\"]')) LIKE '%\"".$_GET['sid']."\"%' ";
				$cats = $conn->query("SELECT * FROM doctors_list ".$where." order by id asc");
				while($row=$cats->fetch_assoc()):
				?>

        <div class="row align-items-center">
            <div class="col-md-3">
                <img src="assets/img/<?php echo $row['img_path'] ?>" alt="">
            </div>
            <div class="col-md-6">
                <p>Name: <b><?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></b></p>
                <p><small>Email: <b><?php echo $row['email'] ?></b></small></p>
                <p><small>Clinic Address: <b><?php echo $row['clinic_address'] ?></b></small></p>
                <p><small>Contact #: <b><?php echo $row['contact'] ?></b></small></p>
                <p><small><a href="javascript:void(0)" class="view_schedule" data-id="<?php echo $row['id'] ?>"
                            data-name="<?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?>"><i
                                class='fa fa-calendar'></i> Schedule</a></b></small></p>
                <p><b>Specialties:</b></p>

                <div>
                    <?php if(!empty($row['specialty_ids'])): ?>
                    <?php 
						 	foreach(explode(",", str_replace(array("[","]"),"",$row['specialty_ids'])) as $k => $val): 
						 	?>
                    <span class="badge badge-light" style="padding: 10px">
                        <large><b><?php echo $ms_arr[$val] ?></b></large>
                    </span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3 text-center align-self-end-sm">
                <button class="btn-outline-primary btn mb-4 set_appointment" type="button"
                    data-id="<?php echo $row['id'] ?>"
                    data-name="<?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?>">Set
                    Appointment</button>
            </div>
        </div>
        <hr class="divider" style="max-width: 60vw">
        <?php endwhile; ?>
    </div>
</div>

<style>
#doctors img {
    max-height: 300px;
    max-width: 200px;
}
</style>
<script>
$('.view_schedule').click(function() {
    uni_modal($(this).attr('data-name') + " - Schedule", "view_doctor_schedule.php?id=" + $(this).attr(
        'data-id'))
})
$('.set_appointment').click(function() {
    if ('<?php echo isset($_SESSION['login_id']) ?>' == 1)
        uni_modal("Set Appointment with " + $(this).attr('data-name'), "set_appointment.php?id=" + $(this).attr(
            'data-id'), 'mid-large')
    else {
        uni_modal("Login First", "login.php")
    }
})
</script>