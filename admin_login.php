<?php
require 'config.php';
$err = '';
if(isset($_POST['login'])){
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM admins WHERE email='$email' LIMIT 1");
    if($res && $res->num_rows){
        $a = $res->fetch_assoc();
        if(password_verify($pass, $a['password'])){
            $_SESSION['admin_id'] = $a['id'];
            header('Location: admin_dashboard.php'); 
            exit;
        }
    }
    $err = 'Invalid credentials';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - VIT</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    margin-top:20px;
    background: #f6f9fc;
}
.card {
    min-height: 550px; /* make the card taller */
    border-radius: 10px;
    overflow: hidden;
}
.account-block {
    padding: 0;
    background: url('57814.jpg') no-repeat center center/cover;
    height: 100%;
    min-height: 550px; /* ensure right panel is same height as card */
    position: relative;
}
.account-block .overlay {
    flex: 1;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.2);
}
.text-theme {
    color: #5369f8 !important;
}
.btn-theme {
    background-color: #5369f8;
    border-color: #5369f8;
    color: #fff;
}
</style>
</head>
<body>
<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <!-- Login Form -->
                        <div class="col-lg-6">
                            <div class="p-5 h-100 d-flex flex-column justify-content-center">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                </div>
                                <h6 class="h5 mb-0">Welcome back!</h6>
                                <p class="text-muted mt-2 mb-5">Enter your email address and password to access admin panel.</p>
                                <?php if(!empty($err)) echo '<div class="alert alert-danger">'.$err.'</div>'; ?>
                                <form method="post">
                                    <div class="form-group mb-3">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-theme w-100">Login</button>
                                </form>
                            </div>
                        </div>
                        <!-- Right Panel Image -->
                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
