<?php
class MainPage
{

    static function header()
    { ?>
        <html>

        <head>
            <title>Home Page Hello</title>
            <link href="css/project.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
        <?php
    }

    static function body($servicesArr)
    { ?>
            <div class="menuDiv">
                <small id="loginText"><a href="loginPage.php">Login</a></small>
                <small id="registerText"><a href="registerPage.php">Register</a></small>
                <small id="adminText"><a href="loginPage.php">Admin</a></small>
                <header>
                    XYZ Salon
                </header>
            </div>
            <p id=caption><b>Services that we offer</b></p>
            <p id=caption><b><?php if (isset($_GET['message'])) {
                                    $message =  $_GET['message'];
                                    echo "<h2>" . $message . "</h2>";
                                } ?></b></p>

           <div>
            <?php 
            $counter = 0;
            $div12 = true;
            foreach($servicesArr as $service){
                $service->getName();
                $service->getDescription();

                if(($counter++%3) == 0){
                    if($div12){
                        $div12 = false;
                        echo '<div class="serviceBox1">';
                    }else{
                        $div12 = true;
                        echo '<div class="serviceBox2">';
                    }
                }
                
                    echo '<div id="row1"><b>'.$service->getName().'</b>';
                    echo '<br> <i>'.$service->getDescription().'</i>';
                    echo '</div>';
                
                    if(($counter%3) == 0){
                        echo '</div>';
                    }
                


            }

            
            ?>
</div>
        <?php
       
    }

    static function footer()
    { ?>

        <div>
        <footer>
            <div class="footer">
                <div>Address
                    <br>12345 Surrey Place
                    <br>BC, Canada, V3V4Xy
                </div>
                <div>Contact Us
                    <br>(+1)7789536578
                    <br>(+1)7789536578
                    <br> Email: xyzsalon@outlook.com</div>
                <div>Opening Hours
                    <br> Mon-Fri : 9:00-5:30 PM
                    <br> Sat : 10:00-4:00 PM
                    <br> Sun : Closed
                </div>
            </div>
        </footer>
        </div>
 
        </body>
        </html>
    <?php
    }


    static function loginBody($errors)
    { ?>
        <div class="menuDiv">
            <small id="loginText"><a href="Team2.php">Home Page</a></small>
            <small id="registerText"><a href="registerPage.php">Register</a></small>
            <header>
                XYZ Salon
            </header>
        </div>
        <p id=caption><b>Login Page</b></p>
        <?php if (isset($_GET['message'])) {
            $message =  $_GET['message'];
            echo "<h2>" . $message . "</h2>";
        } ?>
        <br>
        <div id="form_login1">
            <form ACTION="" METHOD="POST">
                <?php if (!empty($errors)) {
                    MainPage::showErrors($errors);
                } ?>
                <label for="mail">Username</label><br>
                <input type="text" name="username" id="username" required /><br>
                <label for="phone">Password</label><br>
                <input type="password" name="userPass" id="pass" placeholder="**********" required /><br>
                <input type="submit" value="login" class="btn" />
            </form>
        </div>
    <?php
    }

    static function loginFooter()
    { ?>

        </body>

        </html>
    <?php
    }

    static function registerBody($errors)
    { ?>

        <div class="menuDiv">
            <small id="loginText"><a href="loginPage.php">Login</a></small>
            <small id="registerText"><a href="Team2.php">Home Page</a></small>
            <header>
                XYZ Salon
            </header>
        </div>
        <p id=caption><b>Register Page</b></p>
        <br>
        <div id="form_login1">
            <?php if (!empty($errors)) {
                MainPage::showErrors($errors);
            }
            ?>
            <form ACTION="" METHOD="POST">
                <label for="uname">Name</label><br>
                <input type="text" name="uname" id="uname" placeholder="John Smith" required /><br>
                <label for="mail">Email</label><br>
                <input type="email" name="mail" id="mail" placeholder="example@example.com" required /><br>
                <label for="phone">Phone</label><br>
                <input type="text" name="phone" id="phone" placeholder="XXXXXXXXXXX" required /><br>
                <label for="uname">Username</label><br>
                <input type="text" name="username" id="username" placeholder="JohnSmith" required /><br>
                <label for="phone">Password</label><br>
                <input type="password" name="pass" id="pass" placeholder="**********" required /><br>
                <label for="phone">ConfirmPassword</label><br>
                <input type="password" name="cpass" id="cpass" placeholder="**********" required /><br>
                <input type="hidden" name="role" id="role" value="USER" /><br>
                <input type="submit" value="Register" class="btn" />
            </form>

        </div>
    <?php
    }

    static function showErrors($errors)
    {
        echo "
        <p>Please fix the following errors.<p>
        <ul>
        ";

        for ($i = 0; $i < count($errors); $i++) {
            echo "<li>" . $errors[$i] . "</li>";
        }
    }



    static function registerFooter()
    { ?>

        </body>

        </html>
<?php
    }
}
?>