<?php
    include 'connect.php';

    /* USING THE FETCHED ID TO SELECT RECORD IN THE TABLE */
    $id=$_GET['donorId'];
    $sql="SELECT * FROM tblDonor WHERE donorId=$id";
    $result=sqlsrv_query($conn,$sql);

    /* STORING THE RECORD IN A VARIABLE */
    $row=sqlsrv_fetch_array($result);
    $grpId=$row['groupId'];
    $dnrId=$row['donorId'];
    $dnrName=$row['donorName'];
    $dnrBirth=$row['donorBirth']->format('M d, Y');
    $dnrSex=$row['donorSex'];
    $dnrNum=$row['donorNum'];
    $dnrEmail=$row['donorEmail'];
    $dnrAdd=$row['donorAddress'];
    $dnrMed=$row['donorMedical'];

    if(isset($_POST['submit'])){
        /* STORING INPUT IN VARIABLES */
        $grpId=$_POST['grpId'];
        $dnrName=$_POST['dnrName'];
        $dnrBirth=$_POST['dnrBirth'];
        $dnrSex=$_POST['dnrSex'];
        $dnrNum=$_POST['dnrNum'];
        $dnrEmail=$_POST['dnrEmail'];
        $dnrAdd=$_POST['dnrAdd'];
        $dnrMed=$_POST['dnrMed'];

        /* USING THE VARIABLES TO UPDATE VALUES ON THE TABLE IN A QUERY */
        $sql="UPDATE tblDonor SET 
                donorName='$dnrName', donorBirth='$dnrBirth', donorSex='$dnrSex', donorNum='$dnrNum', 
                donorEmail='$dnrEmail', donorAddress='$dnrAdd', donorMedical='$dnrMed'
                WHERE donorId=$id";
        $result=sqlsrv_query($conn,$sql);

        /* DISPLAYING THE TABLE AFTER SUCCESSFUL UPDATING */
        if($result){
            header('location:donor.php');
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

    <title>Update Donor</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar" style="background-color: #b31312;">
        <div class="container-fluid">
            <a class="navbar-brand"><i class="fa-solid fa-heart-pulse fa-2xl" style="color: #ffffff;"></i>
            </a>

            <form class="d-flex">     
                <button class="btn btn-light" type="submit" ><a href="logout.php" class="text-dark">Logout</a></button>
            </form>
        </div>     
    </nav>
    <!-- END OF NAVBAR -->

    <h3 class="title">Update Donor Details</h3>

    <!-- FORM -->
    <div class="container my-3">
        <form method="post">
            <div class="mb-3">
                <label>Blood Group</label>
                <input type="text" class="form-control" placeholder="Blood Group" name="grpId" autocomplete="off" value="<?php echo $grpId ?>">
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Donor Name" name="dnrName" autocomplete="off" value="<?php echo $dnrName ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label>Birthday</label>
                    <input type="date" class="form-control" placeholder="Birthday" name="dnrBirth" value="<?php echo $dnrBirth ?>">
                </div>
                <div class="col">
                    <label>Sex</label>
                    <input type="text" class="form-control" placeholder="Sex" name="dnrSex" value="<?php echo $dnrSex ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" placeholder="Contact No." name="dnrNum" autocomplete="off" value="<?php echo $dnrNum ?>">
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="dnrEmail" autocomplete="off" value="<?php echo $dnrEmail ?>">
                </div>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Address" name="dnrAdd" autocomplete="off" value="<?php echo $dnrAdd ?>">
            </div>
            <div class="mb-3">
                <label>Medical Note</label><br>
                <div class="form-check form-check-inline">      
                    <input class="form-check-input" type="checkbox" name="dnrMed" value="Physically Fit to Donate">
                    <label class="form-check-label">Physically Fit to Donate</label>                 
                </div>          
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