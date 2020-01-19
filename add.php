<?php 
    require "components/header.php"; 
    global $statement;

    // Trigger code block once user presses submit
    if (isset($_POST['submit'])) {
        try  {
            
            $new_book = array(
                "isbn" => $_POST['isbn'],
                "title" => $_POST['title'],
                "author" => $_POST['author'],
                "year" => $_POST['year'],
                "price" => $_POST['price']
            );
            
            // Validate inputs stored in $new_book array
            $validate_new=validate();

            // Checks if a book with the isbn value inputted already exists in the database
            $sql = "SELECT * FROM Books WHERE isbn = :isbn";
            $isbn = $_POST['isbn'];
            $statement = $connection->prepare($sql);
            $statement->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $statement->execute();
    
            // If existing entry with that ISBN exists, store that entry in $exists
            $exists = $statement->fetchAll();
            
            if ($validate_new == false){
                echo $error;
            } 
            if ($exists != null){
                echo "A book with that ISBN already exists. Please try again.<br>";
            } else {
                $new_book_query = array_keys($new_book);

                // Creates a MySQL query in the correct format of INSERT INTO _tablename_ (columnOneName, ... , columnNName) VALUES (columnOneValue, ... , columnNValue)
                $sql = "INSERT INTO `Books` (". implode(", ", $new_book_query) . ") values (" . ":" . implode(", :", $new_book_query) . ")";
    
                // Send SQL query, $sql, to the database and fetch the database's response as $result
                $statement = $connection->prepare($sql);
                $statement->execute($new_book);
            }

        } catch(PDOException $error) {
            $error->getMessage();
        }
    }

    // Provide Error message
    if($error != null || $exists != null) {  
        echo $_POST['title']; ?>  was NOT added.
    <?php
    }
    // Provide success message to user once book is added to the database
    if (isset($_POST['submit']) && $statement && $validate_new == true && $exists == null) { 
    ?>
        <h6>
        <?php echo $_POST['title']; ?>  added.
        </h6>
    <?php } ?>
    
    
    <!-- Display user interface with add form -->
    <h2>Add a new book</h2>
    <form method="post">
        <div class="form-group">
        <label for="title">Book Title</label>
        <input class="form-control" type="text" name="title" id="title">
        <label for="author">Author</label>
        <input class="form-control" type="text" name="author" id="author" required>
        <label for="isbn">ISBN Number</label>
        <input class="form-control" type="text" name="isbn" id="isbn" required>
        <label for="price">Price</label>
        <input class="form-control" type="text" name="price" id="price">
        <label for="year">Year</label>
        <input class="form-control" type="text" name="year" id="year">
        <input type="submit" name="submit" value="Submit">
    </form>

<?php require "components/footer.php"; ?>
