<?php
class Page
{
    static function UserHeader()
    { ?>
        <html>

        <head>
            <title>User Login</title>
            <link href="css/project.css" type="text/css" rel="stylesheet" />

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            <script>
                $(function() {
                    $("#dateIcon").datepicker();
                    $("#dateIcon").change(function() {
                        var selected = $(this).val();
                        $("#dateTxt").val(selected);
                    });
                });
            </script>
        </head>

        <body>
        <?php
    }
    static function userBody($services)
    { ?>
            <div class="menuDiv">
                <small id="loginText"><a href="logout.php">Logout</a></small>
                <header>
                    XYZ Salon
                </header>
            </div>

            <?php if (isset($_GET['message'])) {
                $message =  $_GET['message'];
                echo "<h2>" . $message . "</h2>";
            } ?>

            <div id="userFormDiv">
                <!-- Select Services -->
                <form method="post" action="" id="userForm">
                    <h1 id="userformHead">Booking Form -- XYZ Salon</h1>

                    <h1 class="userCap">Select Services</h1>

                    <?PHP                    
                    //loop here
                    foreach ($services as $service) {
                        $_asd = $service->getName();
                        echo '<input type="checkbox" id="chk1" name="services[]" value='.$service->getId().'><label for="chk1" class="chkLbl">' . $service->getName() . '</label>';
                        echo '<br>';
                    }
                    ?>

                    <!-- Select Date -->
                    <h1 class="userCap">Select Date</h1>
                    <!-- <div style="margin-left:50px;" id="dateIcon" class="dateIcon"></div>-->
                    <input type="date" name="date" id="dateTxt">
                    <h1 class="userCap">Select Time</h1>
                    <input type="time" name="time" min="9:30" max="17:30" step="3600"/>

                    <input type="hidden" name="action" value="addBasicDetail" id="dateTxt"><br>
                    <input type="submit" name="CheckAvailability" value="Check Availability" class="btnUser">
                </form>
            </div>


            <!--Booking History-->
            <div id="bookHistory" class="loginDiv">
                <div class="loginDiv2">
                    <small alt="close" class="close" onclick="cancel()">X</small3600>
                    <h1 id="userformHead">Booking History</h1>
                    <div id="form_login">

                        <table id="hisTab">
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer ID</th>
                                <th>Barber ID</th>
                                <th>Booking Date</th>
                                <th>Amount</th>
                            </tr>
                            <?php
                            //loop here
                            echo "<tr>";
                            echo "<td>1</td>";
                            echo "<td>11</td>";
                            echo "<td>14</td>";
                            echo "<td>12/15/2020</td>";
                            echo "<td>$100</td>";
                            echo "</tr>";
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                var bookingHis = document.getElementById("bookHistory");

                function cancel() {
                    bookingHis.style.display = "none";
                }

                function history() {
                    bookingHis.style.display = "block";
                }
            </script>
        <?php
    }

    static function bookAppointment($barberArr = null)
    { ?>
                <div class="menuDiv">
                <small id="loginText"><a href="logout.php">Logout</a></small>
                <small id="adminText"><a href="userLogin.php">Back</a></small>
                <header>
                    XYZ Salon
                </header>
            </div>

            <div id="userFormDiv">
           
                <!-- Select Services -->
                <form id="userForm" method="post" action="">
                <h1 id="userformHead">Booking Form -- XYZ Salon</h1>
            <br>
                    <!-- Select Time -->
                    <!--
                    <h1 class="userCap">Select Time</h1>
                                        //loop here
                    echo '<input type="radio" id="time" name="timeRad value=""><label for="time" class="rad1">Time 1</label>';
                    -->
                    <!-- Select Barber -->
                    <h1 class="userCap">Select Barber</h1>
                    <?PHP
                    $isBarberAvailable = true;
                    //loop here
                    if(!empty($barberArr)){
                        foreach($barberArr as $barber){                           
                        echo '<input type="radio" id="barb" name="barbRad" value="'.$barber->getuser().'"><label for="barb" class="rad2">'.$barber->getName().'</label>';
                        }
                    }else{
                        $isBarberAvailable = false;
                        echo '<h3>No barber available for the selected schedule</h3>';
                    }                    
                    ?>
                    <input type="hidden" name="services" value= "<?php echo $_POST['services']; ?>" id="dateTxt">
                    <input type="hidden" name="date" value= "<?php echo $_POST['date']; ?>" id="dateTxt">
                    <input type="hidden" value="<?php echo $_POST['time']; ?>" name="time" min="9:30" max="17:30" step="3600"/>
                    <input type="hidden" name="action" value="bookAppointment" id="dateTxt">
                    <br><br>
                    <input type="submit" name="bookAppoint" value="Book Appointment" class="btnUser" <?php echo ($isBarberAvailable ? "" : 'disabled'); ?>>
                </form>
            </div>
        <?php }

    static function userFooter()
    { ?>
        </body>

        </html>
<?php
    }
}
?>