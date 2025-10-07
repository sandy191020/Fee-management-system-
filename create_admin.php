
<?php
require 'config.php';

if(isset($_POST['create'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admins (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param('sss',$name,$email,$hash);
    if($stmt->execute()){
        $msg = '✅ Admin created successfully. You can now login at <a href="admin_login.php">Admin Login</a>';
    } else {
        $err = $stmt->error;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f6f9fc;
    font-family: 'Poppins', sans-serif;
}
.container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.card {
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    padding: 30px;
}
.btn-theme {
    background-color: #5369f8;
    border: none;
    color: #fff;
}
.btn-theme:hover {
    background-color: #4055d6;
}
h2 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}
.alert {
    margin-bottom: 15px;
}
</style>
</head>
<body>

<div class="container">
    <div class="col-md-6">
        <div class="card">
            <h2>Create Admin</h2>
            <?php if(!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
            <?php if(!empty($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control" placeholder="Enter full name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <button name="create" class="btn btn-theme w-100">Create Admin</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

