<?php 
include 'Connection.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function displayFlashMessage() {

    if (isset($_SESSION['flash_message'])) {
        $type = isset($_SESSION['flash_type']) ? $_SESSION['flash_type'] : 'success';
        $msg  = $_SESSION['flash_message'];
 
        echo '<div class="container mt-4">
                <div class="alert alert-'.$type.' alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
        
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Expert System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c7a3f;
            --secondary-color: #5cb85c;
            --accent-color: #f0f9f0;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            color: #fff !important;
            font-weight: 600;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #236832 0%, #4a9a4a 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 122, 63, 0.3);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 50px 50px;
            margin-bottom: 40px;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                Expert System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="bi bi-house-door me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'symptoms.php' ? 'active' : ''; ?>" href="symptoms.php">
                            <i class="bi bi-list-check me-1"></i>Symptom Data
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'consultation.php' ? 'active' : ''; ?>" href="consultation.php">
                            <i class="bi bi-clipboard2-pulse me-1"></i>Consultation
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <?php displayFlashMessage(); ?>