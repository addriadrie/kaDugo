<!-- LOGIN PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- STYLE SHEET -->
    <style>
    .form-container {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255);
      /* padding: 20px; */
      width: 23%;
      border: 10px solid white;
      border-radius: 10px;
      font-family: 'Poppins';
    }
    .login-header {
        text-align:center;
        background-color: rgb(179,19,18);
        padding: 5px;
        color: white;
        border-top-style: 10px solid rgb(179,19,18);
        border-radius: 10px;
        font-family: 'Poppins';
    }
    .input-group{
        padding: 5px;
        left: 3%;
        top: 10px;
    }
    .btn-container{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    <!-- END OF STYLE SHEET -->

    <title>Login</title>
</head>

<body>
    <div>
        <!-- BACKGROUNG IMAGE -->
        <img src="/CTADVDBL_COM211_FINALS-kadugo/images/index-background.jpg" class="img-fluid" width="100%" alt="Photo by Nguyễn Hiệp on Unsplash">

        <!-- FORM -->
        <div class="form-container">
            <div class="login-header">Admin Login</div>

            <form action="login.php" method="post"> 
                <div class="input-group">
					<span class="input-group-text">
                        <i class="fa-regular fa-user" style="color: #b31312;"></i>
					</span>
					<input type="text" id="username" name="username" placeholder="Username" required>
				</div>
                <div class="input-group">
					<span class="input-group-text">
                        <i class="fa-regular fa-lock" style="color: #b31312;"></i>
					</span>
					<input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
				</div>
                <br>
                <div class="btn-container">
                    <input class="btn-outline-secondary" type="submit" value="Login">
                </div>           
            </form>
        </div>
        <!-- END OF FORM -->
    </div>

    <!-- FOOTER -->
    <div class="fixed-bottom">
        <img src="/CTADVDBL_COM211_FINALS-kadugo/images/footer.png" class="img-fluid" >
    </div>
    <!-- END OF FOOTER -->

</body>
</html>