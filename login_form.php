<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <!--Meta Tags-->
        <?php  require 'utils/meta.php'; ?>
        <!--page title-->
        <title>Mason Assets Log In Screen</title>
        <!--style sheets imported-->
        <?php require 'utils/styles.php'; ?>
        <!--js imported-->
        <?php require 'utils/scripts.php'; ?>
    </head>
    <!--sets body bg colour-->
    <body class="logOn">
        <!--restricts content to 1197px-->
        <div class="container">
            <!--vertical-center aligns all content to center vertically-->
            <div class="row vertical-center">
                <!--algins all content to center-->
                <div class="center-all-content center-block col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
                    <!--creates line-->
                    <hr>
                    <h1> Mason Assets</h1>
                    <!--error message holding block-->
                    <span class="error">
                    <!-- checks for errors-->    
                    <?php
                        if (isset($errorMessage))
                        {
                            //prints errors
                            echo "<p>$errorMessage</p>";
                        }
                     ?>
                    </span>
                    <!--log on form submitts to login.php styled as a stack form-->
                    <form action="login.php" method="POST" class="myStack">
                        <fieldset >
                            <!--top input block for username-->
                            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">   
                                <input class="stackStart "
                                    type="text"
                                    name="username"
                                    placeholder="Username:"
                                    value="<?php if (isset($formdata['username'])) echo $formdata['username']; ?>"
                                    />
                            </div>
                            <!--bottom input block for password-->
                            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
                                <input class="stackEnd"
                                    type="password"
                                    name="password"
                                    placeholder="Password:"
                                    value=""
                                    />
                            </div>
                        </fieldset>
                        <!--submit button-->
                        <button type="submit" class = "log_btn" >Sign In</button>
                        <!--creates line-->
                        <hr>
                    </form>
                    <!--link to homepage-->
                    <a href="homepage.php" class="btn border_btn btn-default">Home</a>
                    <!--link to sign up(open new account) customer form-->
                    <a href="signUpCreateCustomerForm.php" class="btn border_btn btn-default">Sign Up</a>
                    <!--<p><a href="register_form.php">Register</a></p>-->
                </div>
            </div><!--close row-->
        </div><!--close container-->
    </body>
</html>
