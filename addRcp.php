<?php
    include 'connect.php';

    /* STORING THE FETCHED ID TO SELECT THE BLOOD GROUP */
    $bldId=$_GET['bloodId'];
    $sql="SELECT groupId FROM tblInventory WHERE bloodId=$bldId";
    $result=sqlsrv_query($conn,$sql);
    $row=sqlsrv_fetch_array($result);
    $grpId=$row['groupId'];

    /* STORING INPUT IN VARIABLES AFTER SUBMISSION*/
    if(isset($_POST['submit'])){
        $rcpName=$_POST['rcpName'];
        $rcpBirth=$_POST['rcpBirth'];
        $rcpSex=$_POST['rcpSex'];
        $rcpNum=$_POST['rcpNum'];
        $rcpEmail=$_POST['rcpEmail'];
        $rcpAdd=$_POST['rcpAdd'];
        $rcpMed=$_POST['rcpMed'];

        /* USING THE VARIABLES TO INSERT VALUES ON THE TABLE IN A QUERY */
        $sql="INSERT INTO tblPatient(groupId, patientName, patientBirth, patientSex, patientNum, 
                patientEmail, patientAddress, patientMedical) VALUES ($grpId,'$rcpName', 
                '$rcpBirth','$rcpSex','$rcpNum','$rcpEmail','$rcpAdd','$rcpMed')";
        $result=sqlsrv_query($conn,$sql);

        /* AFTER SUCCESSFUL INSERTION */
        if($result){

            /* STORING INPUT IN VARIABLES */
            $rcpName=$_POST['rcpName'];
            $rcpBirth=$_POST['rcpBirth'];
            $rcpSex=$_POST['rcpSex'];
            $rcpNum=$_POST['rcpNum'];
            $rcpEmail=$_POST['rcpEmail'];
            $rcpAdd=$_POST['rcpAdd'];
            $rcpMed=$_POST['rcpMed'];

            /* USING THE VARIABLES TO SELECT THE IDs IN THE TABLE IN A QUERY */
            $sql="SELECT groupId, patientId FROM tblPatient WHERE (patientName='$rcpName' AND 
                patientBirth='$rcpBirth' AND patientSex='$rcpSex' AND patientNum='$rcpNum' AND patientEmail='$rcpEmail' AND patientAddress='$rcpAdd');";
            $result=sqlsrv_query($conn,$sql);
            $row=sqlsrv_fetch_array($result);
            $grpId=$row['groupId'];
            $rcpId=$row['patientId'];

            /* STORING THE DATE INPUT */
            if(isset($_POST['submit'])){
                $dateDnt=$_POST['dateDnt']/* ->format('M d, Y') */;

                /* USING THE IDs SELECTED AND DATE INPUT TO UPDATE RECORD IN INVENTORY */
                $sql="UPDATE tblInventory SET groupId=$grpId, patientId=$rcpId, dateDonated='$dateDnt'
                        WHERE bloodId=$bldId";
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

    <title>Add Recipient</title>
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

    <h3 class="title">Add Recipient</h3>

    <!-- FORM -->
    <div class="container my-3">
        <form method="post">
            <div class="mb-3">
                <label>Blood Group</label>
                <select class="form-select" disabled>
                    <option selected><?php 
                        if($grpId==1){ ?> <option selected>A+</option> <?php }
                        else if($grpId==2){ ?> <option selected>A-</option> <?php }
                        else if($grpId==3){ ?> <option selected>B+</option> <?php }
                        else if($grpId==4){ ?> <option selected>B-</option> <?php }
                        else if($grpId==5){ ?> <option selected>AB+</option> <?php }
                        else if($grpId==6){ ?> <option selected>AB-</option> <?php }
                        else if($grpId==7){ ?> <option selected>O+</option> <?php }
                        else if($grpId==8){ ?> <option selected>O-</option> <?php } ?>
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Recipient Name" name="rcpName" autocomplete="off">
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Birthday</label>
                    <input type="date" class="form-control" placeholder="Birthday" name="rcpBirth">
                </div>
                <div class="col">
                    <label>Sex</label>
                    <input type="text" class="form-control" placeholder="Sex" name="rcpSex">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" placeholder="Contact No." name="rcpNum" autocomplete="off">
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="rcpEmail" autocomplete="off">
                </div>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Address" name="rcpAdd" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Medical Note</label><br>
                <textarea class="form-control" rows="3" placeholder="Medical Note" name="rcpMed"></textarea>       
            </div>
            <div class="mb-3">
                <label>Date Donated</label>
                <input type="date" class="form-control" placeholder="Date Donated" name="dateDnt">
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