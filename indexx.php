<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCAI Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #5e72e4;
            --card-bg: rgba(255, 255, 255, 0.07);
            --card-border: rgba(255, 255, 255, 0.1);
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            font-family: 'Inter', sans-serif;
            color: white;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path fill="%235e72e4" d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-45.8C87.4,-32.6,90,-16.3,88.5,-0.9C87,14.6,81.4,29.2,74.1,43.2C66.7,57.2,57.6,70.6,44.7,77.9C31.8,85.3,15.9,86.6,0.6,85.6C-14.6,84.7,-29.2,81.4,-43.2,74.9C-57.2,68.4,-70.6,58.6,-77.9,45.3C-85.3,32,-86.6,16,-85.6,-0.6C-84.7,-17.1,-81.4,-34.2,-74.9,-49.9C-68.4,-65.6,-58.6,-79.8,-45.3,-85.3C-32,-90.8,-16,-87.6,-0.3,-87.1C15.4,-86.6,30.7,-83.7,44.7,-76.4Z" transform="translate(100 100) scale(0.3)"/></svg>') 0 0/100% 100%,
                        linear-gradient(135deg, #0f172a, #1e293b);
            opacity: 0.05;
            z-index: 0;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, 15px); }
            100% { transform: translate(0, -0px); }
        }

        .glow {
            position: absolute;
            width: 800px;
            height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(94,114,228,0.2) 0%, rgba(94,114,228,0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        .glow-1 { top: -400px; left: -200px; }
        .glow-2 { bottom: -400px; right: -200px; }

        .portal-card {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--card-border);
            border-radius: 1.5rem;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .portal-card:hover {
            transform: translateY(-8px) scale(1.01);
            border-color: var(--primary-color);
            box-shadow: 0 20px 40px rgba(94, 114, 228, 0.15);
        }

        .portal-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: var(--primary-color);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .portal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .portal-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .btn-portal {
            background: linear-gradient(135deg, var(--primary-color), #4558c4);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(94, 114, 228, 0.2);
        }

        .btn-portal:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(94, 114, 228, 0.4);
        }

        .logo {
            width: auto;
            height: 100px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));
        }

        .developer-credits {
            position: relative;
            margin-top: 4rem;
            padding: 0.75rem 2rem;
            background: rgba(14, 21, 37, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
        }

        .developer-credits::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 100px;
            padding: 2px;
            background: linear-gradient(90deg, #5e72e4, #825ee4);
            -webkit-mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        .developer-credits p {
            margin: 0;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .developer-credits i {
            color: #5e72e4;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .glow { display: none; }
            .portal-card { margin-bottom: 1rem; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
    
    <div class="container min-vh-100 d-flex align-items-center py-5">
        <div class="w-100">
            <div class="text-center mb-5">
                <img src="assets/ccai-logo.png" alt="CCAI Logo" class="logo floating">
                <h1 class="display-4 fw-bold mb-3">CCAI Student Portal</h1>
                <p class="lead text-white-50 mb-5">Access your academic information securely</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="portal-card h-100">
                        <div class="portal-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h3 class="portal-title">Student Access</h3>
                        <p class="portal-text">View your grades, academic progress, and personal information.</p>
                        <a href="student/login.php" class="btn btn-portal w-100">Student Login</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">      
                <p class="text-white-50">Are you an Adviser or Admin? <a href="staff.php" class="text-primary">Click here</a></p>
            </div>
            
            <div class="text-center mt-5">
                <div class="developer-credits">
                    <p>
                        <i class="bi bi-code-slash"></i>
                        Developed by Rhaycee Bersabe & Charles del Rosario
                    </p>
                </div>
            </div>
            
            <footer class="text-center mt-4">
                <p class="small text-white-50">&copy; <?php echo date('Y'); ?> CCAI. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
