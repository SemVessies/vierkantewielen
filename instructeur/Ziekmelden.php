<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Vierkante Wielen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stylesheet.css" type="text/css"/>
</head>

<body>
<div class="banner">
    <div class="navbar">
        <!--        <img src="![](img/Logo.jpg)" class="logo">-->
        <ul>
            <li><a href="http://localhost/VierkanteWielen/instructeur/Calendar.html">Calendar</a></li>
            <li><a href="http://localhost/VierkanteWielen/instructeur/Ziekmelden.php">Ziekmelden</a></li>
    </div>
</div>
<div class="pageContainer">
    <div class="contentWrap">
        <div class="formBox">
            <!--            <form action="Login.php" method="post">-->
            <form id="ziekmelden" class="inputGroup" method="post">
                <?php if (isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET["error"]; ?>
                    <?php } ?>
                    <label for="instructeurNummer"> Instructeurnummer </label>
                    <input class="inputLogin" type="text" name="instructeurNummer" id="instructeurNummer"
                           placeholder="Nummer"><br>
                    <button name="buttonZiek" class="buttonZiek" onclick="save_ziekmelding()" type="submit">Ziekmelden</button>
            </form>
            <?php
            if(isset($_POST['buttonZiek']))
            {
                $meldingDatum = date('Y-m-d');;
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
            <p> ma - vrij 09:00 - 20:00 uur <br> zaterdag 09:00 - 20:00 uur <br> zondag 09:00 - 20:00 uur </p>
        </div>
    </footer>
</div>
</body>
<script>
    function save_ziekmelding() {
        const instructeurNummer = $("#instructeurNummer").val();
        const meldingDatum = $("#meldingDatum").val();
        if (instructeurNummer === "" || meldingDatum === "") {
            alert("Please enter all required details.");
            return false;
        }

        $.ajax({
            url: "save_ziekmelding.php",
            type: "POST",
            dataType: 'json',
            data: {
                instructeurNummer: instructeurNummer,
                meldingDatum: meldingDatum,
            },
            success: function (response) {
                $('#event_entry_modal').modal('hide');
                if (response.status === true) {
                    alert(response.msg);
                    location.reload();
                } else {
                    alert(response.msg);
                }
            },
            error: function (response) {
                console.log('ajax error = ', response);
                // alert(response.msg);
            }
        });
        return false;
    }
</script>