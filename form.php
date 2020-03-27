<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>chromehub_form</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            background-image: url("pictures/download1.jpeg");
        }

        .background-wrap{
            position: fixed;
            z-index: -1000;
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0;
            left: 0;
        }
        #video-bg-elem{
            position: absolute;
            top: 0;
            left: 0;
            min-height: 100%;
            min-width: 100%;
        }
    </style>
</head>
<body>
<?php require_once 'process.php'?>
<div class="background-wrap">
    <video id="video-bg-elem" preload="auto" autoplay="true" loop="loop" muted="muted">
        <source src="video/videoplayback.mp4" type="video/mp4">

    </video>

</div>
<div class="header">
    <h1>Welcome to chromehub</h1>
</div>

<div class="float">
    <p>
        <marquee behavior="Alternate" direction="up down">Moviehub</marquee>
    </p>
</div>


<!--<div class="logo">-->
<!--    <img src="pictures/movie-billboard-neon-lighting-text-600w-588494918.jpg" alt="" width="423" height="620">-->
<!--</div>-->
<div class="forms">
<!--    <video controls autoplay>-->
<!--        <<source type="video/mp4" src="audio/videoplayback.mp4">-->
<!---->
<!--    </video>-->
    <div class="container container-fluid">
        <form action="process.php" method="POST" enctype="multipart/form-data" class="contact">
            <!-- hiding my id value  -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Movie Names</label> &nbsp;
                <input class="form-control" type="text" name="moviename" placeholder="Insert the movie/series name"> <br>
            </div>
            <div class="form-group">
                <label for="producer">Producer Name :</label> <br> &nbsp;
                <input class="form-control" type="text" name="producer"> <br>
            </div>
            <div class="form-group">
                <label for="rate">Rating :</label> <br> &nbsp;
                <input class="form-control" id="rate" placeholder="PG/G/A" type="text" name="ratings"> <br>
            </div>
            <div class="form-group">
                <label for="duration">Duration(In hours) :</label> <br> &nbsp;
                <input class="form-control" id="duration" type="text" name="duration"> <br>
            </div>
            <div class="form-group">
                <label for="size">Size(GB) :</label> <br> &nbsp;
                <input class="form-control" id="size" type="text" name="size"> <br>
            </div>
            <div class="form-group">
                <label for="genre">Genre :</label> <br> &nbsp;
                <input class="form-control" id="genre" placeholder="action,drama" type="text" name="genre"  > <br>
            </div>
            <div class="form-group">
                <label for="date">Date :</label> <br> &nbsp;
                <input class="form-control" id="date" placeholder="release date" type="date" name="date"> <br>
            </div>
            <div class="form-group">
                <label for="image">Poster Image :</label> <br> &nbsp;
                <input class="form-control" id="image" type="file" name="image"> <br>
            </div>
            <div class="form-group">
                <label for="rateme">Rate me :</label>
                <input class="form-control" id="rateme" type="text" onkeyup="check()" name="rateme" placeholder="Rate me with out ten">
                <span id="message"></span>

            </div>

            <label for="">Comments :</label> <br> &nbsp; &nbsp;
            <textarea name="Comments" id="" cols="20" rows="10" placeholder="comment here"></textarea> <br>


            <?php
        if ($update == true):
            ?>
            <button type="submit" class="btn btn-warning btn-block btn-lg" name="update">Update</button>
            <br>
            <?php else: ?>
            <button type="submit" name="save" class="btn btn-primary btn-block btn-lg">Submit</button>
            <br>
            <?php endif; ?>

        </form>


    </div>

</div>
<!--<div class="footer">-->
<!--    <h3 id="footer">-->
<!--        Copyright @2020.ChromeHub.com-->
<!--    </h3>-->
</div>

<script>
    const check = function () {
        if (document.getElementById('rateme').value < 5 ){
            document.getElementById('message').innerHTML = "This movie is boring 👹👹" ;
            document.getElementById('message').style.color = "yellow";
        }else{
            document.getElementById('message').innerHTML = "This movie is awesome";
            document.getElementById('message').style.color = "black";        }

    }

</script>

</body>
</html>