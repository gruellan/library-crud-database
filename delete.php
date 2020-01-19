<?php require "components/header.php";
    try  {
        // Get ISBN of the book the user wants to delete
        $isbn = $_GET['isbn'];

        // Search the database for an existing entry with that isbn
        $statement = $connection->prepare("SELECT 1 FROM Books WHERE isbn =:isbn");
        $statement->bindParam(":isbn", $isbn, PDO::PARAM_STR);
        $statement->execute();
        $exists = $statement->fetch();
        
        // Error message displayed if there isn't existing entry with the inputted isbn
        if($exists == null) {
            echo "There is no book in the database with the ISBN you inputted. Please try again.";
        }

        // Delete entry 
        else {
            // Generate SQL query
            $sql = 'DELETE FROM Books WHERE isbn=:isbn';
            $statement = $connection->prepare($sql);

            // Dynamically edit value in the query based on the user's input, and ensure its a string
            $statement->bindParam(':isbn', $isbn, PDO::PARAM_STR);

            // If the book is successfully deleted from the database, send user to homepage with updated database
            if ($statement->execute()) {
                header("Location: /ruellan/index.php");
            }
        }

    } catch(PDOException $error) {
        echo "<br><br>Uh oh! <br><br>" . $error->getMessage() . $sql;
    }
?>