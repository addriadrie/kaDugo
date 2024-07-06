<?php
    include 'connect.php';
    
    /* USING THE FETCHED ID TO DELETE RECORD IN THE TABLE */
    if(isset($_GET['patientId'])){
        $id=$_GET['patientId'];

        $sql="DELETE FROM tblPatient WHERE patientId=$id";
        $result=sqlsrv_query($conn,$sql);

        /* DISPLAYING THE TABLE AFTER SUCCESSFUL DELETION */
        if($result){
            header('location:recipient.php');
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    }
?>