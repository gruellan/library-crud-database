<?php
// Create credentials to scc-webtech database using PDO
$host = "db5000645787.hosting-data.io";
$username = "dbu237473";
$password = "Andrew1010!!";
$dbname  = "dbs602106"; 
$dsn = "mysql:host=$host;dbname=$dbname"; 
// Enable PDOException errors
$errors = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

$exists = false;

// Connect to database using PDO
try {
    global $connection;
    $connection = new PDO("mysql:host=$host", $username, $password, $errors);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}    

// Server-side validation function for adding new entries
function validate() {
    global $connection;

    // Checks that all fields are inputted upon form submission
    if(empty($_POST['author'])) {
        echo "No author submitted.";
        return false;
    }
    else if(empty($_POST['title'])) {
        echo "No title submitted.";
        return false;
    }
    else if(empty($_POST['price'])) {
        echo "No price submitted.";
        return false;
    }
    else if(empty($_POST['year'])) {
        echo "No year submitted.";
        return false;
    }
    else if(empty($_POST['isbn'])) {
        echo "No ISBN submitted.";
        return false;
    }

    // Checks that all fields inputted are the correct length
    if(strlen($_POST['author']) > 40 ) {
        echo "Author name too long.";
        return false;
    }
    else if(strlen($_POST['title']) > 100 ) {
        echo  "Book title too long.";
        $price = $_POST['price'];    return false;
    }
    else if(strlen($_POST['price']) > 5) {
        echo "Price is not valid. Please use xx.xx format.";
        return false;
    }
    else if(strlen($_POST['year']) != 4) {
        echo "Year is not valid. Must be a number 4 characters long.";
        return false;
    }
    else if(strlen($_POST['isbn']) != 13 ) {
        echo "ISBN not valid. Must be a number 13 characters long.";
        return false;
    }

    // Check that numeric fields have numeric inputs
    if(!(is_numeric($_POST['year']))) {
        echo "Year not numeric.
        Please enter in format YYYY";
        return false;
    }
    if(!(is_numeric($_POST['price']))) {
        echo "Price not numeric. Please enter in format xx.xx e.g. 15.99";
        return false;
    }
    if(!(is_numeric($_POST['isbn']))) {
        echo "ISBN not numeric. Please remove extra characters.";
        return false;
    }

    // If all inputs are correctly validated, function returns true
    return true;

}

// Server-side validation function for editing existing entries
function validateEdit() {
    global $connection;

    // Checks that all fields are inputted upon form submission
    if(empty($_POST['author'])) {
        echo "No author submitted.";
        return false;
    }
    else if(empty($_POST['title'])) {
        echo "No title submitted.";
        return false;
    }
    else if(empty($_POST['price'])) {
        echo "No price submitted.";
        return false;
    }
    else if(empty($_POST['year'])) {
        echo "No year submitted.";
        return false;
    }

    // Checks that all fields inputted are the correct length
    if(strlen($_POST['author']) > 40 ) {
        echo "Author name too long.";
        return false;
    }
    else if(strlen($_POST['title']) > 100 ) {
        echo  "Book title too long.";
        $price = $_POST['price'];    return false;
    }
    else if(strlen($_POST['price']) > 5) {
        echo "Price is not valid. Please use xx.xx format.";
        return false;
    }
    else if(strlen($_POST['year']) != 4) {
        echo "Year is not valid. Must be a number 4 characters long.";
        return false;
    }

    // Check that numeric fields have numeric inputs
    if(!(is_numeric($_POST['year']))) {
        echo "Year not numeric.
        Please enter in format YYYY";
        return false;
    }
    if(!(is_numeric($_POST['price']))) {
        echo "Price not numeric. Please enter in format xx.xx e.g. 15.99";
        return false;
    }

    // If all inputs are correctly validated, function returns true
    return true;

}
?>