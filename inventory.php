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
        }

        .donor {
            font-family: 'Poppins';
        }       
    </style>

    <title>kadugo</title>
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
            <a href="inventory.php" class="btn btn-danger active" aria-current="page">Inventory</a>
            <a href="donor.php" class="btn btn-outline-danger">Donors</a>
            <a href="recipient.php" class="btn btn-outline-danger">Recipients</a>
        </div>
    </div>
    <!-- END OF BUTTON LINKS -->

     <!-- DISPLAY OF DATABASE -->
     <div class = "container">
        <table class="table table-striped table-hover">
            <tr>
                <th>Blood ID</th>
                <th>Blood Type</th>
                <th>Donor Name</th>
                <th>Date Received</th>
                <th>Recipient Name</th>
                <th>Date Donated</th>
            </tr>
            <tbody class="table-group-divider">
                <?php
                    $query = "SELECT tblInventory.bloodId, tblBlood.bloodGroup, tblDonor.donorName,
                                tblInventory.dateReceived, tblPatient.patientName, tblInventory.dateDonated
                                FROM tblInventory INNER JOIN tblBlood ON tblInventory.groupId=tblBlood.groupId
                                LEFT JOIN tblDonor ON tblInventory.donorId=tblDonor.donorId
                                LEFT JOIN tblPatient ON tblInventory.patientId=tblPatient.patientId;";
					$result = sqlsrv_query($conn, $query);
                    if($result){
                        while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                            $bldId=$row['bloodId'];
                            $bldGrp=$row['bloodGroup'];
                            $dnrName=$row['donorName'];

                            if (!is_null($row['dateReceived'])) {
                                $dateRcv = $row['dateReceived']->format('M d, Y');
                            }
                            
                            $rptName=$row['patientName'];

                            /* FORMATTING dateDonated INTO STRING IF NOT EMPTY */
                            if(!is_null($row['dateDonated'])) {
                                $dateDnt=$row['dateDonated']->format('M d, Y');
                            }
                            
                            /* PRINTING VALUES INTO TABLE */
                            echo '
                                <tr>
                                <th scope="row">'.$bldId.'</th>
                                <td>'.$bldGrp.'</td>
                                <td>'.$dnrName.'</td>
                                <td> '.$dateRcv.' </td>'; ?>

                            <?php
                                /* ADDING RECIPIENT BUTTON IF patientName IS EMPTY AND GETTING bloodId*/
                                if(is_null($row['patientName'])) {
                                    echo '
                                    <td>
                                    <button class="btn btn-outline-danger"><a href="addRcp.php?bloodId='.$bldId.'" style="color:#b31312;">Add Recipient</a></button>
                                    </td>'; ?>
                            <?php
                                /* PRINTING patientName IF NOT EMPTY*/             
                                } else {
                                    echo '
                                    <td>'.$rptName.'</td>';
                                } ?>
                            <?php
                                /* PRINTING A COLUMN SPACE IF dateDonated IS EMPTY FOR BETTER VISUAL */
                                if(is_null($row['dateDonated'])) {
                                    echo '
                                    <td> </td>'; ?>
                            <?php
                                /* PRINTING dateDonated IF NOT EMPTY */             
                                } else {
                                    echo '
                                    <td>'.$dateDnt.'</td> ';
                                } ?>
                                </tr> <?php
                        }    
                    }
				?> 
            </tbody> 
        </table>
    </div>
    <!-- END OF DISPLAY OF DATABASE -->

    <!-- ADD DONOR BUTTON -->
    <div class="donor">
        <div class="d-grid gap-2 col-6 mx-auto">
            <button onclick="window.location.href='addDnr.php';" class="btn btn-large btn-warning" type="button">Add Donor
                <i class="fa-regular fa-address-card"></i>
            </button>
        </div>       
    </div>   
    <!-- END OF DONOR BUTTON -->

    <!-- FOOTER -->
    <div class="col">
        <img src="/CTADVDBL_COM211_FINALS-kadugo/images/footer.png" class="img-fluid" >
    </div>
    <!-- END OF FOOTER -->

</body>
</html>