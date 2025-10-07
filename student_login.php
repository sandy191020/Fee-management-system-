<?php
 // Start the session at the beginning
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve USN and password from the form
    // The input 'name' is now 'usn'
    $usn = $_POST['usn'];
    $password = $_POST['password'];

    // 2. Query the database using USN (which is UNIQUE)
    // Changed: WHERE usn=?
    $sql = "SELECT * FROM students WHERE usn=?";
    $stmt = $conn->prepare($sql);
    // Changed: "s" for string (USN) instead of "i" for integer (ID)
    $stmt->bind_param("s", $usn); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        
        // 3. Verify the hashed password
        if (password_verify($password, $student['password'])) {
            // Changed: Storing student_id in session is usually safer/better for later lookups
            $_SESSION['student_id'] = $student['id'];
            
            // Redirect to the dashboard
            header("Location: student_dashboard.php");
            exit;
        } else {
            $error = "Invalid USN or password";
        }
    } else {
        $error = "Invalid USN or password"; // Generic error for security
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login | VIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS code remains here */
        :root {
            /* New Color Palette for Light Theme */
            --primary-green: #6D9773;   /* Sage Green - Button/Accent */
            --dark-green: #0C3B2E;      /* Dark Forest Green - Text/Shadow */
            --gold-accent: #FFBA00;     /* Bright Gold - Highlight */
            --gold-secondary: #BB8A52;  /* Old Gold - Secondary Text */
            
            --background-light: #f7fff7; /* Very light, soft green background */
            --card-light: #ffffff;      /* Pure white card */
            --text-dark: var(--dark-green); /* Primary text color */
            --input-bg: #f0f8f0;        /* Off-white/lightest green for inputs */
            --input-border: #e0e0e0;
            --error-red: #d9534f;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex; 
            justify-content: center;
            align-items: center;
            
            /* Light, soft green background */
            background-color: var(--background-light);
            color: var(--text-dark);
            transition: background 0.5s ease;
        }
        
        .card-login {
            background-color: var(--card-light);
            padding: 3.5rem 3rem;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            
            /* Soft, subtle shadow for light theme, with a deep green border */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 0 8px rgba(109, 151, 115, 0.4);
            border: 1px solid var(--primary-green);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-login h3 {
            text-align: center;
            margin-bottom: 2.5rem;
            color: var(--dark-green); /* Title in Dark Green */
            font-weight: 700;
            letter-spacing: 1.5px;
            position: relative;
            padding-bottom: 12px;
        }

        /* Title underline in Bright Gold */
        .card-login h3::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            height: 4px;
            width: 70px;
            background-color: var(--gold-accent);
            border-radius: 5px;
        }
        
        .form-label {
            color: var(--dark-green); /* Labels in Dark Green */
            font-weight: 600;
            margin-bottom: 0.6rem;
        }

        /* Input field styling for contrast */
        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--text-dark);
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .form-control::placeholder {
            color: #a3b894; /* Light Sage color for placeholder */
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(109, 151, 115, 0.5); /* Glowing focus in Sage Green */
            background-color: var(--card-light);
            color: var(--text-dark);
        }

        /* Button styling */
        .btn-theme {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: var(--card-light); /* White text on Sage Green button */
            font-weight: 700;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.1s ease, box-shadow 0.3s;
        }

        .btn-theme:hover {
            background-color: var(--dark-green); /* Dark Green on hover */
            border-color: var(--dark-green);
            color: var(--card-dark);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        .btn-theme:active {
            transform: translateY(0);
        }
        
        /* Error alert styling */
        .alert-danger {
            background-color: #f8d7da; /* Light red alert background */
            color: var(--error-red);
            border-color: #f5c6cb;
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="card-login">
        <h3><span style="color: var(--primary-green);">VIT</span> Student Login</h3>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>⚠️ $error</div>"; ?>
        <form method="post">
            <div class="mb-4">
                <label for="studentUsn" class="form-label">USN / Registration Number</label> 
                <input type="text" name="usn" id="studentUsn" class="form-control" placeholder="e.g., 1VI23CD***" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-theme w-100 mt-3">Secure Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>