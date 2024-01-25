<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/login.css">


<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<title>Login & Registration Form | CoderGirl</title>-->
    <!---Custom CSS File--->
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>

    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Register</header>
            <form method="POST" action="<?php echo URLROOT; ?>/Users/register">
                <input type="text" name="name" placeholder="UserName">
                <input type="text" name="phone_number" placeholder="Phone Number">
                <input type="text" name="email" placeholder="Your email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" class="button" value="Register">
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <a href="<?php echo URLROOT; ?>/pages/login">Login</a>
                </span>
            </div>
        </div>
    </div>

</body>

</html>