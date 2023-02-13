<?php
include "../dbConnect.php";

if (session_status() < 2) {
    session_start();
}
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>...</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stylesheet.css" type="text/css"/>
</head>
<body>
<div class="banner">
    <div class="navbar">
    </div>
</div>
<div class="pageContainer">
    <div class="contentWrap">


        <?php

        $sql = "SELECT leerlingNummer AS Nummer, leerlingNaam AS Naam, leerlingEmail AS Email, leerlingGeboortedatum AS Geboortedatum, leerlingTelefoon AS Telefoon, 
              leerlingAdres AS Adres, leerlingWoonplaats AS Woonplaats, leerlingOphaaladres AS Ophaaladres FROM leerling";

        $result = mysqli_query($connect, $sql);
        $aantalr = mysqli_num_rows($result);

        if ($aantalr > 0) {
            $field_info0 = mysqli_fetch_field_direct($result, 0);
            $field_info1 = mysqli_fetch_field_direct($result, 1);
            $field_info2 = mysqli_fetch_field_direct($result, 2);
            $field_info3 = mysqli_fetch_field_direct($result, 3);
            $field_info4 = mysqli_fetch_field_direct($result, 4);
            $field_info5 = mysqli_fetch_field_direct($result, 5);
            $field_info6 = mysqli_fetch_field_direct($result, 6);
            $field_info7 = mysqli_fetch_field_direct($result, 7);

            echo "<table class='gebruikers' border='1' bgcolor='#cccccc'>";

            echo "<tr><td><strong>" . $field_info0->name . "</strong></td>
        <td><strong>" . $field_info1->name . "</strong></td>
        <td><strong>" . $field_info2->name . "</strong></td>
        <td><strong>" . $field_info3->name . "</strong></td>
        <td><strong>" . $field_info4->name . "</strong></td>
        <td><strong>" . $field_info5->name . "</strong></td>
        <td><strong>" . $field_info6->name . "</strong></td>
        <td><strong>" . $field_info7->name . "</strong></td></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row[$field_info0->name] . "</td>";
                echo "<td>" . $row[$field_info1->name] . "</td>";
                echo "<td>" . $row[$field_info2->name] . "</td>";
                echo "<td>" . $row[$field_info3->name] . "</td>";
                echo "<td>" . $row[$field_info4->name] . "</td>";
                echo "<td>" . $row[$field_info5->name] . "</td>";
                echo "<td>" . $row[$field_info6->name] . "</td>";
                echo "<td>" . $row[$field_info7->name] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }

        $sql = "SELECT instructeurNummer AS Nummer, instructeurNaam AS Naam, instructeurEmail AS Email, instructeurTelefoon AS Telefoon, 
              instructeurAdres AS Adres, instructeurWoonplaats AS Woonplaats, AutoKenteken AS Kenteken FROM instructeur";

        $result = mysqli_query($connect, $sql);
        $aantalr = mysqli_num_rows($result);

        if ($aantalr > 0) {
            $field_info0 = mysqli_fetch_field_direct($result, 0);
            $field_info1 = mysqli_fetch_field_direct($result, 1);
            $field_info2 = mysqli_fetch_field_direct($result, 2);
            $field_info3 = mysqli_fetch_field_direct($result, 3);
            $field_info4 = mysqli_fetch_field_direct($result, 4);
            $field_info5 = mysqli_fetch_field_direct($result, 5);
            $field_info6 = mysqli_fetch_field_direct($result, 6);

            echo "<table class='gebruikers' border='1' bgcolor='#cccccc'>";

            echo "<tr>
        <td><strong>" . $field_info0->name . "</strong></td>
        <td><strong>" . $field_info1->name . "</strong></td>
        <td><strong>" . $field_info2->name . "</strong></td>
        <td><strong>" . $field_info3->name . "</strong></td>
        <td><strong>" . $field_info4->name . "</strong></td>
        <td><strong>" . $field_info5->name . "</strong></td>
        <td><strong>" . $field_info6->name . "</strong></td>
        </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row[$field_info0->name] . "</td>";
                echo "<td>" . $row[$field_info1->name] . "</td>";
                echo "<td>" . $row[$field_info2->name] . "</td>";
                echo "<td>" . $row[$field_info3->name] . "</td>";
                echo "<td>" . $row[$field_info4->name] . "</td>";
                echo "<td>" . $row[$field_info5->name] . "</td>";
                echo "<td>" . $row[$field_info6->name] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }

        ?>


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
<?php }
else {
    header("Location: ../Login.php");
} ?>
