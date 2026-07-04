<?php
    require_once('db_connect.php');

    // Add error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Add selected year handling
    $selectedYear = isset($_GET['school_year']) ? $_GET['school_year'] : date('Y') . '-' . (date('Y') + 1);

    // Update queries to filter by school year
    $jhsQuery = $pdo->prepare("SELECT * FROM student_population WHERE level = 'JHS' AND school_year = ? ORDER BY grade_level, section");
    $jhsQuery->execute([$selectedYear]);
    $jhsData = $jhsQuery->fetchAll(PDO::FETCH_ASSOC);

    $shsQuery = $pdo->prepare("SELECT * FROM student_population WHERE level = 'SHS' AND school_year = ? ORDER BY grade_level, strand, section");
    $shsQuery->execute([$selectedYear]);
    $shsData = $shsQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fix JHS totals query
    $jhsTotalsStmt = $pdo->prepare("SELECT 
        SUM(male_count) as total_male,
        SUM(female_count) as total_female,
        SUM(male_count + female_count) as total
        FROM student_population 
        WHERE level = 'JHS' AND school_year = ?");
    $jhsTotalsStmt->execute([$selectedYear]);
    $jhsTotals = $jhsTotalsStmt->fetch(PDO::FETCH_ASSOC);

    // Fix SHS Grade 11 totals query
    $shs11TotalsStmt = $pdo->prepare("SELECT 
        SUM(male_count) as total_male,
        SUM(female_count) as total_female,
        SUM(male_count + female_count) as total
        FROM student_population 
        WHERE level = 'SHS' AND grade_level = 'Grade 11' AND school_year = ?");
    $shs11TotalsStmt->execute([$selectedYear]);
    $shs11Totals = $shs11TotalsStmt->fetch(PDO::FETCH_ASSOC);

    // Fix SHS Grade 12 totals query
    $shs12TotalsStmt = $pdo->prepare("SELECT 
        SUM(male_count) as total_male,
        SUM(female_count) as total_female,
        SUM(male_count + female_count) as total
        FROM student_population 
        WHERE level = 'SHS' AND grade_level = 'Grade 12' AND school_year = ?");
    $shs12TotalsStmt->execute([$selectedYear]);
    $shs12Totals = $shs12TotalsStmt->fetch(PDO::FETCH_ASSOC);

    // Calculate grand total
    $grandTotal = ($jhsTotals['total'] ?? 0) + ($shs11Totals['total'] ?? 0) + ($shs12Totals['total'] ?? 0);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
        
        <title>Students | Cavite Community Academy, Inc.</title>
        <link rel="shortcut icon" href="ccai-logo.png" type="image/svg+xml" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <style>
        .org-section {
                padding: 4rem 0;
                background: #f8f9fa;
            }

            .org-title {
                color: #000080;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 3rem;
                text-align: center;
                animation: headShake 2s ease-in-out infinite;
            }

            .org-card {
                background: #DEE7E7;
                border-radius: 15px;
                overflow: hidden;
                margin-bottom: 2rem;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                transition: transform 0.3s ease;
                border: none;
                height: 100%;
                transition: all 0.3s ease-in-out;
            }

            .org-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            }

            .org-card .card-img-top {
                height: 200px;
                object-fit: cover;
            }

            .org-card .card-body {
                padding: 2rem;
            }

            .org-card .card-title {
                color: #000080;
                font-weight: bold;
                margin-bottom: 1rem;
            }

            .org-card .card-text {
                color: #444;
                text-align: justify;
                line-height: 1.6;
            }

            .org-members {
                margin-top: 1rem;
                font-size: 0.9rem;
                color: #666;
            }

            .badge {
                padding: 0.5rem 1rem;
                margin-right: 0.5rem;
                font-weight: normal;
                transition: all 0.3s ease;
            }

            .org-card:hover .badge {
                transform: scale(1.1);
            }

            .view-members-btn {
                cursor: pointer !important;
                background: #000080 !important;
                color: white !important;
                border: none !important;
                padding: 1rem 2rem !important;
                border-radius: 25px !important;
                transition: all 0.3s ease !important;
                margin-top: 1.5rem !important;
                width: 100% !important;
                font-size: 1rem !important;  /* Added for better readability */
                letter-spacing: 0.5px !important;  /* Added for better text spacing */
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 8px !important;
            }

            .view-members-btn:hover {
                background: #4040a1 !important; /* Lighter blue for hover */
                transform: translateY(-2px) !important;
                box-shadow: 0 5px 15px rgba(0, 0, 128, 0.3) !important;
                color: white !important;
            }

            .view-members-btn:active {
                transform: translateY(0) !important;
                box-shadow: 0 2px 8px rgba(0, 0, 128, 0.2) !important;
            }

            .view-members-btn:focus {
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(0, 0, 128, 0.3) !important;
            }

            .view-members-btn:disabled {
                background: #cccccc !important;
                cursor: not-allowed !important;
                transform: none !important;
            }

            /* Add loading state */
            .view-members-btn.loading {
                position: relative !important;
                opacity: 0.8 !important;
                cursor: wait !important;
            }

            @keyframes headShake {
                0% { transform: translateX(0); }
                6.5% { transform: translateX(-6px) rotateY(-9deg); }
                18.5% { transform: translateX(5px) rotateY(7deg); }
                31.5% { transform: translateX(-3px) rotateY(-5deg); }
                43.5% { transform: translateX(2px) rotateY(3deg); }
                50% { transform: translateX(0); }
            }

            /* Modal styles */
            .modal-content {
                border-radius: 15px;
                border: none;
            }

            .modal-header {
                background: #000080;
                color: white;
                border-radius: 15px 15px 0 0;
            }

            .btn-close {
                filter: brightness(0) invert(1);
            }
        main {
        padding-top: 20px; /* Reduced padding since navbar is not fixed */
        padding-left: 0px;
        padding-right: 0px;
        transition: padding-top 0.8s ease-out;
        }
        .navbar {
        animation: navbarSlideDown 0.8s ease-out forwards;
        position: relative; /* Changed from fixed to relative */
        z-index: 1030;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }
        .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.5) !important;
        }
        @media (max-width: 768px) {
            .navbar-brand .full-text {
                display: none;
            }
            .navbar-brand .short-text {
                display: inline;
            }
        }
        @media (min-width: 769px) {
            .navbar-brand .full-text {
                display: inline;
            }
            .navbar-brand .short-text {
                display: none;
            }
        }

        .card {
            opacity: 0;
            animation: cardReveal 1.2s ease-out forwards;
            transform-style: preserve-3d;
            perspective: 1000px;
            background-color: #DEE7E7;
            border: none;
            box-shadow: 
                0 10px 10px rgba(0, 0, 0, 0.15),
                0 0 60px rgba(0, 0, 0, 0.1),
                0 4px 3px rgba(0, 0, 0, 0.1);
        }

        @keyframes cardReveal {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            50% {
                opacity: 1;
                transform: translateY(-10px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Remove individual card delays */
        .col .card {
            animation-delay: 0s !important;
        }

        .card:hover {
            transform: translateY(-15px) rotateX(5deg);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.2),
                0 15px 20px rgba(0, 0, 0, 0.15),
                0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .card:hover::after {
            opacity: 1;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1));
            pointer-events: none;
        }

        .card-header {
            border-bottom: 2px solid rgba(130, 192, 204, 0.3);
            background-color: transparent;
        }

        .card:hover .card-header {
                background-color:rgb(202, 202, 211);
            border-bottom: 2px solid #82C0CC;
        }

        .card-body {
            transition: all 0.3s ease;
        }

        .card:hover .card-title {
            color: #000080;
        }

        @media (max-width: 768px) {
            .card:hover {
                transform: translateY(-5px); /* Smaller lift on mobile */
            }
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .card {
                animation: none;
                transition: none;
                transform: none !important;
            }
        }

        @keyframes headShake {
            0% {
                transform: translateX(0);
            }
            6.5% {
                transform: translateX(-6px) rotateY(-9deg);
            }
            18.5% {
                transform: translateX(5px) rotateY(7deg);
            }
            31.5% {
                transform: translateX(-3px) rotateY(-5deg);
            }
            43.5% {
                transform: translateX(2px) rotateY(3deg);
            }
            50% {
                transform: translateX(0);
            }
        }

        .headshake-title {
            animation: headShake 2s ease-in-out infinite;
            display: inline-block;
            color: #000080;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            .headshake-title {
                animation: none;
            }
        }

        @keyframes navbarSlideDown {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .navbar {
                animation: none;
            }
        }

        /* Navigation hover effects */
        .nav-link, .dropdown-item {
            position: relative;
            transition: all 0.3s ease;
            transform-origin: center;
            color: ;
            text-decoration: none !important;
        }

        .nav-link:hover, .dropdown-item:hover {
            transform: scale(1.1);
            color: #82C0CC !important;
            text-shadow: 0 0 10px rgba(130, 192, 204, 0.3);
        }

        /* Dropdown styling */
        .dropdown-menu {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            margin: 0.2rem 0;
            border-radius: 4px;
        }

        .dropdown-item:hover {
            background-color: rgba(130, 192, 204, 0.1);
            transform: scale(1.05) translateX(5px);
        }

        /* Active state */
        .nav-link.active {
            color: #82C0CC !important;
            transform: scale(1.05);
        }

        /* Dropdown animation */
        .dropdown-menu.show {
            animation: dropdownZoom 0.3s ease-out;
        }

        @keyframes dropdownZoom {
            0% {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Home link hover effect */
        .nav-item .nav-link.active.text-white {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        .nav-item .nav-link.active.text-white:hover {
            transform: scale(1.2);
            color: #82C0CC !important;
            text-shadow: 0 0 15px rgba(130, 192, 204, 0.4);
        }

        .nav-item .nav-link.active.text-white::after {
            display: none;
        }

        .nav-link::after, 
        .dropdown-item::after,
        .nav-item .nav-link.active.text-white::after {
            display: none;
        }

        /* Keep other hover effects */
        .nav-item .nav-link.active.text-white:hover {
            transform: scale(1.2);
            color: #82C0CC !important;
            text-shadow: 0 0 15px rgba(130, 192, 204, 0.4);
        }

        @media (max-width: 998px) {
            .navbar-collapse {
                position: fixed;
                top: 56px;
                left: -100%;
                width: 330px;
                height: calc(100vh - 56px);
                background-color: #000080;
                transition: all 0.4s ease-in-out;
                padding: 1rem;
                overflow-y: auto;
                z-index: 1029;
            }

            .navbar-collapse.show {
                left: 0;
            }

            .navbar-nav {
                text-align: left;
            }

            .nav-item {
                opacity: 0;
                transform: translateX(-50px);
                transition: all 0.3s ease-in-out;
            }

            .navbar-collapse.show .nav-item {
                opacity: 1;
                transform: translateX(0);
            }

            .nav-link, .dropdown-item {
                text-align: left;
                padding-left: 1.5rem;
                transition: all 0.3s ease-in-out;
            }

            .dropdown-menu {
                background-color: rgba(255, 255, 255, 0.95);
                margin-left: 1rem;
                width: 90%;
                text-align: left;
                border-radius: 4px;
            }

            .dropdown-item {
                padding: 0.8rem 1rem;
            }

            .dropdown-item:hover {
                transform: translateX(10px);
                padding-left: 1.8rem;
            }

            /* Staggered animation delays */
            .navbar-collapse.show .nav-item:nth-child(1) { transition-delay: 0.1s; }
            .navbar-collapse.show .nav-item:nth-child(2) { transition-delay: 0.15s; }
            .navbar-collapse.show .nav-item:nth-child(3) { transition-delay: 0.2s; }
            .navbar-collapse.show .nav-item:nth-child(4) { transition-delay: 0.25s; }
            .navbar-collapse.show .nav-item:nth-child(5) { transition-delay: 0.3s; }
            .navbar-collapse.show .nav-item:nth-child(6) { transition-delay: 0.35s; }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                display: flex !important;
                align-items: center !important;
                margin-right: 0 !important;
            }

            .navbar-brand img {
                width: 35px;
                height: 35px;
                margin-right: 8px;
            }

            .navbar-brand .short-text {
                display: inline-block !important;
                font-size: 1.25rem;
                margin-left: 5px;
                padding-top: 2px;
            }

            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }

            .navbar-toggler {
                margin-left: auto;
                padding: 4px 8px;
            }
        }

        /* Logo sizing for all screens */
        .navbar-brand img {
            width: 45px;
            height: 45px;
            transition: all 0.3s ease;
        }

        /* Desktop specific styles */
        @media (min-width: 769px) {
            .navbar-brand {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .navbar-brand img {
                width: 50px;
                height: 50px;
            }

            .navbar-brand .full-text {
                font-size: 1.4rem;
            }
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .navbar-brand {
                display: flex !important;
                align-items: center !important;
                gap: 8px;
            }

            .navbar-brand img {
                width: 40px;
                height: 40px;
            }

            .navbar-brand .short-text {
                font-size: 1.3rem;
                padding-top: 2px;
            }
        }

        /* Facilities section styles */
        .facilities-section {
            padding: 4rem 0;
            background-color: #f8f9fa;
            margin-top: 3rem;
            text-align: center;
        }

        .facilities-title {
            color: #000080;
            text-align: center;
            margin-bottom: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: inline-block;
            margin: 0 auto 3rem auto;
            position: relative;
            width: 100%;
        }

        .facility-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: #DEE7E7;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .facility-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .facility-card .card-body {
            padding: 1.5rem;
        }

        .facility-card .card-title {
            color: #000080;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .facilities-section {
                padding: 2rem 0;
            }
            
            .facility-img {
                height: 150px;
            }
        }

        /* Updated Facilities section styles */
        .facility-card {
            opacity: 0;
            animation: cardReveal 1.2s ease-out forwards;
            transform-style: preserve-3d;
            perspective: 1000px;
            background-color: #DEE7E7;
            border: none;
            box-shadow: 
                0 10px 10px rgba(0, 0, 0, 0.15),
                0 0 60px rgba(0, 0, 0, 0.1),
                0 4px 3px rgba(0, 0, 0, 0.1);
        }

        .facility-card:hover {
            transform: translateY(-15px) rotateX(5deg);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.2),
                0 15px 20px rgba(0, 0, 0, 0.15),
                0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .facility-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .facility-card:hover::after {
            opacity: 1;
        }

        .facilities-title {
            animation: headShake 2s ease-in-out infinite;
            display: inline-block;
            color: #000080;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @media (max-width: 768px) {
            .facility-card:hover {
                transform: translateY(-5px);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .facility-card {
                animation: none;
                transition: none;
                transform: none !important;
            }
            .facilities-title {
                animation: none;
            }
        }

        /* Group hover effect styles */
        .facilities-row:hover .facility-img,
        .facilities-row:hover .card-title,
        .facilities-row:hover .card-text {
            filter: blur(3px);
            opacity: 0.7;
            transition: all 0.5s ease;
        }

        /* Remove blur when hovering specific elements */
        .facility-card:hover .facility-img,
        .facility-card:hover .card-title,
        .facility-card:hover .card-text {
            filter: blur(0) !important;
            opacity: 1 !important;
        }

        .facility-card .card-body:hover ~ .facility-img {
            filter: blur(0) !important;
            opacity: 1 !important;
        }

        /* Enhanced transitions */
        .facility-img,
        .card-title,
        .card-text {
            transition: all 0.5s ease;
            position: relative;
            z-index: 1;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Adjust scroll offset for fixed navbar */
        #facilities {
            scroll-margin-top: 20px; /* Reduced scroll margin since navbar is not fixed */
        }

        .news-section {
            padding: 4rem 0;
            background-color: #fff;
            margin-top: 2rem;
        }

        .news-title {
            color: #000080;
            margin-bottom: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .news-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .news-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-img {
            transform: scale(1.1);
        }

        .news-date {
            color: #666;
            font-size: 0.9rem;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .footer {
            background-color: #000080;
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 3rem;
            animation: footerSlideUp 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #82C0CC, transparent);
            animation: footerShimmer 2s linear infinite;
        }

        @keyframes footerSlideUp {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes footerShimmer {
            100% {
                left: 100%;
            }
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out forwards;
            transform-origin: bottom;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-section {
            opacity: 0;
            animation: sectionFadeIn 0.5s ease-out forwards;
        }

        .footer-section:nth-child(1) { animation-delay: 0.2s; }
        .footer-section:nth-child(2) { animation-delay: 0.4s; }
        .footer-section:nth-child(3) { animation-delay: 0.6s; }

        @keyframes sectionFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0;
            animation: bottomFadeIn 0.5s ease-out 0.8s forwards;
        }

        @keyframes bottomFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .social-links {
            margin-bottom: 1rem;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: #82C0CC;
            transform: translateY(-3px);
        }

        .contact-info {
            margin-bottom: 1rem;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }

        .contact-info i {
            margin-right: 10px;
            color: #82C0CC;
        }

        .footer .container {
            max-width: 100%;
            padding: 0 5rem;
        }

        @media (max-width: 768px) {
            .footer .container {
                padding: 0 2rem;
            }
        }

        .footer-links a {
            color: #FFFFFF; /* Sets initial color to slightly transparent white */
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .footer-links a:hover {
            color: #82C0CC;
            transform: translateX(5px);
            text-shadow: 0 0 10px rgba(130, 192, 204, 0.3);
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #82C0CC;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .footer-links a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Registration Form Section Styles */
        .registration-section {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .registration-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: containerFadeIn 0.8s ease-out;
            transform-style: preserve-3d;
        }

        @keyframes containerFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .registration-title {
            color: #000080;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: headShake 2s ease-in-out infinite;
            display: inline-block;
        }

        @media (prefers-reduced-motion: reduce) {
            .registration-title {
                animation: none;
            }
        }

        .registration-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #82C0CC;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .download-btn {
            background: #000080;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 250px;
        }

        .download-btn:hover {
            background: #82C0CC;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .download-btn i {
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .download-btn:hover i {
            transform: translateY(-2px);
        }

        .registration-info {
            text-align: center;
            color: #666;
            margin-top: 2rem;
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .registration-section {
                padding: 2rem 1rem;
            }

            .registration-container {
                padding: 1.5rem;
            }

            .registration-title {
                font-size: 1.8rem;
            }

            .download-btn {
                width: 100%;
                padding: 0.8rem 1.5rem;
            }
        }

        /* Registration Grid Styles */
        .registration-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .registration-container {
            max-width: 100%;
            margin: 0;
            background-color: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: containerFadeIn 0.8s ease-out;
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .registration-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        @media (max-width: 768px) {
            .registration-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
        }

        /* Add these QR code responsive styles */
        .qr-code {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
        }

        .qr-code img {
            width: 150px;
            height: 150px;
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .qr-code {
                padding: 0.5rem 0;
            }
            
            .qr-code img {
                width: 120px;
                height: 120px;
            }
        }

        /* Logo animations */
        .navbar-brand img {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .navbar-brand img.wiggling {
            animation: wiggle 0.5s ease-in-out;
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg) scale(1.1); }
            50% { transform: rotate(10deg) scale(1.1); }
            75% { transform: rotate(-10deg) scale(1.1); }
        }

        .logo-bounce {
            animation: bounce 0.5s cubic-bezier(0.36, 0, 0.66, -0.56) alternate infinite;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }
    </style>
    <body>
    


        <nav class="navbar navbar-expand-lg" style="background-color: #000080;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="home.php">
                <img src="ccai-logo.png" alt="CCAI Logo" class="d-inline-block">
                <span class="full-text">Cavite Community Academy, Inc.</span>
                <span class="short-text">CCAI</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
            <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 600px;">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    About
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="about.php">Vision, Mission, Core Values</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="about.php#org-chart">Organizational Chart</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Life@CCAI
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="life@cca.php#home">Strand Offerings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="life@cca.php#facilities">Academy Facilities</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="life@cca.php">CCAI Hymn</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link active text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Students
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="http://ccai-portal.free.nf" targer="b-_blank">Student Portal</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="studentorg.php">Student Orgranizations</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="student.php">Enrolled Students</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Services
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="event.php">CCAI Events</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="services.php#registration">Downloadable Forms</a></li>
                </ul>
                </li>
            
            </ul>
            
            </div>
        </div>
        </nav>

    <main>
        <section class="org-section">
            <div class="container">
                <h1 class="org-title">Student Organizations</h1>
                <div class="row g-4">
                    <?php
                        $stmt = $pdo->query("SELECT * FROM student_organizations");
                        $orgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (empty($orgs)): ?>
                            <div class="col-12 text-center">
                                <div class="alert alert-info" role="alert">
                                    <i class="fa fa-info-circle me-2"></i>
                                    No available organization
                                </div>
                            </div>
                        <?php else:
                            foreach ($orgs as $org) {
                                $tags = json_decode($org['category_tags'], true);
                                $members = json_decode($org['members_data'], true);
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card org-card">
                                <img src="org-<?php echo strtolower(str_replace(' ', '-', $org['name'])); ?>.jpg" class="card-img-top" alt="<?php echo htmlspecialchars($org['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($org['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($org['description']); ?></p>
                                    <div class="mt-3">
                                        <?php foreach ($tags as $tag): ?>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <p class="org-members"><i class="fa fa-users"></i> <?php echo $org['member_count']; ?> members</p>
                                </div>
                            </div>
                            <!-- Separated button -->
                            <button type="button" 
                                class="btn btn-primary view-members-btn mt-3" 
                                data-bs-toggle="modal"
                                data-bs-target="#membersListModal"
                                data-org-name="<?php echo htmlspecialchars($org['name']); ?>"
                                data-members='<?php echo htmlspecialchars(json_encode($members)); ?>'>
                                <span>View Members List</span>
                            </button>
                        </div>
                    <?php } endif; ?>
                </div>

                <!-- Members List Modal -->
                <div class="modal fade" id="membersListModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Organization Members</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Grade Level</th>
                                        </tr>
                                    </thead>
                                    <tbody id="membersList"></tbody>
                                </table>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const logo = document.querySelector('.navbar-brand img');
                
                logo.addEventListener('mouseenter', function() {
                    this.classList.add('logo-bounce');
                });

                logo.addEventListener('mouseleave', function() {
                    this.classList.remove('logo-bounce');
                });

                logo.addEventListener('click', function() {
                    this.classList.remove('wiggling', 'logo-bounce');
                    void this.offsetWidth; // Trigger reflow
                    this.classList.add('wiggling');
                });

                // Initialize modals
                var myModal = new bootstrap.Modal(document.getElementById('membersListModal'));

                // Add click handlers to all view-members buttons
                document.querySelectorAll('.view-members-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const orgName = this.getAttribute('data-org-name');
                        const members = JSON.parse(this.getAttribute('data-members'));
                        
                        // Update modal title
                        const modalTitle = document.querySelector('#membersListModal .modal-title');
                        modalTitle.textContent = orgName + ' - Members List';
                        
                        // Update table contents
                        const tbody = document.querySelector('#membersList');
                        tbody.innerHTML = '';
                        
                        members.forEach(member => {
                            tbody.innerHTML += `
                                <tr>
                                    <td>${member.name}</td>
                                    <td>${member.position}</td>
                                    <td>${member.level}</td>
                                </tr>
                            `;
                        });
                        
                        // Show modal
                        myModal.show();
                    });
                });
            });
        </script>
    </main>

        <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#facilities">Our Facilities</a></li>
                        <li><a href="home.php#news">News & Updates</a></li>
                    
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i> New Public Road, Barangay Ibayo Silangan 4110 Naic, Cavite</p>
                        <p><i class="fa fa-phone"></i> (230) 06-30</p>
                        <p><i class="fa fa-mobile"></i> +63 9602644913</p>
                    <p><i class="fa fa-envelope"></i> <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSDZcsFVXnqjnttHstfFZWsHNxSDBPpmVTgdkhMHVNRZfwkVTWrCkpPzfqWMVnjXBPSbxsvb" target="_blank" style="color: white; text-decoration: none;">cavitecommunityacademyinc@gmail.com</a></p>
                        <p><i class="fa fa-facebook-square"></i> <a href="https://www.facebook.com/messages/t/919309394803676" target="_blank" style="color: white; text-decoration: none;">Cavite Community Academy, Inc.</a></p>
                    </div>
                </div>
            
            <div class="footer-section">
                    <h3>Follow Us</h3>
                    <div class="qr-code">
                        <img src="qr.png" alt="CCAI QR Code">
                    </div>
                </div>
            </div>
               <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Cavite Community Academy, Inc. All rights reserved.</p>
        </div>
            </div>
        </footer>
    </main>

        
    </body>
    </html>

