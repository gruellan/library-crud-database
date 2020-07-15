<?php require "components/header.php"; ?>
<!-- Perform search by title -->
<?php  
    if (isset($_POST['submit_title'])) {
    try  {
        // Send a dynamic query to the database based on book title inputted by user
        $sql = "SELECT * FROM Books WHERE title LIKE CONCAT( '%', :title, '%')";
        $title = $_POST['title'];
        $statement = $connection->prepare($sql);

        // Dynamically edit value in the query based on the user's input, and ensure its a string
        $statement->bindParam(':title', $title, PDO::PARAM_STR);

        // Send query to the database
        $statement->execute();

        // Store all results of the query in $result
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    // If there are results returned by the query, display the data in a table
    if ($result && $statement->rowCount() > 0) { 
?>
        <h2>Search Results</h2>
        <table class="table">
            <!-- Generate table headers -S-->
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Year Published</th>
                    <th>Price (£)</th>
                </tr>
            </thead>

            <!-- Loops through each book result and echoes each property of that book -->
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["isbn"]; ?></td>
                    <td><?php echo $row["year"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
    </table>

    <!-- Message displayed if no results found for a specific search -->
<?php 
    } else { 
?>
        <h3>No results found for <?php echo $_POST['title']; ?>.</h3>
<?php 
    } 
} 
?> 

<!-- Perform search by author -->
<?php  
    if (isset($_POST['submit_author'])) {
        try  {
            // Send a dynamic query to the database based on book author inputted by user
            $sql = "SELECT * FROM Books WHERE author = :author";
            $author = $_POST['author'];
            $statement = $connection->prepare($sql);

            // Dynamically edit value in the query based on the user's input, and ensure its a string
            $statement->bindParam(':author', $author, PDO::PARAM_STR);

            // Send query to the database
            $statement->execute();

            // Store all results of the query in $result
            $result = $statement->fetchAll();
            
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

        // If there are results returned by the query, display the data in a table
        if ($result && $statement->rowCount() > 0) { 
?>
        <h2>Search Results</h2>
        <table class="table">
            <!-- Generate table headers --->
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Year Published</th>
                    <th>Price (£)</th>
                </tr>
            </thead>

            <!-- Loops through each book result and echoes each property of that book -->
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["isbn"]; ?></td>
                    <td><?php echo $row["year"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
    </table>
    <!-- Message displayed if no results found for a specific search -->
<?php 
    } else { 
?>
        <h3>No results found for <?php echo $_POST['author']; ?>.</h3>
<?php 
    } 
} 
?> 

<h2>Search for a book!</h2>
<div class="row" id="search-container">
    <form method="post">
        <label for="title">By Title</label>
        <input type="text" id="title" name="title">
        <input type="submit" name="submit_title" value="View Results">
    </form>

    <form method="post">
        <label for="author">By Author</label>
        <input type="text" id="author" name="author">
        <input type="submit" name="submit_author" value="View Results">
    </form>
</div>

<?php require "components/footer.php"; ?>
