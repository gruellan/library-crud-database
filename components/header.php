<html>
    <head>
        <title>George's Book Database</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>George's Book Database</h1>
            <div class="links">
                <div style="display: inline-block">
                    <button class="btn btn-success"><a class="link" href="index.php">Home</button></a>
                    <button class="btn btn-info"><a class="link" href="add.php">Add</button></a>
                    <button class="btn btn-warning"><a class="link" href="search.php">Search</button></a>
                    <button class="btn btn-danger"><a class="link" href="data.php">Data</button></a>
                </div>
            </div>
            <br>
        <?php 
            require_once("./config.php"); 
            $connection = new PDO($dsn, $username, $password, $errors);
            $error="";
        ?>