<?php 
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Attend QR</title>
    
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body>

    <nav class="navbar">
        <ul class="nav-list">
            <div class="logo"><a href=""><img src="../assets/apple-touch-icon.png" alt="logo" style="width:40px;height:40px;border-radius:50px;"></a></div>
            <!-- <li class="nav-item"><a href="">Scan</a></li> -->
            <li class="nav-item"><a href="contact.html">Contact</a></li>
            <li class="nav-item"><a href="logout.html"><img src="../assets/logout.png" alt="Logout"></a></li>
        </ul>
    </nav>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <div class="canvas">
        <h1 class="scan">Scan</h1>
    
        <div id="reader" style="width:300px">
        </div>
        
        <div id="qr-reader-results">
            <h3>Result : </h3>
        </div>

        <form action="attend.php" method="$_POST">
            <input type="text" name="stud" id="stud" placeholder="Student ID">
            <input type="submit" id="ID" value="Scan">
        </form>
        <?php
            if(isset($_SESSION['already_set'])){?>
            <div class="alert alert-danger" style="width: 60%">
                <strong>You have already given attendance</strong>
            </div>
            <?php unset($_SESSION['already_set']); }?>
            <?php
            if(isset($_SESSION['error'])){?>
                <div class="alert alert-danger" style="width: 60%">
                    <strong>Student does not exist</strong>
                </div>
            <?php unset($_SESSION['error']); }?>
        <?php
            if(isset($_SESSION['set_student'])){?>
                <div class="alert alert-success" style="width: 60%">
                    <strong>Marked present</strong>
                </div>
        <?php unset($_SESSION['set_student']); }?>
            
    </div>

    <script type="text/javascript">
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                document.getElementById('stud').value = decodedText;
            }
            //console.log(decodedResult)
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 20, qrbox: 300 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>