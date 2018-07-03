<?php
session_start();
if (isset($_POST["submit"])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // $saved_email = $_SESSION['email'];
    // $name = $_SESSION['name'];



    $file = file('registration.txt');

    foreach ($file as $key => $value) {
        
        $details = explode(';',$value);
        $login = 0;

        if($details[0] == $email && trim($details[1]) == $password){
            $login = 1;
            break;
        }
    }


    if ($login) {
        header( 'Location: dashboard.php' );
    }else{
        $response = array(
            "type" => "error",
            "message" => "Invalid Email and Password."
        );
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script>
            function loginvalidation(){
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;

                var valid = true;

                if(email == ""){
                	   valid = false;
                    document.getElementById('email_error').innerHTML = "required.";
                }

                if(password == ""){
                	   valid = false;
                    document.getElementById('password_error').innerHTML = "required.";
                }
                return valid;
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h3 class="center">Login</h3>
                    <form action="" method="POST"
                        onsubmit="return loginvalidation();">

                        <?php
                        if (! empty($response)) {
                            ?>
                        <div class="alert alert-danger"><?php echo $response["message"]; ?></div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <label>Email</label> <span id="email_error" class="error"></span>
                            <div>
                                <input type="text" name="email" id="email"
                                    class="form-control"
                                    placeholder="Enter your Email ID">
                            </div>
                        </div>

                        <div class="row">
                            <label>Password</label><span id="password_error" class="error"></span>
                            <div>
                                <input type="Password" name="password" id="password"
                                    class="form-control"
                                    placeholder="Enter your password">

                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <button type="submit" name="submit"
                                    class="btn btn-success login bt">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <a href="index.php"><button type="button"
                                        name="submit" class="btn btn-primary signup bt">Signup</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>