<?php
    include_once('header.php');
    ?>
   <?php
    if (isset($_POST['form_register'])) {
        try {
            if($_POST['name'] == '')
            {
                throw new Exception("Fullname cannot be empty");
                
            }
            if($_POST['email'] == '')
            {
                throw new Exception("Email cannot be empty");
                
            }
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                throw new Exception("Email is invalid");
                
            }
            $statement = $conn->prepare("SELECT * FROM admins WHERE email=?");
            $statement->execute([$_POST['email']]);
            $total = $statement->rowCount();
            if($total)
            {
                throw new Exception("Email already exists");
                
            }
            if($_POST['password'] == '' || $_POST['retype_password'] == '')
            {
                throw new Exception("Password cannot be empty");
                
            }
            if($_POST['password'] != $_POST['retype_password'])
            {
                throw new Exception("Passwords must match");
                
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $token = time();

            $statement = $conn->prepare("INSERT INTO admins(fullname,email,password,token,status) VALUES (?,?,?,?,?)");
            $statement->execute([$_POST['name'],$_POST['email'],$password,$token,0]);

            header('location: '.ADMIN_URL. 'login.php');

        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
   ?>


 <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box">
                            <div class="card-header card-header-auth">
                                <h4 class="text-center">Admin Register</h4>
                            </div>
                            <?php
                            if(isset($error_message)) {
                                echo '<div class="error">';
                                echo $error_message;
                                echo '</div>';
                            }
                            ?>
                            <div class="card-body card-body-auth">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Enter fullname" value="<?php if(isset($_POST['name'])) {echo $_POST['name']; } ?>" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; } ?>" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"  placeholder="Password" value="<?php if(isset($_POST['password'])) {echo $_POST['password']; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="retype_password"  placeholder="Retype Password" value="<?php if(isset($_POST['retype_password'])) {echo $_POST['retype_password']; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg w_100_p" name="form_register">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>