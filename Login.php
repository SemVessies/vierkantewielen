<?php
session_start();
include "dbConnect.php";

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

$Email = validate($_POST['inputEmail']);
$Wachtwoord = validate($_POST['inputWachtwoord']);
$loggedIn = false;

// Checks of het Email adres en Wachtwoord zijn ingevuld
if (empty($Email)) {
    header("Location: LoginPage.php?error=Email is required");
    exit();
} elseif (empty($Wachtwoord)) {
    header("Location: LoginPage.php?error=Wachtwoord is required");
    exit();
}

// Haalt gegevens op uit Database tabel: leerlingLogin en linkt de tabelgegevens leerlingEmail aan $Email
$sql = "SELECT * FROM leerlinglogin WHERE leerlingEmail = '$Email'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    // Als het ingevoerde wachtwoord "$Wachtwoord" overeen komt met het wachtwoord in de Database --> Login
    if (password_verify($Wachtwoord, $row['leerlingWachtwoord'])) {
        header("Location: ../VierkanteWielen/leerling/Calendar.php");
        $loggedIn = true;
        $_SESSION["loggedIn"] = true;
    } else {
        // Ingevulde Email en/of Wachtwoord komen niet overeen met de gegevens in de Database
        header("Location: LoginPage.php?error=Wachtwoord/email is onjuist");
    }
}

$sql = "SELECT * FROM instructeurlogin WHERE instructeurEmail = '$Email'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($Wachtwoord, $row['instructeurWachtwoord'])) {
        header("Location: ../VierkanteWielen/instructeur/Calendar.php");
        $loggedIn = true;
        $_SESSION["loggedIn"] = true;
    } else {
        header("Location: LoginPage.php?error=Wachtwoord/email is onjuist");
    }
}

$sql = "SELECT * FROM rijschoolhouder WHERE username = '$Email'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($Wachtwoord, $row['adminWachtwoord'])) {
        header("Location: ../VierkanteWielen/rijschoolhouder/RijschoolhouderPage.php");
        $loggedIn = true;
        $_SESSION["loggedIn"] = true;
    } else {
        header("Location: LoginPage.php?error=Wachtwoord/email is onjuist");
    }
}





//if (mysqli_num_rows($result) === 1) {
//    $row = mysqli_fetch_assoc($result);
//
//    var_dump($Wachtwoord);
//    var_dump(password_hash($Wachtwoord, PASSWORD_DEFAULT));
//    exit();
//
//    if (password_verify($Wachtwoord, $row['adminWachtwoord'])) {
//        header("Location: ../VierkanteWielen/RijschoolhouderPage.php");
//        $loggedIn = true;
//        $_SESSION["loggedIn"] = true;
//    } else {
//        header("Location: LoginPage.php?error=Wachtwoord/email is onjuist");
//    }
//}