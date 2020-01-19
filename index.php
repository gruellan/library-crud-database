<?php require "components/header.php"; ?>
<?php
    try  {
        // Generate SQL query that selects every entry in the database
        $sql = "SELECT * FROM Books";

        // Send SQL query, $sql, to the database and fetch the database's response as $result
        $statement = $connection->query($sql);
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo "<br><br> Uh oh! <br><br>" . $error->getMessage() . $sql;
    }
?>
    <table class="table">
        <!-- Generate table headers --->
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Year Published</th>
                <th>Price (£)</th>
                <th>Added to Database</th>0
                <th>Edit<th>
            </tr>
        </thead>

        <!-- Loops through each book result and echoes each property of that book -->
        <tbody>
        <?php 
        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $current) { ?>
                <tr>
                    <td><?php echo $current["title"]; ?></td>
                    <td><?php echo $current["author"]; ?></td>
                    <td><?php echo $current["isbn"]; ?></td>
                    <td><?php echo $current["year"]; ?></td>
                    <td><?php echo $current["price"]; ?></td>
                    <td><?php echo $current["added"]; ?></td>
                    <td><a class="icon" onclick="return confirm('Are you sure you want to delete this book?')" href="delete.php?isbn=<?= $current["isbn"]?>" ><i class="fas fa-trash delete"></i></a>
                     | <a class="icon" href="edit.php?isbn=<?= $current["isbn"]?>"><i class="fas fa-edit edit"></i></a></td>
                </tr>
            <?php } 
            }?>

        </tbody>
    </table>

<?php require "components/footer.php"; ?>

