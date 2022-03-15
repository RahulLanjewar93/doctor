<?php 
include 'admin/db_connect.php'; 
?>

<!doctype html>
<html lang="en">

<head>
    <style>
    #ques {
        min-height: 433px;
    }

    .card-img-top {
        width: 100%;
        height: 30vh;
        object-fit: cover;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .card {
        height: 10rem;
        width: 18rem;
    }

    .container {
        position: relative;
        width: 1100px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding: 30px;
    }

    .container .card {
        position: relative;
        max-width: 300px;
        height: 215px;
        background-color: #fff;
        margin: 30px 10px;
        padding: 20px 15px;

        display: flex;
        flex-direction: column;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
        transition: 0.3s ease-in-out;
        border-radius: 15px;
    }

    .container .card:hover {
        height: 320px;
    }


    .container .card .image {
        position: relative;
        width: 260px;
        height: 260px;

        top: -40%;
        left: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .container .card .image img {
        max-width: 100%;
        border-radius: 15px;
    }

    .container .card .content {
        position: relative;
        top: -140px;
        padding: 10px 15px;
        color: #111;
        text-align: center;

        visibility: hidden;
        opacity: 0;
        transition: 0.3s ease-in-out;

    }

    .container .card:hover .content {
        margin-top: 30px;
        visibility: visible;
        opacity: 1;
        transition-delay: 0.2s;

    }
    </style>
</head>

<body>
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




    <!--<div class="container my-4" id="ques"
        <h2 class="text-center my-4">Media Specialities</h2>
        <div class="row m-y4">
            <!-- Fetch all the categories and use a loop to iterate through categories -->

    <h2 class="text-center my-4">Media Specialities</h2>
    <!-- <div class="col-md-4 my-2">  -->
    <div class="container my-4" id="ques">
        <div class="row my-4">
            <?php 
         $cats = $conn->query("SELECT * FROM medical_specialty order by id asc");
                     while($row=$cats->fetch_assoc()):?>
            <div class="col-md-4 my-2">
                <div class="card h-20">
                    <div class="image">
                        <img src="assets/img/<?php echo $row['img_path'] ?>" alt="image for this category">
                    </div>
                    <div class="content">
                        <p class="card-text"><?php echo $row['name'] ?></p>
                        <a href="index.php?page=doctors&sid=<?php echo $row['id'] ?>" class="btn btn-primary">Find
                            Doctor</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

    </div>

    </div>
    <script>
    $('.view_prod').click(function() {
        uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
    })
    </script>
</body>

</html>