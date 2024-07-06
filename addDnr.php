<?php
    include 'connect.php';

    /* STORING INPUT IN VARIABLES AFTER SUBMISSION*/
    if(isset($_POST['submit'])){
        $grpId=$_POST['grpId'];
        $dnrName=$_POST['dnrName'];
        $dnrBirth=$_POST['dnrBirth'];
        $dnrSex=$_POST['dnrSex'];
        $dnrNum=$_POST['dnrNum'];
        $dnrEmail=$_POST['dnrEmail'];
        $dnrAdd=$_POST['dnrAdd'];
        $dnrMed=$_POST['dnrMed'];

        /* USING THE VARIABLES TO INSERT VALUES ON THE TABLE IN A QUERY */
        $sql="INSERT INTO tblDonor(groupId, donorName, donorBirth, donorSex, donorNum, donorEmail,
                donorAddress, donorMedical) VALUES ($grpId,'$dnrName', '$dnrBirth', '$dnrSex',
                '$dnrNum','$dnrEmail', '$dnrAdd','$dnrMed')";
        $result=sqlsrv_query($conn,$sql);

        /* AFTER SUCCESSFUL INSERTION */
        if($result){

            /* STORING INPUT IN VARIABLES */
            $grpId=$_POST['grpId'];
            $dnrName=$_POST['dnrName'];
            $dnrBirth=$_POST['dnrBirth'];
            $dnrSex=$_POST['dnrSex'];
            $dnrNum=$_POST['dnrNum'];
            $dnrEmail=$_POST['dnrEmail'];
            $dnrAdd=$_POST['dnrAdd'];
            $dnrMed=$_POST['dnrMed'];

            /* USING THE VARIABLES TO SELECT THE IDs IN THE TABLE IN A QUERY */
            $sql="SELECT groupId, donorId FROM tblDonor WHERE (donorName='$dnrName' AND 
                donorBirth='$dnrBirth' AND donorSex='$dnrSex' AND donorNum='$dnrNum' AND donorEmail='$dnrEmail' AND donorAddress='$dnrAdd');";
            $result=sqlsrv_query($conn,$sql);
            $row=sqlsrv_fetch_array($result);
            $grpId=$row['groupId'];
            $dnrId=$row['donorId'];

            /* STORING THE DATE INPUT */
            if(isset($_POST['submit'])){
                $dateRcv=$_POST['dateRcv'];
                
                /* USING THE IDs SELECTED AND DATE INPUT TO INSERT RECORD IN INVENTORY */
                $sql="INSERT INTO tblInventory(groupId, donorId, dateReceived) VALUES 
                        ($grpId, $dnrId, '$dateRcv')";
                $result=sqlsrv_query($conn,$sql);

                /* DISPLAYING INVENTORY AFTER SUCCESSFUL INSERTION ON BOTH TABLES */
                if($result){
                    header('location:inventory.php');
                } else {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!--FONTAWESOME CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        .title {
            font-family: 'Poppins';
            margin-top: 20px;
            text-align: center;
        }
    </style>

    <title>Add Donor</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar" style="background-color: #b31312;">
        <div class="container-fluid">
            <a class="navbar-brand" href="inventory.php"><i class="fa-solid fa-heart-pulse fa-2xl" style="color: #ffffff;"></i>
            </a>

            <form class="d-flex">     
                <button class="btn btn-light" type="submit" ><a href="logout.php" class="text-dark">Logout</a></button>
            </form>
        </div>     
    </nav>
    <!-- END OF NAVBAR -->

    <h3 class="title">Add Donor</h3>

    <!-- FORM -->
    <div class="container my-3">
        <form method="post">
            <div class="mb-3">
                <label>Blood Group</label>
                <select class="form-select" name="grpId">
                    <option selected>Choose blood group</option>
                    <option value="1">A+</option>
                    <option value="2">A-</option>
                    <option value="3">B+</option>
                    <option value="2">B-</option>
                    <option value="1">AB+</option>
                    <option value="2">AB-</option>
                    <option value="3">O+</option>
                    <option value="2">O-</option>
                </select>              
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Donor Name" name="dnrName" autocomplete="off">
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Birthday</label>
                    <input type="date" class="form-control" placeholder="Birthday" name="dnrBirth">
                </div>
                <div class="col">
                    <label>Sex</label>
                    <input type="text" class="form-control" placeholder="Sex" name="dnrSex">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" placeholder="Contact No." name="dnrNum" autocomplete="off">
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="dnrEmail" autocomplete="off">
                </div>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Address" name="dnrAdd" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Medical Note</label><br>
                <div class="form-check form-check-inline">      
                    <input class="form-check-input" type="checkbox" name="dnrMed" value="Physically Fit to Donate">
                    <label class="form-check-label">Physically Fit to Donate</label>                 
                </div> 
            </div>
            <div class="mb-3">
                <label>Date Received</label>
                <input type="date" class="form-control" placeholder="Date Received" name="dateRcv">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    </div>
    <!-- END OF FORM -->

    <!-- FOOTER -->
    <div class="col">
        <img src="/CTADVDBL_COM211_FINALS-kadugo/images/footer.png" class="img-fluid" >
    </div>
    <!-- END OF FOOTER -->
  </body>
</html>