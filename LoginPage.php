<?php
if(session_status() < 2){
    session_start();
}
$_SESSION["loggedIn"] = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vierkante Wielen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>

<body>
<div class="banner">
    <div class="navbar">
        <!--        <img src="![](img/Logo.jpg)" class="logo">-->
        <ul>
            <li><a href="http://localhost/VierkanteWielen/index.php">Home</a></li>
            <li><a href="http://localhost/VierkanteWielen/Pakketten.php">Pakketten</a></li>
            <li><a href="http://localhost/VierkanteWielen/OverOns.php">Over Ons</a></li>
            <li><a href="http://localhost/VierkanteWielen/Routebeschrijving.php">Routebeschrijving</a></li>
        </ul>
    </div>
</div>

<div class="pageContainer">
    <div class="contentWrap">
            <div class="formBox">
                <form action="Login.php" method="post">
                    <form id="login" class="inputGroup" method="post">
                        <?php if (isset($_GET['error'])) { ?>
                        <p class="error"> <?php echo $_GET["error"]; ?>
                            <?php } ?>
                            <label for="inputEmail"> Email </label>
                            <input class="inputLogin" type="text" name="inputEmail" id="inputEmail"
                                   placeholder="Email"><br>
                            <label for="inputWachtwoord"> Wachtwoord </label>
                            <input class="inputLogin" type="password" name="inputWachtwoord" id="inputWachtwoord"
                                   placeholder="Wachtwoord"><br>
                            <button class="buttonLogin" type="submit">Login</button>
                    </form>
            </div>
        </div>
        <footer class="footer">
            <div class="col-1">
                <h3>CONTACTGEGEVENS</h3>
                <p> Laurens Baecklaan 25 <br> 1942LN <br> Beverwijk <br><br>
                    06 45 46 47 48 <br> info@vierkantewielen.nl <br> www.vierkantewielen.nl <br><br> KVK 34567890 </p>
            </div>
            <div class="col-2">
                <h3>Lestijden</h3>
                <p> ma - vrij 09:00 - 20:00 uur<br> zaterdag 09:00 - 20:00 uur <br> zondag 09:00 - 20:00 uur </p>
            </div>
        </footer>
    </div>
</body>