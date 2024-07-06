<!-- TO REDIRECT LOGIN PAGE TO INVENTORY PAGE -->
<?php
    /* ESTABLISH CONNECTION TO DATABASE */
    include "connect.php";

    /* RETRIEVAL OF INPUT */
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* SQL QUERY */
    $sql = "SELECT * FROM tblAdmin WHERE adminName = ? AND adminPass = ?";
    $params = array($username, $password);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    /* EXECUTING QUERY */
    $stmt = sqlsrv_query($conn, $sql, $params, $options);
    $row_count = sqlsrv_num_rows($stmt);

    /* VALIDATING INPUT */
    if ($row_count === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    /* IF VALID INPUT, REDIRECT TO HOME */
    if ($row_count == 1) {
        header('location:inventory.php');
    } 
    /* IF INVALID, PRINT ERROR */
    else {
        echo "Invalid username or password.";
    }

    /* CLEAN UP RESOURCES */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
?>