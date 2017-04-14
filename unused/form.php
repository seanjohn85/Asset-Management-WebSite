<!DOCTYPE html>
<html>
<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Branch.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
    ?>
<head>
	<meta charset="UTF-8">
	<title>Sign-Up/Login Form</title>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

	
<?php require 'utils/styles.php'; ?>




</head>

<body>
    <?php require 'functions/firstForm.php'; ?>
<div class="form">
	
		<div id="signup">
			<h1>Sign Up for Free</h1>

			<form action="createBranch.php" method="post" class="pure-form">

				<div class="top-row">
					<div class="field-wrap">
						<label>
							Branch Name<span class="req">*</span>
                                                        <span class="error" id="nameError"><?php error($errors, 'name') ?></span>
						</label>
                                            <input type="text" id="name" name="name" value=""/>
					</div>

					<div class="field-wrap">
						<label>
							Last Name<span class="req">*</span>
						</label>
						<input type="text" required autocomplete="off" />
					</div>
				</div>

				<div class="field-wrap">
					<label>
						Email Address<span class="req">*</span>
					</label>
					<input type="email" required autocomplete="off" />
				</div>

				<div class="field-wrap">
					<label>
						Set A Password<span class="req">*</span>
					</label>
					<input type="password" required autocomplete="off" />
				</div>

				<button type="submit" class="button button-block" />Get Started</button>

			</form>

		</div>



	</div>
	<!-- /form -->
<?php require 'utils/scripts.php'; ?>




</body>

</html>