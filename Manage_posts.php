<?php 
    include('database.php');

    // $sql = "";

    // try {
    //     mysqli_query($conn, $sql);
    // } catch (mysqli_sql_exception) {
    //     echo "could not execute query. <br>";
    // }
    
    // mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head> <!-- Adds web browser support meta tags for format and search algorithm-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="Oliver Scott Portfolio">
    <meta name="author" content="">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="shortcut icon" href="styles/images/OS_icon.png">
    <title>Oliver's Portfolio - Manage Page</title>
    <script type="text/javascript" src="darkmode.js" defer></script>
    <script type="text/javascript" src="script.js" defer></script>
</head>
<?php session_start(); ?>

<body>
    <div class="page-wrapper">
        <header>
            <?php include('header.inc') ?>
        </header>
        <main>
            <p class="manage_posts-p"> Welcome to the Manage Posts page. Here you can view and manage your posts.</p>
            <div class="manage_container">
                <?php // TODO: Add functionality to manage posts, such as editing or deleting them. 
                ?>
                <!-- <p> This page is currently under construction. Please check back later for updates.</p> -->
                <input type="button" id="CreateBtn" name="CreateBtn" value="Create Post">
            </div>
            <div class="manage_container" id="createPost_containerID">
                <div id="create_post_container">
                    <!-- <form id="create_post_form" action="Manage_posts.php" method="post" enctype="multipart/form-data"> CHECK if this is the correct address way -->
                    <form id="create_post_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div id="post_create_topFormatting">                    <!--Post title -->
                            <label id="lblTitle" for="post-title">Post Title:</label>
                            <input type="text" id="post-title" name="post-title">
                            <!--Author-->
                            <label id="lblAuthor" for="post-author">Author:</label>
                            <input type="text" id="post-author" name="post-author" value="Oliver Scott">
                            <!--Post Desc -->
                            <label id="lblDesc" for="post-description">Post Description:</label>
                            <textarea id="post-description" name="post-description" rows="3" cols="50" maxlength="150"></textarea>
                            <!--Post Content -->
                            <label id="lblContent" for="post-content">content:</label>
                            <textarea id="post-content" name="post-content" rows="7" cols="50" minlength="100"></textarea>
                            <!--File Upload -->
                            <label id="lblFile" for="file-upload">Choose a file to upload:</label>
                            <input type="file" id="file-upload" name="file-upload[]" multiple>
                        </div>
                        <!--tags checkbox -->
                        <p>Select Tag Categories:</p>
                        <div id="tagSection">
                            <input type="checkbox" id="Software" name="tagCategories[]" value="Software">
                            <label for="Software"> Software</label><br>

                            <input type="checkbox" id="Engineering" name="tagCategories[]" value="Engineering">
                            <label for="Engineering"> Engineering</label><br>

                            <input type="checkbox" id="Uni_Project" name="tagCategories[]" value="Uni Project">
                            <label for="Uni_Project"> Uni Project</label><br>

                            <input type="checkbox" id="Personal_Project" name="tagCategories[]" value="Personal Project">
                            <label for="Personal_Project"> Personal Project</label><br>

                            <input type="checkbox" id="Work_Project" name="tagCategories[]" value="Work Project">
                            <label for="Work_Project"> Work Project</label><br>

                            <input type="checkbox" id="Group_Project" name="tagCategories[]" value="Group Project">
                            <label for="Group_Project"> Group Project</label><br>

                            <input type="checkbox" id="Open_Source" name="tagCategories[]" value="Open Source">
                            <label for="Open_Source"> Open Source</label><br>

                            <input type="checkbox" id="Robotics" name="tagCategories[]" value="Robotics">
                            <label for="Robotics"> Robotics</label><br>

                            <input type="checkbox" id="Game_Development" name="tagCategories[]" value="Game Development">
                            <label for="Game_Development"> Game Development</label><br>

                            <input type="checkbox" id="Web_Development" name="tagCategories[]" value="Web Development">
                            <label for="Web_Development"> Web Development</label><br>

                            <input type="checkbox" id="Code" name="tagCategories[]" value="Code">
                            <label for="Code"> Code</label><br>
                        </div>
                        <!--Submit Button -->
                        <div id="buttonsGroup">
                            <input type="submit" name="Publish" id="publishBtn" value="Publish Post">
                            <input type="reset" name="Reset" value="Reset Form">
                        </div>
                    </form>
                </div> <!--TODO: Format, validate, and allow for submission of post -->
            </div>
            <!-- Title 
            Date of Creation 
            Date of Edit
            Image(s) - file upload 
            Description 
            Any external links
            Author - Const “Oliver Scott”
            Tags 
            Categories 
            Summary Text-->
        </main>
        <footer>
            <?php include('footer.inc') ?>
        </footer>
    </div>
</body>

</html>

<?php 

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $postTitle = filter_input(INPUT_POST, "post-title", FILTER_SANITIZE_SPECIAL_CHARS);
        $postAuthor = filter_input(INPUT_POST, "post-author", FILTER_SANITIZE_SPECIAL_CHARS);
        $postDescription = filter_input(INPUT_POST, "post-description", FILTER_SANITIZE_SPECIAL_CHARS);
        $postContent = filter_input(INPUT_POST, "post-content", FILTER_SANITIZE_SPECIAL_CHARS);
        $tagCategories = filter_input(INPUT_POST, "tagCategories", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        // $fileUpload = $_FILES["file-upload"]; //currently displays "array"
        //$fileUpload = filter_input(INPUT_POST, "file-upload", FILTER_SANITIZE_SPECIAL_CHARS);

        $sqlposts = "INSERT INTO posts (title, author, description, content) VALUES ('$postTitle', '$postAuthor', '$postDescription', '$postContent')";

        try { 
            mysqli_query($conn, $sqlposts);
            // echo "Post created successfully.";
            echo "<script type='text/javascript'>alert(\"Post created successfully.\");</script>";

            $sqlPostID = "SELECT id FROM posts WHERE title = '$postTitle'";
            $result = mysqli_query($conn, $sqlPostID);

            if (mysqli_num_rows ($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<script type='text/javascript'>alert(\"$row[id]\");</script>";

                if(isset($_FILES['file-upload'])) {
                    $fileCount = count($_FILES["file-upload"]["name"]);

                    for ($i = 0; $i < $fileCount; $i++) {
                        //Read tje image file content into a string
                        $image_data = file_get_contents($_FILES["file-upload"]["tmp_name"][$i]);
                        //Encode the image data into base64 string
                        $base64_image = base64_encode($image_data);

                        $sqlpost_images = "INSERT INTO post_images (post_id, image_path) VALUES ('$row[id]', '$base64_image')";

                        try {
                            mysqli_query($conn, $sqlpost_images);
                            echo "<script type='text/javascript'>alert(\"Images uploaded successfully.\");</script>";
                            
                        } catch (mysqli_sql_exception $e) {
                            echo "<script type='text/javascript'>alert(\"Having difficulties connecting to database\");</script>";
                        }
                    }
                }
            }
            else {
                echo "<script type='text/javascript'>alert(\"No post found with that id.\");</script>";
            }
        }
        catch (mysqli_sql_exception $e) {
            // echo  $e->getMessage();
            // echo "<script type='text/javascript'>alert(\"Error creating post: " . $e->getMessage() . "\");</script>";
            echo "<script type='text/javascript'>alert(\"That title is already taken.\");</script>";
        }
    }

    mysqli_close($conn);
?> 