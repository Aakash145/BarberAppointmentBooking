<?php

class AdminPage
{

    static function adminHeader()
    { ?>
        <html>

        <head>
            <title>Admin Page</title>
            <link href="css/project.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
        <?php
    }
    static function adminBody()
    { ?>
            <div class="menuDiv">
                <small id="loginText"><a href="logout.php">Logout</a></small>
                <header>
                    XYZ Salon
                </header>

            </div>
            <p id=caption><b>Admin Module</b></p>
            <div class="serviceBox2">
                <div id="row1"><b><br><a href="management.php?formName=addBarber">Add Barber</a></b>
                </div>
                <div id="row1"><b><br><a href="management.php?formName=addSchedule">Add Schedule</a></b>
                </div>
                <div id="row1"><b><br><a href="management.php?formName=manageSchedule">Manage Schedule</a></b>
                </div>
            </div>
            <div class="serviceBox2">
                <div id="row1"><b><br><a href="management.php?formName=addService">Add Services</a></b>
                </div>
                <div id="row1"><b><br><a href="management.php?formName=manageServices">Manage Services</a></b>
                </div>
                <div id="row1"><b><br><a href="management.php?formName=deleteServices">Delete Service</a></b>
                </div>
            </div>
            <div class="serviceBox2">
                <div id="row1"><b><br><a href="management.php?formName=deleteBarber">Delete Barber</a></b>
                </div>
            </div>

        <?php
    }
    static function mgtFormHead()
    { ?>
            <html>

            <head>
                <title>Admin Management Page</title>
                <link href="css/project.css" type="text/css" rel="stylesheet" />
            </head>

            <body>
                <div class="menuDiv">
                    <small id="loginText"><a href="logout.php">Logout</a></small>
                    <small id="registerText"><a href="adminModule.php">Back</a></small>
                    <header>
                        XYZ Salon
                    </header>

                </div>
                <br><br>

            <?php
        }

        static function mgtFormBody($barberList = null, $serviceList = null)
        { ?>
                <!--Add Barber-->
                <?php if ($_GET['formName'] == 'addBarber') { ?>
                    <div id="form_login">
                        <form method="post" action="">
                            <label for="name">Name</label><br>
                            <input type="text" name="barbName" id="name" placeholder="Name" required /><br>
                            <label for="mail">Email</label><br>
                            <input type="email" name="userMail" id="mail" placeholder="example@example.com" required /><br>
                            <label for="phone">Contact</label><br>
                            <input type="text" name="contact" id="contact" placeholder="XXXXXXXXXX" required /><br>
                            <label for="address">Address</label><br>
                            <input type="text" name="address" id="address" placeholder="XYZ" required /><br>
                            <!--<label for="role">Role</label><br>-->
                            <input type="text" name="role" id="role" value="BARBER" hidden /><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="addBarber" /><br>
                            <input type="submit" value="Add Barber" class="btn" />
                        </form>
                    </div>
                        <!-- Delete Barber -->
                <?php } else if ($_GET['formName'] == 'deleteBarber') { ?>
                    <div id="form_login">
                    <form method="post" action="">
                            <label for="name">Select Barber</label><br>
                            <select for="barber" name="barNameDel">
                                <?php foreach ($barberList as $barber) {
                                    $name = $barber->getName();
                                    echo "<option value='$name'>$name</option>";
                                } ?>

                            </select><br><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="delBarber" />
                            <input type="submit" value="Delete Barber" class="sml_btn" />
                        </form>
                    </div>
                    <!-- Delete Barber -->
                        <!-- Delete Service -->
                <?php } else if ($_GET['formName'] == 'deleteServices') { ?>
                    <div id="form_login">
                    <form method="post" action="">
                            <label for="name">Select Service</label><br>
                            <select for="barber" name="serviceNameDel">
                                <?php  foreach ($serviceList as $service) {
                                    $name = $service->getName();
                                    echo "<option value='$name'>$name</option>";
                                } ?>

                            </select><br><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="delService" />
                            <input type="submit" value="Delete Service" class="sml_btn" />
                        </form>
                    </div>
                    <!--Add Schedule-->
                <?php } elseif ($_GET['formName'] == 'addSchedule') {
                ?>
                    <div id="form_login">
                        <form method="post" action="">
                            <label for="name">Select Barber</label><br>
                            <select for="barber" name="barID">
                                <?php foreach ($barberList as $barber) {
                                    $name = $barber->getName();
                                    echo "<option value='$name'>$name</option>";
                                } ?>

                            </select><br><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="getBarID" />
                            <input type="submit" value="Get Barber" class="sml_btn" />
                        </form>
                    </div>
                    <!--Manage Schedule-->
                <?php } elseif ($_GET['formName'] == 'manageSchedule') {
                ?>
                    <div id="form_login">
                        <form method="post" action="">
                            <label for="name">Select Barber</label><br>
                            <select for="barber" name="barSchID">
                                <?php foreach ($barberList as $barber) {
                                    $name = $barber->getName();
                                    echo "<option value='$name'>$name</option>";
                                } ?>
                            </select><br><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="mangetBarID" /> 
                            <input type="submit" value="Get Barber" class="sml_btn" />
                        </form>
                    </div>
                    <!--Add Service-->
                <?php } elseif ($_GET['formName'] == 'addService') {
                ?>
                    <div id="form_login">
                        <form method="post" action="">
                            <label for="servLabel">Service Name</label><br>
                            <input type="text" name="serviceName" id="serviceName" required /><br>
                            <label for="servDesc">Service Description</label><br>
                            <input type="text" name="serviceDesc" id="serviceDesc" required /><br>
                            <label for="price">Price</label><br>
                            <input type="text" name="price" id="price" required /><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="addService" /><br>
                            <input type="submit" value="Add Service" class="btn" />
                        </form>
                    </div>
                    <!--Manage Service-->
                <?php } elseif ($_GET['formName'] == 'manageServices') {
                ?>
                    <div>
                        <form action="" method="post">
                            <label for="services">Select Service</label><br>
                            <select for="services" name="servicesNam" id="getNam">
                                <?php
                                foreach ($serviceList as $service) {
                                    $name = $service->getName();
                                    echo "<option value='$name'>$name</option>";
                                }                         
                                ?>
                                <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="getServDet"/><br>
                                <br><input type="submit" value="Get Details" name="details" class="sml_btn" />
                            </select><br><br>
                               </form>
                    </div>
                <?php } ?>

            <?php
        }

        static function manageServiceFormPart2($serDetail)
        { ?>

                <form action="" method="post">
                    <!-- <label for="servLabel">ServiceId</label><br> -->
                    <input type="hidden" name="serviceId" id="serviceId" value= '<?php echo $serDetail->getId();  ?>'  /><br>
                    <label for="servLabel">Modify Service Name</label><br>
                    <input type="text" name="serviceName" id="serviceName" value= '<?php echo $serDetail->getName(); ?>' required /><br>
                    <label for="servDesc">Modify Service Description</label><br>
                    <input type="text" name="serviceDesc" id="serviceDesc" value= '<?php echo $serDetail->getDescription(); ?>' required /><br>
                    <label for="price">Modify Price</label><br>
                    <input type="text" name="price" id="price" value= '<?php echo $serDetail->getRate(); ?>' required /><br>
                    <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="manageServices" /><br>
                    <input type="submit" value="Modify Service" class="btn" />
                </form>
            <?php
        }
        static function addScheduleFormPart2($sechDetail)
        { ?>

                <form action="" method="post">

                            <!-- <label for="userid">User ID</label><br> -->
                            <input type="hidden" name="userid" id="userid"  value= '<?php echo $sechDetail->getUser(); ?>' /><br>
                            <label for="start_time">Date</label><br>
                            <!-- <input type="text" name="stime" id="start_time" required /><br> -->
                            <input type="date" name="sdate" id="sdate" required /><br>
                            <label for="start_time">Start Time</label><br>
                            <!-- <input type="text" name="stime" id="start_time" required /><br> -->
                            <input type="time" name="stime" id="start_time" required /><br>
                            <label for="end_time">End Time</label><br>
                            <!-- <input type="text" name="etime" id="end_time" required /><br> -->
                            <input type="time" name="etime" id="end_time" required /><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="addSchedule" /><br>
                            <input type="submit" value="Add Schedule" class="btn" /> 

                </form>
            <?php
        }

        static function manageScheduleFormPart2($sechDetail)
        { 
            $stime = substr_replace($sechDetail->getStartDate(),'',0,14);
            $etime = substr_replace($sechDetail->getEndDate(),'',0,14);
            ?>
                <form action="" method="post"> 
                            <!-- <label for="userid">User ID</label><br> -->
                            <input type="hidden" name="userid" id="userid"  value= '<?php echo $sechDetail->getUserId(); ?>' /><br>
                            <!-- <label for="shiftid">Shift ID</label><br> -->
                            <input type="hidden" name="shiftid" id="shiftid"  value= '<?php echo $sechDetail->getShiftId(); ?>' /><br>
                            <label for="schedule_date">Enter Date</label><br>
                            <!-- <input type="text" name="stime" id="start_time" required /><br> -->
                            <input type="date" name="schedule_date" id="schedule_date" value= '<?php echo $stime; ?>' required /><br>
                            
                            <label for="start_time">Edit Start Time</label><br>
                            <!-- <input type="text" name="stime" id="start_time" required /><br> -->
                            <input type="time" name="stime" id="start_time" value= '<?php echo $stime; ?>' required /><br>
                            <label for="end_time">Edit End Time</label><br>
                            <!-- <input type="text" name="etime" id="end_time" required /><br> -->
                            <input type="time" name="etime" id="end_time" value= '<?php echo $etime; ?>' required /><br>
                            <input type="text" name="actionItem" id="actionItem" placeholder="actionItem" hidden value="manageSchedule" /><br>
                            <input type="submit" value="Modify Schedule" class="btn" /> 
                </form>
            <?php
        }
        static function adminFooter()
        { ?>
            </body>

            </html>
    <?php
        }
    }
    ?>