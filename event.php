<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    
    <title>Services | Cavite Community Academy, Inc.</title>
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
        transform: scale(1.05);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.2),
            0 15px 20px rgba(0, 0, 0, 0.15),
            0 5px 10px rgba(0, 0, 0, 0.1);
        background-color: #c5d5d5;
        transition: all 0.3s ease;
    }

    .card:active {
        transform: scale(0.98);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: 2px solid rgba(130, 192, 204, 0.3);
        background-color: transparent;
        text-align: center; /* Add center alignment */
        padding: 1rem; /* Add more padding */
        font-weight: bold; /* Make text bold */
        color: #000080; /* Match theme color */
        transition: all 0.3s ease; /* Smooth transition */
        display: flex; /* Add flex display */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        width: 100%; /* Make full width */
        margin: 0; /* Remove any margins */
        position: relative; /* Add positioning context */
        left: 0; /* Align to left edge */
        right: 0; /* Align to right edge */
    }

    .card:hover .card-header {
        border-bottom: 2px solid #82C0CC;
        transform: translateY(-2px); /* Slight lift effect on hover */
        text-shadow: 0 0 8px rgba(0, 0, 128, 0.2); /* Add subtle glow */
    }

    .card-body:hover {
        background-color: #d8e3e3;
    }

    .card:hover .card-title {
        color: #000080;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }

    .card:hover .card-text {
        color: #333;
        transform: translateY(-3px);
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .card:hover {
            transform: scale(1.03);
        }
        
        .card:hover .card-title {
            transform: translateY(-3px);
        }
        
        .card:hover .card-text {
            transform: translateY(-2px);
        }
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
        line-height: 1.2; /* Reduced from 2 */
        color: #444;
        margin-bottom: 2rem;
        white-space: normal; /* Changed from pre-line */
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
        padding: 2px 0; /* Reduced from 8px */
        margin: 0;
        line-height: 1.2; /* Added to control line spacing */
    }

    .hymn-line.active {
        opacity: 1;
        color: #000080;
        font-weight: bold;
        transform: scale(1.02);
        text-shadow: 0 0 10px rgba(0, 0, 128, 0.2);
        background: linear-gradient(90deg, transparent, rgba(130, 192, 204, 0.1), transparent);
        padding: 2px 0; /* Reduced padding */
    }

    /* Update the audio container styles */
    .hymn-audio {
        margin: 2rem auto;
        position: relative;
        transform: translateZ(0);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .hymn-audio-container {
        position: relative;
        padding: 5px;
        width: 400px;
        margin: 0 auto;
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

    /* Update mobile styles */
    @media (max-width: 768px) {
        .hymn-audio-container {
            width: 90%;
            min-width: 300px;
            max-width: 400px;
            margin: 0 auto;
        }

        .hymn-audio {
            padding: 0 15px;
        }

        .hymn-audio audio {
            width: 100%;
            max-width: 100%;
        }
    }

    /* Extra small devices */
    @media (max-width: 320px) {
        .hymn-audio-container {
            width: 300px;
            min-width: auto;
            margin: 0 auto;
        }
    }

    .facility-img {
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .facility-img:hover {
        transform: scale(1.02);
    }

    #imageModal .modal-content {
        background-color: transparent;
        border: none;
    }

    #imageModal .modal-header {
        border-radius: 15px 15px 0 0;
    }

    #modalImage {
        border-radius: 0 0 15px 15px;
        max-height: 80vh;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        #imageModal .modal-dialog {
            margin: 1rem;
        }
    }

    .facility-card {
        position: relative;
        overflow: hidden;
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .play-icon i {
        font-size: 3rem;
        color: white;
        text-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    .facility-card:hover .play-icon {
        opacity: 1;
    }

    .facility-card:hover .facility-img {
        filter: brightness(0.7);
    }

    #videoModal .modal-content {
        background-color: black;
    }

    #modalVideo {
        max-height: 80vh;
        width: 100%;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .play-icon i {
            font-size: 2rem;
        }
    }

    .facility-image-container {
        position: relative;
        overflow: hidden;
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }

    .play-icon i {
        font-size: 3rem;
        color: white;
        text-shadow: 0 0 10px rgba(0,0,0,0.5);
        transition: all 0.3s ease;
    }

    .facility-card:hover .play-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .facility-card:hover .facility-img {
        filter: brightness(0.7);
        transform: scale(1.05);
    }

    .facility-card:hover .play-icon i {
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .play-icon {
            width: 60px;
            height: 60px;
        }

        .play-icon i {
            font-size: 2rem;
        }
    }

    /* Calendar Styles */
    .container.mt-4 {
        max-width: 900px;  /* Reduced from default bootstrap container width */
        padding: 20px;
    }

    #calendar {
        background-color: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Calendar Header */
    .fc-header-toolbar {
        margin-bottom: 1.5em !important;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .fc-toolbar-title {
        font-size: 1.5em !important;
        color: #000080 !important;
        font-weight: bold !important;
    }

    /* Calendar Buttons */
    .fc-button-primary {
        background-color: #000080 !important;
        border-color: #000080 !important;
        padding: 8px 15px !important;
        transition: all 0.3s ease !important;
    }

    .fc-button-primary:hover {
        background-color: #82C0CC !important;
        border-color: #82C0CC !important;
        transform: translateY(-2px);
    }

    /* Calendar Events */
    .fc-event {
        border-radius: 4px !important;
        padding: 3px 6px !important;
        font-size: 0.85em !important;
        transition: all 0.3s ease !important;
    }

    .fc-event:hover {
        transform: scale(1.02);
    }

    /* Calendar Cells */
    .fc-daygrid-day {
        transition: all 0.3s ease !important;
    }

    .fc-daygrid-day:hover {
        background-color: #f8f9fa !important;
    }

    .fc-daygrid-day.fc-day-today {
        background-color: rgba(130, 192, 204, 0.1) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container.mt-4 {
            padding: 10px;
        }
        
        #calendar {
            padding: 10px;
        }
        
        .fc-toolbar-title {
            font-size: 1.2em !important;
        }
        
        .fc-button {
            padding: 5px 10px !important;
            font-size: 0.9em !important;
        }
    }

    /* Calendar Week/Day Headers */
    .fc-col-header-cell {
        background-color: #000080 !important;
        padding: 10px 0 !important;
    }

    .fc-col-header-cell-cushion {
        color: white !important;
        font-weight: bold !important;
        text-decoration: none !important;
    }

    /* Calendar Event Time */
    .fc-event-time {
        font-weight: bold;
    }

    /* Update the calendar container styles */
    .calendar-container {
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        height: auto;
        max-width: 100%;
        overflow-x: auto;
    }

    /* Make calendar more compact for mobile */
    @media (max-width: 768px) {
        .calendar-container {
            padding: 10px;
            font-size: 14px;
        }
        
        .fc {
            font-size: 0.85em !important;
        }
        
        .fc .fc-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
        }
        
        .fc .fc-toolbar-title {
            font-size: 1.2em;
            margin: 0;
        }
        
        .fc .fc-button {
            padding: 0.2em 0.4em;
            font-size: 0.9em;
        }
        
        .fc .fc-toolbar.fc-header-toolbar {
            margin-bottom: 0.5em;
        }
        
        .fc .fc-daygrid-day-frame {
            min-height: 40px !important;
        }
        
        .fc .fc-daygrid-day-events {
            margin-bottom: 0;
        }
        
        .calendar-container {
            height: auto;
            min-height: 400px;
        }
    }

    /* Extra small devices */
    @media (max-width: 576px) {
        .fc .fc-toolbar {
            flex-direction: column;
            align-items: center;
        }
        
        .fc .fc-toolbar-title {
            margin-bottom: 5px;
        }
        
        .fc .fc-button-group {
            margin: 2px 0;
        }
    }

    /* Update calendar header colors for better visibility */
    .fc th {
        background-color: #f0f0f0;
        padding: 8px 0 !important;
    }

    /* Calendar and Events Table Container styles */
.calendar-container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: auto;
    width: 100%;
}

.events-table-container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    height: auto;
    max-height: 600px;
    overflow-y: auto;
    width: 100%;
}

#eventsTable {
    font-size: 0.9em;
    width: 100%;
    min-width: 300px;
}

#eventsTable thead th {
    background-color: #f0f0f0;
    position: sticky;
    top: 0;
    z-index: 10;
    padding: 12px 8px;
    white-space: nowrap;
}

.table-responsive {
    overflow-x: auto;
    margin-bottom: 15px;
    border-radius: 8px;
}

/* Responsive breakpoints */
@media (max-width: 1200px) {
    .events-table-container {
        max-height: 550px;
    }
}

@media (max-width: 992px) {
    .calendar-container,
    .events-table-container {
        margin: 10px auto;
        width: 100%;
    }
    
    .events-table-container {
        max-height: 500px;
    }
}

@media (max-width: 768px) {
    .calendar-container,
    .events-table-container {
        padding: 10px;
    }
    
    .events-table-container {
        max-height: 400px;
    }
    
    #eventsTable {
        font-size: 0.85em;
    }
    
    #eventsTable th,
    #eventsTable td {
        padding: 8px 5px;
    }
    
    .row > [class*='col-'] {
        padding: 0 10px;
    }
}

@media (max-width: 576px) {
    .events-table-container {
        max-height: 350px;
    }
    
    #eventsTable {
        font-size: 0.8em;
        min-width: 280px;
    }
    
    .action-buttons .btn {
        padding: 0.2rem 0.4rem;
        font-size: 0.75rem;
    }
}

/* Custom scrollbar for better UX */
.events-table-container::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.events-table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.events-table-container::-webkit-scrollbar-thumb {
    background: #000080;
    border-radius: 3px;
}

.events-table-container::-webkit-scrollbar-thumb:hover {
    background: #82C0CC;
}

/* Add these styles for event schedule title */
.events-table-container h3 {
    color: #000080;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
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

    /* Add these styles inside your existing <style> tag */
.service-link {
    display: inline-block;
    transition: transform 0.3s ease;
}

.service-link.logo-bounce {
    animation: bounce 0.5s cubic-bezier(0.36, 0, 0.66, -0.56) alternate infinite;
}

.service-link.wiggling {
    animation: wiggle 0.5s ease-in-out;
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
              <a class="nav-link active text-white service-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<?php
require_once('config/db_config.php');

function getEvents() {
    $conn = getDBConnection();
    $query = "SELECT * FROM events ORDER BY start_date ASC";
    $result = $conn->query($query);
    $events = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    
    $conn->close();
    return $events;
}

$events = getEvents();
?>

<main>
    <div class="container mt-4">
       <center> <h2 class="text-center headshake-title mb-4">CCAI Events</h2>   </center><br>
        
        <div class="row">
            <!-- Calendar Column -->
            <div class="col-md-7">
                <div class="calendar-container" style="max-width: 600px; margin: 0 auto;">
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Events Table Column -->
            <div class="col-md-5">
                <div class="events-table-container">
                    <h3 class="text-center mb-3" style="color: #000080;">Event Schedule</h3>
                    <div class="table-responsive">
                        <table class="table table-hover" id="eventsTable">
                            <thead>
                                <tr>
                                    <th style="background-color: #f0f0f0; position: sticky; top: 0; z-index: 1;">Date</th>
                                    <th style="background-color: #f0f0f0; position: sticky; top: 0; z-index: 1;">Events</th>
                                    <th style="background-color: #f0f0f0; position: sticky; top: 0; z-index: 1;">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($events as $event): ?>
                                    <tr>
                                        <td><?php echo date('M d, Y', strtotime($event['start_date'])); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if(!empty($event['image'])): ?>
                                                    <img src="<?php echo htmlspecialchars($event['image']); ?>" 
                                                         alt="Event image" 
                                                         class="me-2"
                                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                                <?php endif; ?>
                                                <?php echo htmlspecialchars($event['title']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if(!empty($event['image'])): ?>
                                                <button class="btn btn-sm btn-info" onclick="showImage('<?php echo basename($event['image']); ?>', '<?php echo htmlspecialchars($event['title']); ?>')">
                                                    View
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($events)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No events scheduled</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Update the modal to be more compact -->
    <div class="modal fade" id="eventModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #000080; color: white;">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="event-date mb-2"></p>
                    <p class="event-description"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this modal just before </main> -->
    <div class="modal fade" id="eventImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #000080; color: white;">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="uploads/events" alt="Event image" class="img-fluid" style="width: 100%; max-height: 80vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
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

<style>
/* Add these styles for the calendar and table layout */
.calendar-container {
    background: white;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    position: absolute;
    left: 75px;
    width:600px;
    height:550px;
}

.events-table-container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    height: 150%;
    width:500px;
    max-height: 550px; /* Limit height */
    overflow-y: auto; /* Enable vertical scroll */
}

/* Make calendar more compact */
.fc {
    font-size: 0.9em !important;
}

.fc .fc-toolbar.fc-header-toolbar {
    margin-bottom: 1em;
    font-size: 0.9em;
}

.fc .fc-button {
    padding: 0.2em 0.65em;
}

.fc .fc-daygrid-day-frame {
    min-height: 50px !important;
}

/* Table styles */
#eventsTable {
    font-size: 0.9em;
    margin-bottom: 0;
}

#eventsTable thead {
    position: sticky;
    top: 0;
    z-index: 2;
}

#eventsTable thead th {
    padding: 12px 8px;
    background-color: #f0f0f0;
    border-bottom: 2px solid #dee2e6;
    white-space: nowrap;
}

#eventsTable tbody td {
    padding: 10px 8px;
    vertical-align: middle;
}


/* Scrollbar styling */
.events-table-container::-webkit-scrollbar {
    width: 6px;
}

.events-table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.events-table-container::-webkit-scrollbar-thumb {
    background: #000080;
    border-radius: 3px;
}

.events-table-container::-webkit-scrollbar-thumb:hover {
    background: #82C0CC;
}
 @media (max-width: 767px) {
        .calendar-container {
    display:none;
}
    }
 @media (max-width: 1143px) {
     .events-table-container {
        margin-top: 20px;
        max-height: 400px;
        
       position:relative;
        left: 0px;
        width:auto;
    }
      .calendar-container {
    display:flex;
    width:auto;
    height:400px;
       position:relative;
        left: 0px;
        top:20px;
}
  
    }
/* Tablet responsive styles */
@media (min-width: 768px, max-width: 989px) {
   
.calendar-container {
    display:none;
}
    .events-table-container {
        margin-top: 20px;
        max-height: 400px;
        
       position:relative;
        left: -0px;
        width:auto;
    }
}

}
@media (min-width: 768px)(max-width: 968px) {
    .events-table-container {
        margin-top: 20px;
        max-height: 400px;
        padding: 10px;
        position:relative;
        left:0px;
        width:auto;
    }
  
    #eventsTable {
        font-size: 0.85em;
    }

    #eventsTable thead th,
    #eventsTable tbody td {
        padding: 8px 6px;
    }

    .action-buttons .btn {
        padding: 0.2rem 0.4rem;
        font-size: 0.8rem;
    }
}

/* Make table horizontally scrollable on very small screens */
@media (max-width: 767px) {
    .table-responsive {
        overflow-x: auto;
    }
    .calendar-container {
    display:none;
}

    #eventsTable {
        min-width: 400px; /* Ensure minimum width */

    }
    .events-table-container {
        margin-top: 20px;
        max-height: 400px;
        padding: 0px;
        width:auto;
        position:relative;
        left:0px;
    }
}
</style>

<script>
function showImage(imagePath, title) {
    const modal = new bootstrap.Modal(document.getElementById('eventImageModal'));
    const modalTitle = document.querySelector('#eventImageModal .modal-title');
    const modalImage = document.querySelector('#eventImageModal img');
    
    modalTitle.textContent = title;
    modalImage.src = 'uploads/events/' + imagePath; // Make sure this path matches your upload directory
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    // Add styles for view button and modal
    document.head.insertAdjacentHTML('beforeend', `
    <style>
        .btn-info {
            background-color: #000080;
            border-color: #000080;
            color: white;
            transition: all 0.3s ease;
            padding: 4px 8px;
            font-size: 0.9em;
        }

        .btn-info:hover {
            background-color: #82C0CC;
            border-color: #82C0CC;
            transform: translateY(-2px);
        }

        #eventImageModal .modal-content {
            background-color: #000;
        }

        #eventImageModal .modal-body {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
        }

        #eventImageModal img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }
    </style>
    `);
});
</script>

<!-- Add this modal before </body> -->
<div class="modal fade" id="eventImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #000080; color: white;">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img src="" alt="Event image" class="img-fluid" style="width: 100%; max-height: 80vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: 'get_events.php', // Changed to fetch from PHP endpoint
      eventTimeFormat: {
        hour: 'numeric',
        minute: '2-digit',
        meridiem: 'short'
      }
    });
    calendar.render();
  });
</script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: window.innerWidth < 768 ? 'listMonth' : 'dayGridMonth',
        height: 'auto',
        aspectRatio: window.innerWidth < 768 ? 1.2 : 1.5,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },
        windowResize: function(view) {
            if (window.innerWidth < 768) {
                calendar.setOption('aspectRatio', 1.2);
            } else {
                calendar.setOption('aspectRatio', 1.5);
            }
        },
        // ...existing calendar options...
    });
    calendar.render();

    // Handle orientation change for mobile devices
    window.addEventListener('orientationchange', function() {
        setTimeout(function() {
            calendar.updateSize();
        }, 200);
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: window.innerWidth < 768 ? 'listMonth' : 'dayGridMonth',
        height: 'auto',
        aspectRatio: window.innerWidth < 768 ? 1.2 : 1.5,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },
        windowResize: function(view) {
            if (window.innerWidth < 768) {
                calendar.changeView('listMonth');
                calendar.setOption('aspectRatio', 1.2);
            } else {
                calendar.changeView('dayGridMonth');
                calendar.setOption('aspectRatio', 1.5);
            }
        }
    });
    calendar.render();
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing logo animations
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

        // New Services link animations
        const serviceLink = document.querySelector('.service-link');
        
        serviceLink.addEventListener('mouseenter', function() {
            this.classList.add('logo-bounce');
        });

        serviceLink.addEventListener('mouseleave', function() {
            this.classList.remove('logo-bounce');
        });

        serviceLink.addEventListener('click', function() {
            this.classList.remove('wiggling', 'logo-bounce');
            void this.offsetWidth; // Trigger reflow
            this.classList.add('wiggling');
        });
    });
</script>
    
  </body>
</html>

