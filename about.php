<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    
    <title>About | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="ccai-logo.png" type="image/svg+xml" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  </head>
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

    .values-section {
        scroll-margin-top: 20px;
    }

    .org-chart-section {
        scroll-margin-top: 20px;
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

    /* Add new styles for vision-mission section */
    .values-section {
        padding: 6rem 0;
        background-color: #f8f9fa;
    }

    .values-card {
        padding: 2rem;
        height: 100%;
        text-align: center;
        transition: all 0.3s ease;
        border-radius: 10px;
        background-color: #DEE7E7;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .values-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .values-icon {
        font-size: 3rem;
        color: #000080;
        margin-bottom: 1.5rem;
    }

    .values-title {
        color: #000080;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        font-weight: bold;
    }

    .values-text {
        color: #444;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* Add these new styles for organizational chart section */
    .org-chart-section {
        padding: 4rem 0;
        background-color: #fff;
        margin-top: 2rem;
    }

    .org-chart-title {
        color: #000080;
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: headShake 2s ease-in-out infinite; /* Added animation */
        display: inline-block; /* Added to make animation work properly */
    }

    .org-chart-container {
        text-align: center; /* Added to center the title */
        max-width: 1200px;
        margin: 0 auto;
    }

    .org-chart-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
    }

    .org-chart-image:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
        .org-chart-title {
            font-size: 2rem;
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

    /* Remove these animation styles */
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
        background-color: rgba(0, 0, 128, 0.9);
        z-index: 9998;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .logo-overlay.fade-out {
        opacity: 0;
    }

    /* Keep only the hover animations */
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.querySelector('.navbar-brand img');
            
            // Only keep hover and click animations
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
        });
    </script>
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
              <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                About
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#values">Vision, Mission, Core Values</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#org-chart">Organizational Chart</a></li>
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
    <section class="values-section" id="values">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="values-card">
                        <i class="fa fa-eye values-icon"></i>
                        <h2 class="values-title">Vision</h2>
                        <p class="values-text">
                           Cavite Community Academy, Inc. is a God-centered private educational institution committed to be the   center of academic excellence through holistic development.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="values-card">
                        <i class="fa fa-bullseye values-icon"></i>
                        <h2 class="values-title">Mission</h2>
                        <p class="values-text">
                           Cavite Community Academy, Inc. aims to operate a system that;

<li>Enriches spriritual and academic growth;</li>
              <li>Instills social and environmental responsibilities in contribution towards the development of the global community; and</li><li>Prvides morally upright, technologically advanced, and highly competitive graduates.</li>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="values-card">
                        <i class="fa fa-star values-icon"></i>
                        <h2 class="values-title">Core Values</h2>
                        <p class="values-text">
                             <li>Service</li>
              <li>Leadership</li>
              <li>Faith</li>
              <li>Excellence</li> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="org-chart-section" id="org-chart">
        <div class="container">
            <div class="org-chart-container">
                <h2 class="org-chart-title">Organizational Chart</h2>
                <img src="on (1).jpeg" alt="Academic Organizational Chart" class="org-chart-image">
                <img src="2 (1) (1)-compressed.jpg" alt="Administrative Organizational Chart" class="org-chart-image">
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.php#facilities">Our Facilities</a></li>
                    <li><a href="home.php#news">News & Updates</a></li>
                  <li><a href="about.php">About Us</a></li>
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
    
  </body>
</html>

