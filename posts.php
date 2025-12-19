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
    <title>Oliver's Portfolio - Posts</title>
    <script type="text/javascript" src="darkmode.js" defer></script>
</head>
<?php session_start(); ?>
<body>
    <div class="page-wrapper">
        <header>
        <?php include('header.inc')?>
        </header>
        <main>
            <?php
                require_once("settings.php");

                $conn = mysqli_connect($host, $user, $pwd, $sql_db); // Establish a connection to the database

                if (!$conn) {
                    include('underconstruction_animation.inc');
                    echo "<h3 class=\"posts_unavailable\"> Error: Failed to connect to database server. Please try again later and contact support. </h3>";
                    die(); // Now it safely stops after output
                }

                // If the connection was successful, proceed to check the database for entries
                $table_name = "posts"; // Specify the table name to check for entries
                $query = "SELECT COUNT(*) AS total FROM $table_name WHERE status='published'"; // Create a query to count the total number of entries in the specified table

                $result = mysqli_query($conn, $query); // Execute the query
                if ($result) {
                    $row = mysqli_fetch_assoc($result); // Fetch the result as an associative array
                    if ($row['total'] > 0) { // Check if there are any entries in the table
                        echo "<div class='posts-container'>"; // Start a container for the posts
                        echo "<h3>Posts</h3>";
                        echo "<p class=\"total-posts\">Total Posts: {$row['total']}</p>";
                        //check the status of databse entries and check that they are 'published'
                            echo "<div class='posts-list'>"; // Start a list for the posts

                            // Fetch all published posts
                            $posts_query = "SELECT id, title, author, content, created_at, updated_at, timezone FROM $table_name WHERE status='published' ORDER BY created_at DESC";
                            $posts_result = mysqli_query($conn, $posts_query);
                            if ($posts_result && mysqli_num_rows($posts_result) > 0) {
                                while ($post = mysqli_fetch_assoc($posts_result)) {
                                    echo "<section class=\"post\">";
                                    echo "<p class='post-id'>Post ID: " . htmlspecialchars($post['id']) . "</p>";
                                    echo "<h4> ' <strong>" . htmlspecialchars($post['title']) . "</strong> ' Published by: <em>" . htmlspecialchars($post['author']) . "</em></h4>";
                                    echo "<div class='content'>" . nl2br(htmlspecialchars($post['content'])) . "</div>";
                                    echo "<p class='meta'><small>Created: " . htmlspecialchars($post['created_at']) . " | Updated: " . htmlspecialchars($post['updated_at']) . " (" .htmlspecialchars($post['timezone']) . ")</small></p>";
                                    echo "</section>"; // Close the post section
                                }
                            } else {
                                echo "<p>No published posts found.</p>";
                            }
                            echo "</div>"; // Close posts-list
                            echo "</div>"; // Close posts-container
                    } else { // If there are no entries, display a message indicating that the database is empty
                        include('underconstruction_animation.inc');
                        echo "<h3 class=\"construction-warning\"> There are no posts available at the moment.</h3>";
                    }
                    mysqli_free_result($result); // Free the result set to free up resources
                } else { // If the query failed, display an error message and include the underconstruction animation
                    include('underconstruction_animation.inc');
                   echo  "<p> Error: Failed to connect to database server. Please try again later and contact support </p>";
                }

                mysqli_close($conn);
            ?>

        </main>
        <footer>
            <?php include('footer.inc')?>
        </footer>
    </div>
</body>
</html>