<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <title>Home | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="ccai-logo.png" type="image/svg+xml" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        main {
        padding-top:0px; /* Reduced padding since navbar is not fixed */
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

        @keyframes logoJourney {
    10% {
        transform: translate(-50%, -1%) scale(3); /* Start centered */
        opacity: 1;
    }
        

    }

    .logo-initial {
        position: fixed;
        top: 33%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width:150px;
        height:150px;
        transform-origin: center;
    }

    .logo-animate {
        animation: logoJourney 3s ease-in-out forwards; /* Reduced from 10s to 8s */
        position: fixed;
        z-index: 9999;
        transform-origin: center;
    }

    /* Add overlay style */
    .logo-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        z-index: 9998;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .logo-overlay.fade-out {
        opacity: 0;
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
            text-align: justify;
        }

        .news-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            position: relative; /* Add this */
            height: 100%; /* Add this */
            display: flex; /* Add this */
            text-align: justify;
            flex-direction: column; /* Add this */
            padding-bottom: 60px; /* Add space for floating button */
        }

        .news-card .card-body {
            display: flex;
            flex-direction: column;
            flex: 1; /* Add this */
            padding: 1.5rem;
        }

        .news-card .read-more {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #000080;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            min-width: 120px;
        }

        .news-card .read-more:hover {
            background-color: #82C0CC;
            transform: translateX(-50%) translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .news-img {
            height: 300px; /* Changed from 200px */
            width: 100%;
            object-fit: contain; /* Changed from cover to maintain aspect ratio */
            transition: transform 0.5s ease;
            padding: 10px; /* Added padding */
            background-color: #fff; /* Added background */
        }

        @media (max-width: 768px) {
            .news-img {
                height: 250px; /* Adjusted height for mobile */
            }
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

        /* Add these new styles for parallax */
        .parallax-section {
            height: 100vh;
            background-image: url('ccai.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Remove background-attachment: fixed for mobile */
        @media (max-width: 768px) {
            .parallax-section {
                background-attachment: scroll; /* Change from fixed to scroll on mobile */
                min-height: 60vh; /* Reduce height on mobile */
                background-position: center center;
            }
            
            .parallax-overlay {
                background: rgba(0, 0, 128, 0.7); /* Slightly darker overlay for mobile */
            }
        }

        /* Add back fixed background for desktop */
        @media (min-width: 769px) {
            .parallax-section {
                background-attachment: fixed;
            }
        }

        .parallax-content {
            text-align: center;
            color: white;
            z-index: 2;
            padding: 20px;
        }

        .parallax-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 128, 0.6);
            z-index: 1;
        }

        .parallax-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .parallax-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        @media (max-width: 768px) {
            .parallax-title {
                font-size: 2.5rem;
            }
            .parallax-subtitle {
                font-size: 1.4rem;
            }
        }

        /* Add these new styles for president's message section */
        .president-section {
            padding: 6rem 0;
            background-color: #f8f9fa;
        }

        .president-content {
            display: flex;
            flex-direction: row; /* Change to row to place image on left */
            align-items: flex-start; /* Changed from center to flex-start */
            gap: 3rem;
            max-width: 2000px; /* Reduced from 1200px */
            margin: 0 auto;
            padding: 0 2rem;
        }

        .president-image {
            flex: 0 0 400px; /* Increased from 300px */
            position: relative;
            z-index: 2;
            margin-right: 2rem;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            height: 500px;
            overflow: hidden;  /* Changed to hidden */
            border-radius: 10px;
            background: #f8f9fa;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-right: 1rem; /* Reduced spacing */
            margin-top: 50px; /* Added margin-top to move image down */
            padding-top: 20px; /* Added padding-top for more spacing */
        }

        .president-image img {
            width: 450px; /* Increased from 400px */
            height: 600px; /* Increased from 500px */
            max-width: none;
            object-fit: contain;
            object-position: center bottom;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
            width: 400px; /* Adjusted width */
            height: 450px; /* Adjusted height */
        }

        .president-image:hover img {
            transform: translateY(-10px) scale(1.02);
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.2));
        }

        .president-text {
            flex: 1;
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            gap: 2rem; /* Reduced from 3rem */
            align-items: flex-start;
            width: 100%;
            margin-top: -30px; /* Move text up slightly to balance layout */
        }

        .president-content-text {
            flex: 1;
            position: relative;
            z-index: 2;
            padding-right: 1rem; /* Added padding */
            overflow: hidden;      /* Added to contain the watermark */
        }

        .president-title {
            color: #000080;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .president-message {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            margin-bottom: 2rem;
            text-align: justify; /* Add text justification */
            text-justify: inter-word; /* Improve word spacing */
            hyphens: auto; /* Enable hyphenation for better text flow */
        }

        @media (max-width: 768px) {
            .president-message {
                text-align: justify; /* Maintain justification on mobile */
                padding: 0 10px; /* Add some padding on mobile */
            }
        }

        .president-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #000080;
            margin-bottom: 0.5rem;
        }

        .president-position {
            font-size: 1rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .president-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
                max-width: 100%;
                padding: 0 1rem;
            }

            .president-image {
                height: 400px;
                margin-top: 30px; /* Less margin on mobile */
                padding-top: 15px;
            }

            .president-image img {
                height: 350px;
                width: 300px; /* Increased from 250px for mobile */
                height: 400px; /* Increased from 350px for mobile */
            }

            .president-title {
                font-size: 2rem;
            }

            .president-text {
                padding: 2rem;
            }
        }

        /* Add these new animation styles without modifying existing ones */
        @keyframes slideFromLeft {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideFromTop {
            0% {
                opacity: 0;
                transform: translateY(-100%);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-left {
            animation: slideFromLeft 1s ease-out forwards;
            opacity: 0;
        }

        .slide-down {
            animation: slideFromTop 1s ease-out forwards;
            opacity: 0;
            animation-delay: 0.5s;
        }

        /* Update President section styles */
        .president-section {
            padding: 6rem 0;
            position: relative;
        }
        
        .president-text {
            flex: 1;
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            gap: 3rem;
            align-items: flex-start;
        }

        .president-image {
            flex: 0 0 400px; /* Increased from 300px */
            position: relative;
            z-index: 2;
            margin-right: 2rem; /* Add spacing between image and text */
        }

        .president-image img {
            width: 500px; /* Increased from 400px */
            height: 500px; /* Increased from 500px */
            object-fit: cover; /* Ensure image fills the container */
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .president-image:hover img {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .president-content-text {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .president-text {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 2rem;
            }

            .president-image {
                flex: 0 0 auto;
                width: 300px; /* Increased from 250px for mobile */
                margin-right: 0;
                margin-bottom: 2rem;
            }

            .president-image img {
                width: 300px; /* Increased from 250px for mobile */
                height: 400px; /* Increased from 350px for mobile */
            }
        }

        .president-text::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('ccai-plaza.jpg') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .president-text > * {
            position: relative;
            z-index: 1;
        }

        .watermark-logo {
            position: absolute;
            left: 50%;             /* Center horizontally */
            top: 50%;             /* Center vertically */
            transform: translate(-50%, -50%) rotate(-2deg); /* Center and maintain rotation */
            width: 500px;         /* Adjusted size */
            height: 500px;
            opacity: 0.08;        /* Slightly adjusted opacity */
            z-index: 0;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .watermark-logo {
                width: 250px;
                height: 250px;
                opacity: 0.06;     /* Slightly more transparent on mobile */
            }
        }

        /* News Modal Styles */
        #newsModal .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
        }

        #newsModal .modal-header {
            background-color: #000080;
            color: white;
            padding: 1rem 1.5rem;
        }

        #newsModal .btn-close {
            filter: brightness(0) invert(1);
        }

        #newsModal .modal-description {
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin-top: 1rem;
        }

        #newsModal .modal-date {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            #newsModal .modal-dialog {
                margin: 1rem;
            }
        }

        /* Enhanced News Modal Styles */
        #newsModal .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
        }

        #newsModal .modal-header {
            background-color: #000080;
            color: white;
            padding: 1.5rem;
        }

        #newsModal .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1.4;
            margin-right: 2rem;
        }

        #newsModal .modal-body {
            padding: 2rem;
        }

        #newsModal .modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin: 1.5rem 0;
            padding: 0 0.5rem;
            white-space: pre-line;
            hyphens: auto;
        }

        #newsModal .modal-date {
            color: #666;
            font-size: 1rem;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #newsModal .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        #newsModal .btn-close:hover {
            opacity: 1;
        }

        /* Modal Responsive Styles */
        @media (max-width: 768px) {
            #newsModal .modal-dialog {
                margin: 1rem;
                max-width: calc(100% - 2rem);
            }

            #newsModal .modal-content {
                max-width: 100%;
            }

            #newsModal .modal-body {
                padding: 1.5rem;
            }

            #newsModal .modal-title {
                font-size: 1.3rem;
            }

            #newsModal .modal-description {
                font-size: 1rem;
                line-height: 1.6;
                padding: 0;
            }
        }

        /* Update Modal Styles */
        #newsModal .modal-dialog {
            max-width: 800px;
        }

        #newsModal .modal-content {
            width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
        }

        #newsModal .modal-body {
            padding: 2rem;
            overflow-y: visible; /* Changed from auto to visible */
            max-height: none; /* Remove max-height restriction */
        }

        /* Update Modal Styles */
        #newsModal .modal-dialog {
            max-width: 800px;
        }

        #newsModal .modal-content {
            width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            max-height: 90vh; /* Limit modal height */
        }

        #newsModal .modal-body {
            padding: 2rem;
            max-height: calc(90vh - 150px); /* Account for header */
            overflow-y: auto; /* Enable scrolling */
        }

        #newsModal .modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            text-align: justify;
            margin: 1.5rem 0;
            padding: 0.5rem;
            
        }

        #newsModal .modal-description p {
            margin-bottom: 1.2rem;
        }

        /* Scrollbar styling */
        #newsModal .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        #newsModal .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #newsModal .modal-body::-webkit-scrollbar-thumb {
            background: #000080;
            border-radius: 4px;
        }

        #newsModal .modal-body::-webkit-scrollbar-thumb:hover {
            background: #82C0CC;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            #newsModal .modal-dialog {
                margin: 1rem;
                max-width: calc(100% - 2rem);
            }
            
            #newsModal .modal-content {
                max-width: 100%;
            }

            #newsModal .modal-body {
                padding: 1.5rem;
            }

            #newsModal .modal-title {
                font-size: 1.3rem;
            }

            #newsModal .modal-description {
                font-size: 1rem;
                line-height: 1.6;
                padding: 0;
            }
        }

        /* Update Modal Styles */
        #newsModal .modal-dialog {
            max-width: 800px;
            height: 90vh; /* Set fixed height */
            display: flex;
            align-items: center;
        }

        #newsModal .modal-content {
            width: 100%;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        #newsModal .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            max-height: calc(90vh - 120px); /* Account for header */
        }

        #newsModal .modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            text-align: justify;
            margin: 1.5rem 0;
            padding: 0.5rem;
            white-space: normal;
        
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            #newsModal .modal-body {
                padding: 1rem;
            }
        }

        .news-card .card-text {
            text-align: justify;
            text-justify: inter-word;
            hyphens: auto;
            margin-bottom: 1rem;
        }

        .news-card .card-title {
            text-align: justify;
            margin-bottom: 1rem;
            color: #000080;
            font-weight: bold;
        }

        /* Update Modal Description styles */
        #newsModal .modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            text-align: justify !important;
            text-justify: inter-word;
            hyphens: auto;
            margin: 1.5rem 0;
            padding: 0.5rem;
        }

        #newsModal .modal-title {
            text-align: justify;
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1.4;
            margin-right: 2rem;
        }

        /* Add Map Section Styles */
        .map-section {
            padding: 4rem 0;
            background-color: #f8f9fa;
        }

        .map-title {
            color: #000080;
            margin-bottom: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .location-info {
            font-size: 1.2rem;
            color: #000080;
        }

        .location-info i {
            color: #000080;
            margin-right: 10px;
            font-size: 1.4rem;
        }

        @media (max-width: 768px) {
            .map-section {
                padding: 2rem 0;
            }
            
            .map-container iframe {
                height: 300px;
            }
            
            .location-info {
                font-size: 1rem;
            }
        }

        /* Add these QR code styles */
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

        /* Logo animation styles */
        @keyframes logoJourney {
    10% {
        transform: translate(-50%, -1%) scale(3);
        opacity: 1;
    }
        

    }

    .logo-initial {
        position: fixed;
        top: 33%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 150px;
        height: 150px;
        transform-origin: center;
    }

    .logo-animate {
        animation: logoJourney 3s ease-in-out forwards;
        position: fixed;
        z-index: 9999;
        transform-origin: center;
    }

    .logo-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        z-index: 9998;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .logo-overlay.fade-out {
        opacity: 0;
    }

        /* Logo hover animation */
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

        /* Back to Top Button styles */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #000080;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background-color: #82C0CC;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        @media (max-width: 768px) {
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }
    </style>
</head>
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
                <li><a class="dropdown-item" href="life@cca.php#hymn">CCAI Hymn</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Students
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="http://ccai-portal.free.nf" targer="b-_blank">Student Portal</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="studentorg.php">Student Organizations</a></li>
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
        <!-- Add the parallax section here -->
        <section class="parallax-section">
            <div class="parallax-overlay"></div>
            <div class="parallax-content">
                <h1 class="parallax-title slide-left">Welcome to CCAI</h1>
                <p class="parallax-subtitle slide-down">"Center of Academic Excellence through Holistic Development"</p>
            </div>
        </section>

        <!-- Update President's Message Section HTML -->
        <section class="president-section">
            <div class="president-content">
                <div class="president-text">
                    <div class="president-image">
                        <img src='lices.jpg' alt="School President">
                    </div>
                    <div class="president-content-text">
                        <img src="ccai-logo.png" alt="CCAI Logo" class="watermark-logo">
                        <h2 class="president-title">Message from the President</h2>
                        <p class="president-message">
                        It is with great excitement and a sense of pride that I welcome you all to another exciting chapter of our school year. As your School President, I am honored to serve alongside such a dedicated team of educators, staff, and students who make this institution truly remarkable.
        Our school is a place where curiosity thrives, creativity flourishes, and learning is celebrated. Whether you are returning or joining us for the first time, this year offers endless opportunities for growth and success. Together, we will continue to foster an environment of collaboration, respect, and excellence.
                        </p>
                        <p class="president-message">
                        To our students, I encourage you to embrace every challenge, seek new knowledge, and never stop pursuing your dreams. To our faculty and staff, your commitment to nurturing minds and hearts is what makes this community exceptional, and I am grateful for the work you do each day.
        Let us move forward with determination, unity, and the shared goal of creating an inspiring and inclusive environment where everyone can reach their full potential.
        Here's to a fantastic year ahead!
                        </p>
                        <div class="president-signature">
                            <p class="president-name">Alicia P. Mangahis</p>
                            <p class="president-position">President, Cavite Community Academy, Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="news-section" id="news">
            <div class="container">
                <center><h2 class="news-title headshake-title">News & Updates</h2></center>
                <div class="row g-4" id="newsContainer">
                    <!-- News items will be loaded dynamically via JavaScript -->
                </div>
            </div>
        </section>

        <!-- Add Map Location Section -->
        <section class="map-section" id="location">
            <div class="container">
                <center><h2 class="map-title headshake-title">Our Location</h2></center>
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.823684340378!2d120.76420133014673!3d14.321672053329806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339629cfed7ba5bb%3A0x6f62b62eabb8b0a4!2sCavite%20Community%20Academy%20Inc.!5e0!3m2!1sen!2sph!4v1745213176113!5m2!1sen!2sph"
                        width="100%" 
                        height="450" 
                        style="border:0; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="location-info text-center mt-4">
                    <p><i class="fa fa-map-marker"></i> New Public Road, Barangay Ibayo Silangan 4110 Naic, Cavite</p>
                </div>
            </div>
        </section>

        <!-- Update the modal structure -->
        <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #000080; color: white;"> <!-- Changed from bg-primary -->
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-4">
                    <img src="" alt="News Image" class="modal-image img-fluid rounded mb-3" style="max-height: 200px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <p class="modal-date text-muted"><i class="fa fa-calendar"></i> <span></span></p>
                    <div class="modal-description text-justify"></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('api/fetch_news.php')
                .then(response => response.json())
                .then(news => {
                    const newsContainer = document.getElementById('newsContainer');
                    newsContainer.innerHTML = '';
                    
                    if (news.length === 0) {
                        newsContainer.innerHTML = '<div class="col-12 text-center">No news articles available.</div>';
                        return;
                    }

                    news.forEach(item => {
                        // Show preview text in card
                        const previewText = item.description.substring(0, 500) + '...';

                        const newsCard = `
                            <div class="col-md-4 mb-4">
                                <div class="card news-card h-100">
                                    <img src="${item.image_path}" class="news-img card-img-top" alt="${item.title}">
                                    <div class="card-body">
                                        <h5 class="card-title">${item.title}</h5>
                                        <p class="news-date">
                                            <i class="fa fa-calendar"></i> 
                                            ${new Date(item.post_date).toLocaleDateString()}
                                        </p>
                                        <p class="card-text">${previewText}</p>
                                    </div>
                                    <button class="btn read-more" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#newsModal"
                                        data-title="${encodeURIComponent(item.title)}"
                                        data-description="${encodeURIComponent(item.description)}"
                                        data-date="${new Date(item.post_date).toLocaleDateString()}"
                                        data-image="${item.image_path}">
                                        Read More
                                    </button>
                                </div>
                            </div>
                        `;
                        newsContainer.innerHTML += newsCard;
                    });

                    // Update modal event listener
                    const newsModal = document.getElementById('newsModal')
                    newsModal.addEventListener('show.bs.modal', event => {
                        const button = event.relatedTarget;
                        const title = decodeURIComponent(button.getAttribute('data-title'));
                        const description = decodeURIComponent(button.getAttribute('data-description'));
                        const date = button.getAttribute('data-date');
                        const image = button.getAttribute('data-image');

                        newsModal.querySelector('.modal-title').textContent = title;
                        newsModal.querySelector('.modal-description').innerHTML = description; // Changed from innerHTML
                        newsModal.querySelector('.modal-date span').textContent = date;
                        newsModal.querySelector('.modal-image').src = image;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('newsContainer').innerHTML = 
                        '<div class="col-12 text-center text-danger">Error loading news.</div>';
                });
        });
        </script>
        <script>
            // Clear success message after 5 seconds
            setTimeout(function() {
                var successMessage = document.querySelector('.success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000);
        </script>
        <!-- Analytics Section -->
        <section class="analytics-section" style="background-color: #f8f9fa; padding: 4rem 0;">
            <div class="container">
                <center><h2 class="analytics-title headshake-title mb-4">Website Analytics</h2></center>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card shadow">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Website Traffic</h5>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="updatePeriod('week')">Week</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary active" onclick="updatePeriod('month')">Month</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="updatePeriod('year')">Year</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <canvas id="visitorGraph" style="width: 100%; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row g-3">
                            <div class="col-6 col-md-12">
                                <div class="card shadow">
                                    <div class="card-body text-center">
                                        <h3 class="text-primary mb-0" id="todayCount">0</h3>
                                        <small class="text-muted">Today's Visits</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-12">
                                <div class="card shadow">
                                    <div class="card-body text-center">
                                        <h3 class="text-success mb-0" id="totalCount">0</h3>
                                        <small class="text-muted">Total Visits</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            let visitorChart = null;
            
            function updatePeriod(period) {
                fetch(`visitor_stats.php?period=${period}`)
                    .then(response => response.json())
                    .then(data => {
                        if (visitorChart) {
                            visitorChart.destroy();
                        }

                        const ctx = document.getElementById('visitorGraph').getContext('2d');
                        visitorChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.dates,
                                datasets: [{
                                    label: 'Daily Visitors',
                                    data: data.counts,
                                    borderColor: '#000080',
                                    backgroundColor: 'rgba(130, 192, 204, 0.2)',
                                    tension: 0.4,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });

                        // Update counters
                        document.getElementById('todayCount').textContent = data.today;
                        document.getElementById('totalCount').textContent = data.total;

                        // Update active button
                        document.querySelectorAll('.btn-group .btn').forEach(btn => {
                            btn.classList.remove('active');
                        });
                        document.querySelector(`.btn-group .btn[onclick*="${period}"]`).classList.add('active');
                    });
            }

            // Initial load
            document.addEventListener('DOMContentLoaded', () => {
                updatePeriod('month');
            });
        </script>
        <!-- Main content area - currently empty -->
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
                <p style="font-style: italic; color: #82C0CC; margin-top: 5px;">
                <p><i class="fa fa-code"></i> <a href="https://www.facebook.com/simonking22" target="_blank" style="color: white; text-decoration: none;">Developed by: <i "></i>Simon A. Patag</a></p>
                  
                </p>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'logo-overlay';
        document.body.appendChild(overlay);

        const logo = document.querySelector('.navbar-brand img');
        const logoClone = logo.cloneNode(true);
        
        // Hide original logo initially
        logo.style.opacity = '0';
        
        // Position clone in center
        logoClone.className = 'logo-initial';
        document.body.appendChild(logoClone);
        
        // Start animation after a short delay
        setTimeout(() => {
            logoClone.classList.add('logo-animate');
            
            // When animation ends
            logoClone.addEventListener('animationend', () => {
                // Show original logo
                logo.style.opacity = '1';
                // Remove clone and overlay
                logoClone.remove();
                overlay.classList.add('fade-out');
                setTimeout(() => overlay.remove(), 500);
            });
        }, 1000);

        logo.addEventListener('mouseenter', function() {
            this.classList.add('logo-bounce');
        });

        logo.addEventListener('mouseleave', function() {
            this.classList.remove('logo-bounce');
        });

        logo.addEventListener('focus', function() {
            this.classList.add('wiggling');
        });

        logo.addEventListener('blur', function() {
            this.classList.remove('wiggling');
        });

        // Add click animation
        logo.addEventListener('click', function() {
            this.classList.remove('wiggling', 'logo-bounce');
            void this.offsetWidth; // Trigger reflow
            this.classList.add('wiggling');
        });
    });
    </script>

    <a href="#" class="back-to-top" aria-label="Back to Top">
        <i class="fa fa-arrow-up"></i>
    </a>

    <script>
        // Back to Top button functionality
        const backToTop = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>

