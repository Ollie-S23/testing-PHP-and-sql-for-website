<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Basic HTML Template">
    <meta name="author" content="Your Name">
    <title>Basic HTML Template</title>
    <!--  <link rel="stylesheet" href="styles.css"> <!-- used for relationship between html and resopurces eg. css file -->
</head>
<body>
    

    <?php
        include('database.php');

        try {
            $sql = "SELECT * FROM posts";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "User ID: " . $row['id'] .
                    " - Title: " . $row['title'] .
                    " - Description: " . $row['description'] . 
                    " - Author: " . $row['author'] .
                    " - Content: " . $row['content'] .
                    " - Created At: " . $row['created_at'] .
                    $sqlCheckUpdate = "SELECT updated_at FROM posts WHERE id = " . $row['id'];
                    $updateResult = mysqli_query($conn, $sqlCheckUpdate);
                    $date = mysqli_fetch_assoc($updateResult);
                    if ($date['updated_at'] != null) {
                        echo " - Updated At: " . $date['updated_at'];
                    } else {
                        echo " - Not Updated";
                    }
                    echo "<br>";
                    $sqlCheckImages = "SELECT image_path FROM post_images WHERE post_id = " . $row['id'];
                    $imageResult = mysqli_query($conn, $sqlCheckImages);
                    while ($images = mysqli_fetch_assoc($imageResult)) {
                        //display image
                        echo '<img src="data:image/jpeg;base64,' . $images['image_path'] . '">';
                    }
                    echo "<br>";
                    $sqlCheckTags = "SELECT Category FROM post_categories WHERE post_id = " . $row['id'];
                    $tagResult = mysqli_query($conn, $sqlCheckTags);
                    echo "Tags: ";
                    while ($tags = mysqli_fetch_assoc($tagResult)) {
                        echo $tags['Category'] . " ";
                    }
                    echo "<br><br>";
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

</body>
</html>