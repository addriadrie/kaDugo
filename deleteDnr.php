<?php
    include 'connect.php';
    
    /* USING THE FETCHED ID TO DELETE RECORD IN THE TABLE */
    if(isset($_GET['donorId'])){
        $id=$_GET['donorId'];

        $sql="DELETE FROM tblDonor WHERE donorId=$id";
        $result=sqlsrv_query($conn,$sql);

        /* DISPLAYING THE TABLE AFTER SUCCESSFUL DELETION */
        if($result){
            header('location:donor.php');
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    }
?>