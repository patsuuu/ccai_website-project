<?php
session_start();

// Set session timeout to 1 hour (3600 seconds)
$timeout = 3600; // 1 hour in seconds

// Check if session timeout timestamp exists
if (isset($_SESSION['last_activity'])) {
    // Calculate time difference
    $inactive_time = time() - $_SESSION['last_activity'];
    
    // If inactive time exceeds timeout, destroy session and redirect
    if ($inactive_time >= $timeout) {
        session_unset();
        session_destroy();
        header("Location: admin/login.php?timeout=1");
        exit;
    }
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

// Check if user is logged in
if (!isset($_SESSION['superadmin_logged_in']) || $_SESSION['superadmin_logged_in'] !== true) {
    header("Location: admin/login.php");
    exit;
}

// Get username from session
$superadmin_username = isset($_SESSION['superadmin_username']) ? $_SESSION['superadmin_username'] : 'Admin';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7l+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    
    <title>Dashboard | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="ccai-logo.png" type="image/svg+xml" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
     <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
    <script type="text/javascript">
        // Prevent back button functionality
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
        
        // Add event listeners for back button prevention
        window.onload = noBack;
        window.onpageshow = function(evt) {
            if (evt.persisted) noBack();
        };
        window.onunload = function() {
            void(0);
        };

        // Session timeout warning and redirect
        let timeoutWarning = 3540000; // Warning at 59 minutes (3540 seconds)
        let timeoutNow = 3600000; // Redirect at 60 minutes (3600 seconds)
        let warningTimer;
        let timeoutTimer;

        // Start timers when page loads
        function StartTimers() {
            warningTimer = setTimeout("IdleWarning()", timeoutWarning);
            timeoutTimer = setTimeout("IdleTimeout()", timeoutNow);
        }

        // Reset timers on user activity
        function ResetTimers() {
            clearTimeout(warningTimer);
            clearTimeout(timeoutTimer);
            StartTimers();
        }

        // Show warning message
        function IdleWarning() {
            alert("Your session will expire in 15 seconds due to inactivity!");
        }

        // Redirect on timeout
        function IdleTimeout() {
            window.location = "admin/logout.php";
        }

        // Add event listeners for user activity
        document.addEventListener("mousemove", ResetTimers);
        document.addEventListener("keypress", ResetTimers);
        document.addEventListener("click", ResetTimers);
        document.addEventListener("scroll", ResetTimers);

        // Start timers when page loads
        window.onload = function() {
            StartTimers();
            noBack();
        };
    </script>
  </head>
  <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
    <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
  <style>
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
            transform: translateY(-5px) /* Smaller lift on mobile */;
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

    /* Add these styles for the hymn section */
    .hymn-section {
        padding: 6rem 0;
        background-color: #f8f9fa;
        position: relative;
    }

    .hymn-container {
        max-width: 1000px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .hymn-title {
        color: #000080;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: headShake 2s ease-in-out infinite;
        display: inline-block;
    }

    .hymn-content {
        background-color: #DEE7E7;
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        opacity: 0;
        animation: cardReveal 1.2s ease-out forwards;
    }

    .hymn-content:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .hymn-lyrics {
        font-size: 1.2rem;
        line-height: 2;
        color: #444;
        margin-bottom: 2rem;
        white-space: pre-line;
    }

    .hymn-note {
        font-style: italic;
        color: #666;
        margin-top: 2rem;
        border-top: 1px solid rgba(0,0,0,0.1);
        padding-top: 1rem;
    }

    @media (max-width: 768px) {
        .hymn-section {
            padding: 4rem 0;
        }
        
        .hymn-title {
            font-size: 2rem;
        }
        
        .hymn-content {
            padding: 2rem;
        }
        
        .hymn-lyrics {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    }

    /* Add these styles for the audio player */
    .hymn-audio {
        margin: 2rem auto; /* Changed from 2rem 0 to center horizontally */
        position: relative;
        transform: translateZ(0);
        display: flex;          /* Added */
        flex-direction: column; /* Added */
        align-items: center;    /* Added */
    }

    .hymn-audio-container {
        position: relative;
        padding: 5px;
        width: 400px;
        margin: 0 auto;        /* Added */
        background: linear-gradient(145deg, rgb(230, 212, 212), #000066);
        border-radius: 50px;
        box-shadow: 
            0 10px 30px rgba(0,0,0,0.2),
            inset 0 -2px 6px rgba(255,255,255,0.1),
            inset 0 2px 6px rgba(0,0,0,0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
    }

    @media (max-width: 768px) {
        .hymn-audio-container {
            width: 90%;    /* Added responsive width for mobile */
            max-width: 400px; /* Added max-width for mobile */
        }
    }

    .hymn-audio audio {
        width: 100%;
        max-width: 500px;
        border-radius: 30px;
        background-color: #000080;
        opacity: 0;
        animation: fadeIn 1s ease-out 1s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .hymn-audio audio::-webkit-media-controls-panel {
        background-color: #000080;
    }

    .hymn-audio audio::-webkit-media-controls-current-time-display,
    .hymn-audio audio::-webkit-media-controls-time-remaining-display {
        color: white;
    }

    .hymn-audio-title {
        color: #000080;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    /* Enhanced audio player styles */
    .hymn-audio {
        margin: 2rem 0;
        position: relative;
        transform: translateZ(0);
    }

    .hymn-audio-container {
        position: relative;
        padding: 5px;
        width: 400px;
        background: linear-gradient(145deg,rgb(230, 212, 212), #000066);
        border-radius: 50px;
        box-shadow: 
            0 10px 30px rgba(0,0,0,0.2),
            inset 0 -2px 6px rgba(255,255,255,0.1),
            inset 0 2px 6px rgba(0,0,0,0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
    }

    .hymn-audio-container:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 15px 40px rgba(0,0,0,0.3),
            inset 0 -2px 6px rgba(255,255,255,0.1),
            inset 0 2px 6px rgba(0,0,0,0.2);
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    .hymn-audio audio {
        width: 100%;
        max-width: 500px;
        border-radius: 30px;
        background: transparent;
        opacity: 0;
        animation: fadeIn 1s ease-out 0.5s forwards;
    }

    .hymn-audio-title {
        color: #000080;
        font-size: 1.2rem;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
        animation: glow 2s ease-in-out infinite;
    }

    @keyframes glow {
        0%, 100% { text-shadow: 0 0 5px rgba(0,0,128,0.2); }
        50% { text-shadow: 0 0 20px rgba(0,0,128,0.6); }
    }

    .hymn-audio-visualizer {
        position: absolute;
        bottom: 10px;
        left: 0;
        width: 100%;
        height: 20px;
        display: flex;
        justify-content: center;
        gap: 3px;
        padding: 0 50px;
        pointer-events: none;
    }

    .visualizer-bar {
        width: 3px;
        background: rgba(130, 192, 204, 0.5);
        animation: visualize 0.5s ease infinite;
        transform-origin: bottom;
    }

    @keyframes visualize {
        0%, 100% { transform: scaleY(0.3); }
        50% { transform: scaleY(1); }
    }

    /* Add animation delays for visualizer bars */
    .visualizer-bar:nth-child(1) { animation-delay: 0.1s; }
    .visualizer-bar:nth-child(2) { animation-delay: 0.2s; }
    .visualizer-bar:nth-child(3) { animation-delay: 0.3s; }
    .visualizer-bar:nth-child(4) { animation-delay: 0.4s; }
    .visualizer-bar:nth-child(5) { animation-delay: 0.5s; }

    /* Add these styles for synchronized lyrics */
    .hymn-line {
        opacity: 0.6;
        transition: all 0.3s ease;
        padding: 8px 0;
        margin: 0;
    }

    .hymn-line.active {
        opacity: 1;
        color: #000080;
        font-weight: bold;
        transform: scale(1.02);
        text-shadow: 0 0 10px rgba(0, 0, 128, 0.2);
        background: linear-gradient(90deg, transparent, rgba(130, 192, 204, 0.1), transparent);
    }

    /* Add these new styles */
    .card-container {
        position: relative;
        min-height: 200px;
        margin-bottom: 30px;
    }

    .float-button {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 25px;
        background-color: #000080;
        color: white;
        border-radius: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        border: none;
        z-index: 10;
        width: auto;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .float-button:hover {
        transform: translateX(-50%) translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        background-color: #000066;
        color: white;
    }

    /* Add these new styles */
    .logout-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        z-index: 1031; /* Ensure button stays above other elements */
    }
    
    .logout-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        color: white;
    }

    /* Add responsive styles for logout button */
    @media (max-width: 768px) {
        .logout-btn {
            top: 10px;
            right: 60px; /* Move left to make room for navbar toggler */
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .logout-btn .btn-text {
            display: none; /* Hide text on mobile */
        }
        
        .logout-btn .fa {
            margin: 0; /* Center icon */
            font-size: 16px;
        }
    }

    .admin-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .admin-info i {
        font-size: 1.2rem;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        color: white;
    }

    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .admin-controls {
            gap: 10px;
        }

        .admin-info {
            padding: 6px 10px;
        }

        .admin-text {
            display: none; /* Hide "Admin" text on mobile */
        }

        .logout-btn {
            padding: 6px 10px;
        }

        .btn-text {
            display: none; /* Hide "Logout" text on mobile */
        }

        .admin-info i,
        .logout-btn i {
            font-size: 1.1rem;
            margin: 0;
        }
    }

    /* Tablet responsive styles */
    @media (min-width: 769px) and (max-width: 991px) {
        .admin-controls {
            gap: 12px;
        }

        .admin-info,
        .logout-btn {
            padding: 7px 12px;
        }
    }

    /* Extra small devices */
    @media (max-width: 360px) {
        .admin-controls {
            gap: 5px;
        }

        .admin-info,
        .logout-btn {
            padding: 5px 8px;
        }
    }

    /* Add these new styles */
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        margin-bottom: 30px !important;
    }

    .admin-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #000080;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: #DEE7E7;
    }

    .admin-info i {
        font-size: 1.2rem;
        color: #000080;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #000080 !important;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: #DEE7E7;
        border: 1px solid #000080;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #000080;
        color: white !important;
        transform: translateY(-2px);
    }

    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .admin-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .admin-controls {
            width: 100%;
            justify-content: center;
        }

        .admin-info {
            padding: 6px 10px;
        }

        .admin-text {
            display: none;
        }

        .logout-btn {
            padding: 6px 10px;
        }

        .btn-text {
            display: none;
        }

        .admin-info i,
        .logout-btn i {
            font-size: 1.1rem;
            margin: 0;
        }
    }

    /* Tablet responsive styles */
    @media (min-width: 769px) and (max-width: 991px) {
        .admin-controls {
            gap: 12px;
        }

        .admin-info,
        .logout-btn {
            padding: 7px 12px;
        }
    }

    .admin-dropdown {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .admin-dropdown:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .admin-dropdown i {
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .admin-text {
            display: none;
        }
        
        .admin-dropdown {
            padding: 8px;
        }
    }

    .dropdown-menu {
        min-width: 120px;
        margin-top: 10px;
        background-color: white;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .dropdown-item {
        padding: 8px 15px;
        color: #000080;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #000080;
        transform: translateX(5px);
    }

    .dropdown-item i {
        margin-right: 8px;
        width: 20px;
        text-align: center;
    }

    /* Admin navigation styles */
    .admin-nav {
        display: flex;
        align-items: center;
    }

    .admin-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .admin-btn:hover,
    .admin-btn:focus {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .admin-btn i {
        font-size: 1.2rem;
    }

    .dropdown-menu {
        margin-top: 10px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 8px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        color: #000080;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .admin-text {
            display: none;
        }
        
        .admin-btn {
            padding: 8px;
        }
        
        .admin-btn i {
            margin: 0;
        }
    }
    
    /* Logo animations */
    .navbar-brand img {
        transition: all 0.3s ease;
    }

    .navbar-brand img.animate-logo {
        animation: logoWiggle 0.6s ease-in-out;
        transform-origin: center;
    }

    @keyframes logoWiggle {
        0%, 100% { transform: rotate(0deg) scale(1); }
        25% { transform: rotate(-15deg) scale(1.1); }
        50% { transform: rotate(10deg) scale(1.1); }
        75% { transform: rotate(-5deg) scale(1.1); }
    }

    /* Add these new dropdown animation styles */
    .animate {
        animation-duration: 0.3s;
        animation-fill-mode: both;
    }

    .slideIn {
        animation-name: slideIn;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0);
        }
    }

    .dropdown-menu.animate.slideIn {
        right: 5px; /* Move menu slightly to the left */
        margin-top: 0px;
        min-width: 160px;
        opacity: 1; /* Ensure full opacity */
        display: none;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        animation: slideIn 0.3s ease-out;
        transform-origin: top right;
        opacity: 1;
    }

    /* Prevent menu from disappearing on hover */
    .dropdown-menu:hover {
        display: block;
        opacity: 1;
    }
  </style>
  <body>
    

    <nav class="navbar navbar-expand-lg" style="background-color: #000080;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <img src="ccai-logo.png" alt="CCAI Logo" class="d-inline-block">
            <span class="full-text">Cavite Community Academy, Inc.</span>
            <span class="short-text">CCAI</span>
        </a>
        <div class="admin-nav">
            <div class="dropdown">
                <button class="admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle"></i>
                    <span class="admin-text"><?php echo htmlspecialchars($superadmin_username); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end animate slideIn">
                    <li>
                        <a class="dropdown-item" href="admin/logout.php">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<main>
    <div class="container mt-4">
        <!-- Add admin header with logout -->
        <div class="admin-header mb-4">
    
        </div>
        <center>  <h2 class="headshake-title d-inline-block">Admin Dashboard</h2></center><br><br>
        <!-- Rest of the admin content -->
        <div class="row justify-content-center g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-newspaper-o fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">News Management System</h5>
                            <p class="card-text">Add, or remove news.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='admin/add_news1.php'" class="float-button">
                        <i class="fa fa-edit"></i>Manage News
                    </button>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-upload fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">Upload Forms</h5>
                            <p class="card-text">Upload new forms.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='uploadform1.php'" class="float-button">
                        <i class="fa fa-plus"></i>Add Form
                    </button>
                </div>
            </div>

            <!-- Add new card for Population -->
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-users fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">Student Population</h5>
                            <p class="card-text">Add or manage student data.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='popul1.php'" class="float-button">
                        <i class="fa fa-user-plus"></i>Add Population
                    </button>
                </div>
            </div>

            <!-- Event Management Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-calendar fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">Event Management System</h5>
                            <p class="card-text">Add, edit, or remove events.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='upload_event1.php'" class="float-button">
                        <i class="fa fa-plus"></i>Add Events
                    </button>
                </div>
            </div>

            <!-- Video Management Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-video-camera fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">Video Management System</h5>
                            <p class="card-text">Upload, manage and delete facility videos.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='upload_video1.php'" class="float-button">
                        <i class="fa fa-film"></i>Manage Videos
                    </button>
                </div>
            </div>

            <!-- Student Organization Management Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card-container">
                    <div class="card h-100" style="background-color: #DEE7E7;">
                        <div class="card-body text-center">
                            <i class="fa fa-users fa-3x mb-3" style="color: #000080;"></i>
                            <h5 class="card-title">Student Organization Management</h5>
                            <p class="card-text">Add, edit, or remove student organizations.</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='org_manage1.php'" class="float-button">
                        <i class="fa fa-plus"></i>Add Organization
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const audio = document.querySelector('.hymn-audio audio');
    const visualizerBars = document.querySelectorAll('.visualizer-bar');
    const hymnLines = document.querySelectorAll('.hymn-line');
    
    // Existing visualizer code...
    
    function updateLyrics() {
        const currentTime = audio.currentTime;
        
        hymnLines.forEach(line => {
            const start = parseFloat(line.dataset.start);
            const end = parseFloat(line.dataset.end);
            
            if (currentTime >= start && currentTime < end) {
                line.classList.add('active');
                // Smooth scroll to active line
                line.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                line.classList.remove('active');
            }
        });
    }
    
    audio.addEventListener('timeupdate', updateLyrics);
    audio.addEventListener('play', function() {
        updateVisualizer();
        updateLyrics();
    });
    
    audio.addEventListener('pause', function() {
        updateVisualizer();
        hymnLines.forEach(line => line.classList.remove('active'));
    });
    
    // Reset lyrics highlight when audio ends or loops
    audio.addEventListener('ended', function() {
        hymnLines.forEach(line => line.classList.remove('active'));
    });
    
    // Existing observer and click handler code...
});

function deleteEvent(eventId) {
    if (confirm('Are you sure you want to delete this event?')) {
        fetch('delete_event.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + eventId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting event');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting event');
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const logo = document.querySelector('.navbar-brand img');
    
    logo.addEventListener('mouseenter', function() {
        this.classList.add('animate-logo');
    });
    
    logo.addEventListener('animationend', function() {
        this.classList.remove('animate-logo');
    });
});
</script>
 <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script> <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
    
    
  </body>
</html>

