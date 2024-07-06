<?php
	include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!--FONTAWESOME CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        .links{
            justify-content: center;
            align-items: center;
            display: flex;
            padding: 15px;
            font-family: 'Poppins';
        }
        .container{
            font-family: 'Poppins';
            text-align: center;
            font-size: 14px;
        }
    </style>

    <title>Donors</title>
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

    <!-- BUTTON LINKS -->
    <div class="links">
        <div class="btn-group">
            <a href="inventory.php" class="btn btn-outline-danger">Inventory</a>
            <a href="donor.php" class="btn btn-danger active" aria-current="page">Donors</a>
            <a href="recipient.php" class="btn btn-outline-danger">Recipients</a>
        </div>
    </div>
    <!-- END OF BUTTON LINKS -->

    <!-- DISPLAY OF DATABASE -->
    <div class = "container">
        <table class="table table-striped table-hover">
            <tr>
                <th>Blood Type</th>
                <th>Donor ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Sex</th>
                <th>Contact No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Medical Note</th>
                <th>Action</th>
            </tr>
            <tbody class="table-group-divider">
                <?php
                    $query = "SELECT tblBlood.bloodGroup, tblDonor.donorId, tblDonor.donorName, 
                                tblDonor.donorBirth, tblDonor.donorSex, tblDonor.donorNum, 
                                tblDonor.donorEmail, tblDonor.donorAddress, tblDonor.donorMedical
                                FROM tblDonor JOIN tblBlood ON tblDonor.groupId=tblBlood.groupId;";
					$result = sqlsrv_query($conn, $query);
                    if($result){
                        while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                            $bldGrp=$row['bloodGroup'];
                            $dnrId=$row['donorId'];
                            $dnrName=$row['donorName'];
                            $dnrBirth=$row['donorBirth']->format('M d, Y');
                            $dnrSex=$row['donorSex'];
                            $dnrNum=$row['donorNum'];
                            $dnrEmail=$row['donorEmail'];
                            $dnrAdd=$row['donorAddress'];
                            $dnrMed=$row['donorMedical'];
                            
                            /* PRINTING VALUES INTO TABLE */
                            echo '
                                <tr>
                                <th scope="row">'.$bldGrp.'</th>
                                <td>'.$dnrId.'</td>
                                <td>'.$dnrName.'</td>
                                <td> '.$dnrBirth.' </td>
                                <td> '.$dnrSex.' </td>
                                <td> '.$dnrNum.' </td>
                                <td> '.$dnrEmail.' </td>
                                <td> '.$dnrAdd.' </td>
                                <td> '.$dnrMed.' </td>
                                <td>
                                <button class="btn btn-warning"><a href="updateDnr.php?donorId='.$dnrId.'"  ><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a></button>
                                <button class="btn btn-danger" class="text-light"><a href="deleteDnr.php?donorId='.$dnrId.'"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a></button>
                                </td>
                                </tr>';
                        }    
                    }
				?> 
            </tbody> 
        </table>
    </div>
    <!-- END OF DISPLAY OF DATABASE -->

    <!-- FOOTER -->
    <div class="col">
        <img src="/CTADVDBL_COM211_FINALS-kadugo/images/footer.png" class="img-fluid" >
    </div>
    <!-- END OF FOOTER --> 
</body>
</html>