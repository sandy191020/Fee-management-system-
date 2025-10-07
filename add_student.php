<?php
require 'config.php';
if(!isset($_SESSION['admin_id'])){ header('Location: admin_login.php'); exit; }

if(isset($_POST['add'])){
    $usn    = $conn->real_escape_string($_POST['usn']);
    $name   = $conn->real_escape_string($_POST['name']);
    $branch = $conn->real_escape_string($_POST['branch']);
    $year   = $conn->real_escape_string($_POST['year']);
    $email  = $conn->real_escape_string($_POST['email']);
    $fee    = floatval($_POST['fee']);
    $due    = $conn->real_escape_string($_POST['due_date']);

    $plain = random_password(8);
    $hash  = password_hash($plain, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO students (usn,name,branch,year,email,password,fee_amount,due_date) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssds',$usn,$name,$branch,$year,$email,$hash,$fee,$due);

    if($stmt->execute()){
        $sid = $stmt->insert_id;
        $msg = "✅ Student added. Generated password: <b>$plain</b>";

        // email (demo)
        $emailmsg = "Hello $name,<br>Your account has been created.<br>USN: $usn<br>Password: <b>$plain</b><br>
        Login: http://localhost/demo-fees/student_login.php";
        send_email($email,'Your account created',$emailmsg);

        // add notification
        $stmt2 = $conn->prepare("INSERT INTO notifications (student_id,title,message) VALUES (?,?,?)");
        $title = 'Account Created';
        $message = 'Your account has been created. Check email for credentials.';
        $stmt2->bind_param('iss',$sid,$title,$message);
        $stmt2->execute();
    } else {
        $err = $stmt->error;
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Add Student</h2>
    <?php if(!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(!empty($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>

    <form method="post" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">USN</label>
            <input type="text" name="usn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Branch</label>
            <input type="text" name="branch" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="text" name="year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Fees</label>
            <input type="number" name="fee" class="form-control" required step="0.01">
        </div>
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add Student</button>
    </form>
</body>
</html>
