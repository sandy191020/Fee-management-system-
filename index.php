<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vemana Institute of Technology</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variables */
        :root {
            --primary-color: #004d99; /* Deep Professional Blue */
            --secondary-color: #ffc300; /* Gold/Yellow Accent */
            --text-dark: #333;
            --text-light: #f4f4f4;
            --bg-light: #ffffff;
            --bg-mid: #f0f4f8; /* Light gray-blue for contrast */
            --bg-dark: #1a1a1a; /* Near Black for Header/Footer */
        }

        /* General Reset & Typography */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-light);
            overflow-x: hidden;
        }

        /* Utility Classes */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }
        .text-center {
            text-align: center;
        }
        .section-padding {
            padding: 80px 0;
        }

        /* --- BACKGROUND REMOVED --- */

        /* Header & Navigation */
        header {
            position: sticky;
            top: 0;
            width: 100%;
            background: var(--bg-dark); 
            padding: 15px 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }
        header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary-color);
        }
        nav a {
            color: var(--text-light);
            margin-left: 25px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: var(--primary-color);
        }
        /* Style for the Sign In link as a call-to-action in the nav */
        nav a[href="student_login.php"] {
            background-color: var(--primary-color);
            padding: 8px 15px;
            border-radius: 5px;
            margin-left: 30px;
        }
        nav a[href="student_login.php"]:hover {
            background-color: var(--secondary-color);
            color: var(--bg-dark);
        }


        /* Hero Section (Solid Color Background) */
        .hero {
            /* Using a minimum height to ensure a full screen on most desktops */
            min-height: calc(100vh - 80px); /* Adjust for header height */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            
            /* NEW: Solid Color Background for clean look */
            background: var(--bg-mid); 
            color: var(--text-dark);
            padding-top: 80px; /* Offset for sticky header */
        }
        .hero-content {
            max-width: 900px;
            padding: 40px;
        }
        .hero h2 {
            font-size: 3.8rem;
            margin-bottom: 15px;
            font-weight: 700;
            color: var(--primary-color);
        }
        .hero p {
            font-size: 1.4rem;
            margin-bottom: 40px;
            font-weight: 400;
            color: var(--text-dark);
        }
        .hero .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px;
            background: var(--secondary-color);
            color: var(--bg-dark);
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }
        .hero .btn:hover {
            background: var(--primary-color);
            color: var(--text-light);
            transform: translateY(-2px);
        }

        /* Section Headings */
        h2 {
            font-size: 2.2rem;
            margin-bottom: 40px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
        }

        /* About Section (White Background Card) */
        #about {
            background-color: var(--bg-light);
            padding: 80px 0;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05) inset;
        }
        .about-text {
            max-width: 900px;
            margin: auto;
            padding: 30px;
        }
        .about-text p {
            font-size: 1.05rem;
            margin-bottom: 20px;
            color: var(--text-dark);
            text-align: justify;
        }

        /* Contact Section (High Contrast Blue) */
        #contact {
            background: var(--primary-color);
            padding: 80px 0;
            color: var(--text-light);
        }
        #contact h2 {
            color: var(--secondary-color);
        }
        #contact form {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background: var(--bg-light); /* White Form Area */
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        #contact input, #contact textarea {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            color: var(--text-dark);
        }
        #contact input:focus, #contact textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
        }
        #contact button {
            width: 100%;
            padding: 15px;
            background: var(--secondary-color);
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
            margin-top: 10px;
        }
        #contact button:hover {
            background: #e6b800;
            transform: translateY(-1px);
        }

        /* Footer */
        footer {
            background: var(--bg-dark);
            color: var(--text-light);
            text-align: center;
            padding: 30px 0;
        }
        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <header>
        <div class="header-content">
            <h1>VIT</h1>
            <nav>
                <a href="#about">About Us</a>
                <a href="#contact">Contact Us</a>
                <a href="student_login.php">Sign In</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Vemana Institute of Technology</h2>
            <p>Empowering future engineers through innovation, research, and excellence.</p>
            <a href="student_login.php" class="btn">Student Sign In</a>
            <a href="admin_login.php" class="btn">Admin Sign In</a>
        </div>
    </section>

    <section id="about" class="section-padding">
        <div class="container">
            <h2 class="text-center">About Us</h2>
            <div class="about-text">
                <p>
                    Vemana Institute of Technology (VIT) is a premier institute established in 1999 by the Karnataka Reddy Jana Sangha. Named after the saint and social reformer Mahayogi Vemana, the institute aims to provide **quality technical education** and foster innovation among students.
                </p>
                <p>
                    VIT offers undergraduate and postgraduate programs in various engineering disciplines, including **Computer Science, Electronics, Mechanical, Civil, and Artificial Intelligence**. The campus is equipped with state-of-the-art laboratories, research centers, and industry collaborations to enhance the learning experience and prepare students for a global career.
                </p>
            </div>
        </div>
    </section>

    <section id="contact" class="section-padding">
        <div class="container text-center">
            <h2>Get In Touch</h2>
            <form action="submit_form.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 Vemana Institute of Technology. All Rights Reserved. | Designed for clarity and professionalism.</p>
        </div>
    </footer>

</body>
</html>