<?php
//start a session
session_start();
//connecting to database
$mysqli =  new mysqli('localhost', 'root', '','crudTest') or die (mysqli_error($mysqli));
//setting name and location to empty strings so as to check whether edit button has been clicked
//and if the id is accessed when editing and updating a record
$id = 0;
$update = false;
$name = "";
$producer = "";
$rating = "";
$duration = "";
$size = "";
$genre = "";
$release_date = "";
$rate_me = "";
$poster_image = "";
$updatesql ="";
//check if submit button is pressed
//access using global variable $_POST
//the isset function checks if a condition has been met
//save is the name of the button
if (isset($_POST['save'])){
    //this is the path that will store our image
    $target = "pictures/".basename($_FILES['image']['name']);
    //store name and location in variables
    //names in the [] are the name of the form input fields in update.php
    $name = $_POST['moviename'];
    $producer = $_POST['producer'];
    $rating = $_POST['ratings'];
    $duration = $_POST['duration'];
    $review= $_POST['cr'];
    $size = $_POST['size'];
    $genre = $_POST['genre'];
    $release_date = $_POST['date'];
    $rate_me =$_POST['rate_me'];

    $rate_me = 5;
    if ($rate_me < 5) {
        echo "poor";
        header('location: form.php');
    } else {
        echo "good";
        header('location: form.php');

    }

    //image code
    $poster_image = $_FILES['image']['name'];
    //sql query to insert
    // the first () is where you declare the column names in the database
    // the second() is wheere you ma the value of the  input from the user
    $insert = "INSERT INTO data (name, producer, rating, duration, size, genre,release_date,rate_me, poster_image)VALUES ('$name','$producer','$rating','$duration','$size','$genre','$release_date','$rate_me','$poster_image')";

    //placing image to the folder pictures so we can have a path to retrieve it from
    if (mysqli_query($mysqli,$insert)) {
        # code...
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        //check if image has been moved
        echo "<script>alert('image has been moved')</script>";
    } else {
        echo "<script>alert('image has not been moved')</script>";
    }
    //setting messages for the save button and a bootstrap message type
    $_SESSION['message'] = "Movie added successfully";
    $_SESSION['msg_type'] = "success";
    //redirect user to index.php for message
    header("location: update.php");
}
//UPDATE FUNCTION
//check if edit button is clicked
if (isset($_GET['edit'])) {
    # code...
    $id = $_GET['edit'];
    //variable update
    $update = true;
    //pulling requested record
    $result = $mysqli->query("SELECT * FROM data WHERE id='$id'") or die($mysqli->error);
    //check if the record to be edited exists in my database

    $row = $result->fetch_array();
    //the name in the [] are names of the columns in your database/
    $name = $row['name'];
    $genre = $row['genre'];
    $producer =$row['producer'];
    $duration =$row['duration'];
    $size =$row['size'];
    $rating =$row['rating'];
    $release_date =$row['release_date'];
    $rate_me =$row['rate_me'];


}

//updataing and editing records
//check if the update button has been clicked
if (isset($_POST['update'])) {
    //path to update
    $newtarget ="pictures/" .basename($_FILES['image']['name']);
    # code...
    //the name in the [] are names of your form input fields in update.php
    //the names in the square barckets
    $id = $_POST['id'];
    $name = $_POST['moviename'];
    $genre = $_POST['genre'];
    $producer =$_POST['producer'];
    $size =$_POST['size'];
    $rating =$_POST['ratings'];
    $duration =$_POST['duration'];
    $release_date =$_POST['date'];
    $rate_me =$_POST['rate_me'];
    $poster_image =$_FILES['image']['name'];
    //new query for updates

    $updatesql ="UPDATE data SET name='$name', genre='$genre',producer='$producer',duration='$duration',size='$size'release_date='$release_date',rate_me= '$rate_me',poster_image='$poster_image' WHERE id='$id' ";
    // deleting existing image using unlink function
    unlink("pictures/$poster_image");
    if (mysqli_query($mysqli,$updatesql)){
        move_uploaded_file($_FILES['image']['tmp_name'],$newtarget);
        // check if image has been moved
        //setting session messages for updates
        $_SESSION['message'] = "Record has been updated";
        $_SESSION['msg_type'] ="warning";
        //redirect
        header("location:update.php");
    }
    else{
        echo "<script>alert('image has not been moved')</script>";
        header('location: update.php');
    }
    //query to update
    //setting session messages for updates
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    //redirect
    header("location: update.php");
}

