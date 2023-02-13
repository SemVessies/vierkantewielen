<?php
if(session_status() < 2){
    session_start();
}
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>title</title>
        <!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
        <!-- CSS for full calender -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet"/>
        <!-- JS for jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- JS for full calender -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.0/index.global.min.js'></script>

        <link rel="stylesheet" href="../stylesheet.css" type="text/css"/>


        <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>-->

        <!-- bootstrap css and js -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <body>

    <div class="banner">
        <div class="navbar">
            <!--        <img src="![](img/Logo.jpg)" class="logo">-->
            <ul>
                <li><a href="http://localhost/VierkanteWielen/instructeur/Calendar.html">Kalender</a></li>
                <li><a href="http://localhost/VierkanteWielen/instructeur/Ziekmelden.php">Ziekmelden</a></li>
            </ul>
        </div>
    </div>
    <div class="pageContainer">
        <div class="contentWrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <!-- Start popup dialog box -->
            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Nieuwe les toevoegen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="lesDoel">les Doel</label>
                                            <input type="text" name="lesDoel" id="lesDoel" class="form-control"
                                                   placeholder="Doel van de les">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lesDatum">Datum</label>
                                            <input type="date" name="lesDatum" id="lesDatum"
                                                   class="form-control onlydatepicker" placeholder="les Datum">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lesTijdBegin">Ophaal tijd</label>
                                            <input type="time" name="lesTijdBegin" id="lesTijdBegin"
                                                   class="form-control"
                                                   placeholder="Begin Les">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lesDuur">Les Duur</label>
                                            <input type="time" name="lesDuur" id="lesDuur" class="form-control"
                                                   placeholder="Les Duur">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="lesOpmerking">Opmerkingen</label>
                                            <input type="text" name="lesOpmerking" id="lesOpmerking"
                                                   class="form-control"
                                                   placeholder="les Opmerking">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="save_event()">Save Les</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End popup dialog box -->

        <footer class="footer">
            <div class="col-1">
                <h3>CONTACTGEGEVENS</h3>
                <p> Laurens Baecklaan 25 <br> 1942LN <br> Beverwijk <br><br>
                    06 45 46 47 48 <br> info@vierkantewielen.nl <br> www.vierkantewielen.nl <br><br> KVK 34567890 </p>
            </div>
            <div class="col-2">
                <h3>Lestijden</h3>
                <p> ma - vrij   09:00 - 20:00 uur<br> zaterdag     09:00 - 20:00 uur <br> zondag    09:00 - 20:00 uur </p>
            </div>
        </footer>
    </div>
    </body>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            console.log(calendarEl);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                initialView: 'dayGridMonth',
                events: 'display_event.php',
                editable: true,
                selectable: true,

                // Klik op datum om een les in te plannen
                dateClick: function (info) {
                    $('#lesDatum').val(moment(info.dateStr).format('YYYY-MM-DD'));
                    // $('#lesDatumEind').val(moment(info.dateStr).format('YYYY-MM-DD'));
                    $('#event_entry_modal').modal('show');

                }
            });
            calendar.render();
        });

    </script>
    <script>
        $(document).ready(function () {
        });

        function display_events() {
            const les = [];
            $.ajax({
                url: 'display_event.php',
                dataType: 'json',
                success: function (response) {

                    const result = response.data;
                    $.each(result, function (i, item) {
                        les.push({
                            lesDoel: result[i].lesDoel,
                            lesDatum: result[i].lesDatum,
                            lesStart: result[i].lesStart,
                            lesEnd: result[i].lesEnd,
                            lesOpmerking: result[i].lesOpmerking,
                            color: result[i].color,
                            url: result[i].url
                        });
                    })
                    $('#calendar').fullCalendar({
                        defaultView: 'month',
                        timeZone: 'local',
                        editable: true,
                        selectable: true,
                        selectHelper: true,
                        events: 'display_event.php'
                    }); // eindig fullCalendar block
                },// eindig success block
                error: function (response) {
                    console.log(response)
                    // alert(response);
                }
            });
        }

        // Functie save_event slaat ingevulde gegevens op in Database
        function save_event() {
            const lesDoel = $("#lesDoel").val();
            const lesDatum = $("#lesDatum").val();
            const lesTijdBegin = $("#lesTijdBegin").val();
            const lesDuur = $("#lesDuur").val();
            const lesOpmerking = $("#lesOpmerking").val();
            if (lesDoel === "" || lesDatum === "" || lesTijdBegin === "" || lesDuur === "" || lesOpmerking === "") {
                alert("Please enter all required details.");
                return false;
            }

            $.ajax({
                url: "save_event.php",
                type: "POST",
                dataType: 'json',
                data: {
                    lesDoel: lesDoel,
                    lesDatum: lesDatum,
                    lesTijdBegin: lesTijdBegin,
                    lesDuur: lesDuur,
                    lesOpmerking: lesOpmerking
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
                }
            });
            return false;
        }
    </script>
    </html>
<?php }
else{
    header("Location: ../Login.php");
}?>





