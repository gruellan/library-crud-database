<?php require "components/header.php"; 
    // Get ISBN of the book the user wants to delete
    $isbn = $_GET['isbn'];

    // Generate SQL query
    $sql = 'SELECT * FROM Books WHERE isbn=:isbn';
    $statement = $connection->prepare($sql);

    // Dynamically edit value in the query based on the user's input, and ensure its a string
    $statement->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $statement->execute();

    // Store result from database in variable, current
    $current = $statement->fetch();

    // Trigger code block once user presses submit
    if (isset($_POST['submit'])) {
        try  {
            $edited_book = array(
                "title" => $_POST['title'],
                "author" => $_POST['author'],
                "year" => $_POST['year'],
                "price" => $_POST['price'],
                "isbn" => $isbn
            );
            
            // Checks that edited book data is validated before sending update query to the database
            $validate_new=validateEdit();

            // If inputs aren't valid, show error messages from validate()
            if ($validate_new == false ){
                echo $error;
            } 

            // If inputs are valid, update database
            else {
                $title = $_POST['title'];
                $author = $_POST['author'];
                $year = $_POST['year'];
                $price = $_POST['price'];

                // Creates a MySQL query to update existing entry
                $sql = "UPDATE `Books` SET title=:title, author=:author, year=:year, price=:price WHERE isbn=:isbn";

                // Bind updated values to the query
                $statement = $connection->prepare($sql);
                $statement->bindParam(':isbn', $isbn, PDO::PARAM_INT);
                $statement->bindParam(':title', $title, PDO::PARAM_STR);    
                $statement->bindParam(':author', $author, PDO::PARAM_STR);    
                $statement->bindParam(':year', $year, PDO::PARAM_INT);
                $statement->bindParam(':price', $price, PDO::PARAM_INT);

                $statement->execute();

                // If the book is successfully deleted from the database, send user to homepage with updated database
                if ($statement->execute()) {
                    header("Location: /ruellan/index.php");
                }
            }

        } catch(PDOException $error) {
            echo "<br> Uh oh! <br>" . $error->getMessage() . "<hr>";
        }
    }
 ?>
<h2>Update existing book entry</h2>
<form method="post">
    <div class="form-group">
    <label for="title">Book Title</label>
    <input value="<?= $current['title']; ?>" class="form-control" type="text" name="title" id="title" required>
    <label for="author">Author</label>
    <input value="<?= $current['author']; ?>" class="form-control" type="text" name="author" id="author">
    <label for="isbn">ISBN Number</label>
    <input value="<?= $current['isbn']; ?>" class="form-control" type="text" name="isbn" id="isbn" disabled>
    <label for="price">Price</label>
    <input value="<?= $current['price']; ?>" class="form-control" type="text" name="price" id="price">
    <label for="year">Year</label>
    <input value="<?= $current['year']; ?>" class="form-control" type="text" name="year" id="year">
    <input type="submit" name="submit" value="Submit">
</form>