<?php
session_start();
if (isset($_POST["submit"])) {
    
    $filename = 'registration.txt';

    $nameErr = $emailErr = $passwordErr = $confirm_passwordErr = $password_matchErr = "";
    $name = $email = $password = $confirm_password = "";

    if (empty($_POST["name"])) {
        $nameErr = "This field is required";
    }
    else {
        $name = $_POST["name"];
    }

    if (empty($_POST["email"])) {
        $emailErr = "This field is required";
    }
    else {
        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            $email = $_POST["email"];
        }else{

            $emailErr = "Email is invalid";
        }
            
    }

    if (!isset($_POST["password"])) {
        $passwordErr = "This field is required";
    }
    else {
        $password = $_POST["password"];
    }

    if (empty($_POST["confirm_pasword"])) {
        $confirm_passwordErr = "This field is required";
    }
    else {
        $confirm_password = $_POST["confirm_pasword"];
    }

    if ($_POST["password"] != $_POST["confirm_pasword"]) {
        $password_matchErr = "Password does not match";
    } 


    if(($name && $email && $password && $confirm_password) && ($password_matchErr =='')){
 
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['name'] = $name;


        if (file_exists($filename)) {

            $file = fopen("registration.txt", "a+");
            $details = $email.';'.$password."\n";
            fwrite($file, $details);
            fclose($file);
            $response = array(
                "type" => "success",
                "message" => "You have registered successfully.<br/><a href='login.php' class='btn btn-link'>Now Login</a>."
            );
            //header("Location:login_register.php");
        }else{
            $response = array(
                "type" => "error",
                "message" => "Email already in use."
            );
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script>
    function signupvalidation(){
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_pasword = document.getElementById('confirm_pasword').value;
        var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    	
        var valid=true;

        if(name == ""){
            valid = false;
            document.getElementById('name_error').innerHTML = "required.";
        }

        if(email == ""){
            valid = false;
            document.getElementById('email_error').innerHTML = "required.";
        } else {
            if(!emailRegex.test(email)){
                valid = false;
                document.getElementById('email_error').innerHTML = "invalid.";
            }
        }

        if(password == "" ){
            valid = false;
            document.getElementById('password_error').innerHTML = "required.";
        }
        if(confirm_pasword == "" ){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = "required.";
        }

        if(password != confirm_pasword){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = "Both passwords must be same.";
        }

        return valid;
    }
    </script>
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php
                    if (! empty($response)) {
                        ?>
                    <div class="<?php if($response["type"] == "error") echo "alert alert-danger"; else echo "alert alert-success"; ?>"><?php echo $response["message"]; ?></div>
                    <?php
                    }
                ?>
                <h3 class="center">Registration</h3>
                <form action="" method="POST"
                    onsubmit="return signupvalidation()">
                    <div class="row">
                        <label>Name</label><span id="name_error" class="error"></span>
                        <div>
                            <input type="text" class="form-control" name="name"
                                id="name" placeholder="Enter your name">
                            <?php if(isset($nameErr)) echo "<span>$nameErr</span>"; ?>
                        </div>
                    </div>

                    <div class="row">
                        <label>Email</label><span id="email_error" class="error"></span>
                        <div>
                            <input type="text" name="email" id="email"
                                class="form-control"
                                placeholder="Enter your Email ID">
                            <?php if(isset($emailErr)) echo "<span>$emailErr</span>"; ?>
                        </div>
                    </div>

                    <div class="row">
                        <label>Password</label><span id="password_error" class="error"></span>
                        <div>
                            <input type="Password" name="password" id="password"
                                class="form-control"
                                placeholder="Enter your password">
                            <?php if(isset($passwordErr)) echo "<span>$passwordErr</span>"; ?>
                        </div>
                    </div>

                    <div class="row">
                        <label>Confirm Password</label><span
                            id="confirm_password_error" class="error"></span>
                        <div>
                            <input type="password" name="confirm_pasword"
                                id="confirm_pasword" class="form-control"
                                placeholder="Re-enter your password">
                            <?php if(isset($confirm_passwordErr)) echo "<span>$confirm_passwordErr</span>"; ?>
                        </div>
                    </div>
                    <?php if(isset($password_matchErr)) echo "<span>$password_matchErr</span>"; ?>

                    <div class="row">
                        <div align="center" class="col">
                            <button type="submit" name="submit"
                                class="btn btn-success btn-md bt" role="button">Sign Up</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <a href="login.php"><button type="button" name="submit"
                                class="btn btn-primary btn-md bt" role="button">Login</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>