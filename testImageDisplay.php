<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Test Image Display">
    <meta name="author" content="Oliver Scott">
    <title>Basic HTML Template</title>
</head>
<body>

        <img id="Post image">

    <?php
        include('database.php');

        try {
            $sql = "SELECT image_path FROM post_images WHERE id = 9";
            $result = mysqli_query($conn, $sql); //execute query

            //det actual daata from result
            $row = mysqli_fetch_assoc($result);

            echo $row['image_path']; //displays base64 string

            // convert string back to image
            $imageData = base64_decode($row['image_path']);
            // display image
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" id="Image">';

        } catch (mysqli_sql_exception) {
            echo "could not execute query. <br>";
        }

        mysqli_close($conn);
    ?>


</body>
</html>