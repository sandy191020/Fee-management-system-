<?php
require 'config.php';
if(!isset($_SESSION['admin_id'])){ header('Location: admin_login.php'); exit; }

$id = intval($_GET['id'] ?? 0);
if(!$id) exit('Invalid student');

// Fetch current student details
$res = $conn->query("SELECT * FROM students WHERE id=$id");
if(!$res || $res->num_rows == 0) exit('Student not found');
$student = $res->fetch_assoc();

// Save changes
if(isset($_POST['save'])){
    $name   = $conn->real_escape_string($_POST['name']);
    $branch = $conn->real_escape_string($_POST['branch']);
    $year   = $conn->real_escape_string($_POST['year']);
    $email  = $conn->real_escape_string($_POST['email']);
    $fee    = floatval($_POST['fee']);
    $due    = $conn->real_escape_string($_POST['due_date']);

    $stmt = $conn->prepare("UPDATE students SET name=?, branch=?, year=?, email=?, fee_amount=?, due_date=? WHERE id=?");
    $stmt->bind_param('ssssdis', $name, $branch, $year, $email, $fee, $due, $id);

    if($stmt->execute()){
        $msg = "✅ Student details updated successfully.";
        // refresh student data
        $res = $conn->query("SELECT * FROM students WHERE id=$id");
        $student = $res->fetch_assoc();
    } else {
        $err = $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Student</h2>
    <?php if(!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(!empty($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>

    <form method="post" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">USN</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['usn']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($student['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Branch</label>
            <input type="text" name="branch" class="form-control" value="<?php echo htmlspecialchars($student['branch']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="text" name="year" class="form-control" value="<?php echo htmlspecialchars($student['year']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Fees</label>
            <input type="number" name="fee" class="form-control" value="<?php echo htmlspecialchars($student['fee_amount']); ?>" required step="0.01">
        </div>
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo htmlspecialchars($student['due_date']); ?>" required>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</body>
</html>
