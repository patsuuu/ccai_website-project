<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    
    <title>Life@CCAI | Cavite Community Academy, Inc.</title>
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

    .facility-img-container {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .facility-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .facility-img:hover {
        transform: scale(1.02);
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
        cursor: pointer; /* Add cursor pointer */
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
        width: 80px;
        height: 80px;
        background: rgba(0, 0, 128, 0.6); /* Made slightly more visible */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer; /* Add cursor pointer */
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
              <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
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
              <a class="nav-link active text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <li><a class="dropdown-item" href="http://ccai-portal.free.nf">Student Portal</a></li>
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
   <center><h2 class="headshake-title">Academics</h2></center> 
   <div class="container mt-4">
     <div class="row row-cols-1 row-cols-md-3 g-4">
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('STEM track selected')">
           <div class="card-header">ACADEMIC TRACKS</div>
           <div class="card-body">
             <h5 class="card-title">STEM</h5>
             <p class="card-text">focusing on these fields for innovation and problem-solving.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('HUMSS track selected')">
           <div class="card-header">ACADEMIC TRACKS</div>
           <div class="card-body">
             <h5 class="card-title">HUMSS</h5>
             <p class="card-text">focusing on subjects like history, literature, philosophy, and social studies.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('ABM track selected')">
           <div class="card-header">ACADEMIC TRACKS</div>
           <div class="card-body">
             <h5 class="card-title">ABM</h5>
             <p class="card-text">focused on engaging specific high-value accounts.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Computer System Servicing (CSS) - NC2 track selected')">
           <div class="card-header">TECH-VOC - ICT</div>
           <div class="card-body">
             <h5 class="card-title">Computer System Servicing (CSS) - NC2</h5>
             <p class="card-text">NC2 is a technical certification in repairing, maintaining, and troubleshooting computer systems.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Computer Programming - NC3 track selected')">
           <div class="card-header">TECH-VOC - ICT</div>
           <div class="card-body">
             <h5 class="card-title">Computer Programming - NC3</h5>
             <p class="card-text">NC3 is a technical certification for skills in writing, testing, and debugging computer programs.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Food Beverages Services (FBS) - NC2 track selected')">
           <div class="card-header">TECH-VOC - H.E.</div>
           <div class="card-body">
             <h5 class="card-title">Food Beverages Services (FBS) - NC2</h5>
             <p class="card-text">NC2 is a certification for skills in preparing and serving food and drinks in the hospitality industry.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Commercial Cooking - NC3 track selected')">
           <div class="card-header">TECH-VOC - H.E.</div>
           <div class="card-body">
             <h5 class="card-title">Commercial Cooking - NC3</h5>
             <p class="card-text">NC3 is a certification for advanced skills in preparing and cooking food in a professional kitchen setting.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Cookery - NC2 track selected')">
           <div class="card-header">TECH-VOC - H.E.</div>
           <div class="card-body">
             <h5 class="card-title">Cookery - NC2</h5>
             <p class="card-text">NC2 is a certification for basic skills in food preparation, cooking, and presentation.</p>
           </div>
         </button>
       </div>
       <div class="col">
         <button class="card h-100 w-100 border-0" style="background-color: #DEE7E7; cursor: pointer;" onclick="alert('Bread and Pastry Production - NC2 track selected')">
           <div class="card-header">TECH-VOC - H.E.</div>
           <div class="card-body">
             <h5 class="card-title">Bread and Pastry Production - NC2</h5>
             <p class="card-text">NC2 is a certification for skills in baking bread, pastries, and other baked goods.</p>
           </div>
         </button>
       </div>
     </div>
   </div>

   <style>
     /* Add these button-specific styles */
     .card.h-100.w-100 {
       transition: all 0.3s ease;
       text-align: left;
       border: none !important;
       outline: none !important;
     }

     .card.h-100.w-100:hover {
       transform: translateY(-10px);
       box-shadow: 0 10px 20px rgba(0,0,0,0.2);
     }

     .card.h-100.w-100:active {
       transform: translateY(-5px);
     }

     .card.h-100.w-100:focus {
       outline: none;
       box-shadow: 0 0 0 3px rgba(0,0,128,0.3);
     }
   </style>

   <section class="facilities-section" id="facilities">
    <div class="container">
        <center><h2 class="facilities-title headshake-title">Our Facilities</h2></center>
        <div class="row g-4 facilities-row">
            <?php
            require_once 'database.php';
            $stmt = $pdo->query("SELECT * FROM videos ORDER BY id DESC");
            $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($videos)) {
                echo '<div class="col-12 text-center">';
                echo '<div class="alert alert-info" style="background-color: #DEE7E7; border: none; color: #000080;">';
                echo '<i class="fa fa-info-circle fa-2x mb-3"></i>';
                echo '<h4 class="alert-heading">No Videos Available</h4>';
                echo '<p>Currently, there are no facility videos uploaded.</p>';
                echo '</div>';
                echo '</div>';
            } else {
                foreach ($videos as $video) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card facility-card">';
                    echo '<div class="facility-image-container" onclick="openVideoModal(\'' . htmlspecialchars($video['url']) . '\', \'' . htmlspecialchars($video['title']) . '\')" style="cursor: pointer;">';
                    // Create a hidden video element to generate thumbnail
                    echo '<video class="thumbnail-video" style="display:none;" preload="metadata">';
                    echo '<source src="' . htmlspecialchars($video['url']) . '" type="video/mp4">';
                    echo '</video>';
                    echo '<div class="facility-img-container">';
                    echo '<canvas class="facility-img"></canvas>';
                    echo '<div class="play-icon"><i class="fa fa-play-circle"></i></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($video['title']) . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #000080; color: white;">
                <h5 class="modal-title"><i class="fa fa-video-camera me-2"></i><span id="videoTitle"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <video id="modalVideo" class="w-100" controls disableRemotePlayback controlsList="nodownload noplaybackrate nofullscreen">
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<section class="hymn-section" id="hymn">
    <div class="hymn-container">
        <h2 class="hymn-title">CCAI Hymn</h2>
        <div class="hymn-content">
            <div class="hymn-audio">
                <p class="hymn-audio-title"><i class="fa fa-music"></i> Listen to our School Hymn</p>
                <div class="hymn-audio-container">
                    <audio controls playsinline>
                        <source src="hymn.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="hymn-audio-visualizer">
                        <?php for($i = 0; $i < 20; $i++): ?>
                            <div class="visualizer-bar"></div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="hymn-lyrics">
                <p class="hymn-line" data-start="0" data-end="5">On this day we greet you</p>
                <p class="hymn-line" data-start="5" data-end="8">Alma Mater dear</p>
                <p class="hymn-line" data-start="8" data-end="10">Behold the victory possess</p>
                <p class="hymn-line" data-start="10" data-end="13">Triumphantly we hail!</p>
                <p class="hymn-line" data-start="13" data-end=15">T'was here that we learn</p>
                <p class="hymn-line" data-start="15" data-end="18">The golden things</p>
                <p class="hymn-line" data-start="18" data-end="23">We know something of everything</p>
                <p class="hymn-line" data-start="23" data-end="28">We sing thee praise and glory</p>
                <p class="hymn-line" data-start="28" data-end="33">Beloved CCA!</p>
                
                <p class="hymn-line" data-start="0" data-end="0">Chorus:</p>
                
                <p class="hymn-line" data-start="36" data-end="39">Time for us to roll call</p>
                <p class="hymn-line" data-start="39" data-end="42">Time for us to part</p>
                <p class="hymn-line" data-start="42" data-end="44">Darling school we love,</p>
                <p class="hymn-line" data-start="44" data-end="47">Thee deep into our hearts</p>
                <p class="hymn-line" data-start="47" data-end="52">Underneath the fire of lantern lights</p>
                <p class="hymn-line" data-start="52" data-end="57">We pray to God to guide us right</p>
                <p class="hymn-line" data-start="57" data-end="62">We sing thee Praise and Glory</p>
                <p class="hymn-line" data-start="62" data-end="67">Beloved CCA!</p>
                

                 <p class="hymn-line" data-start="0" data-end="0">"Repeat"</p>
            </div>
            <div class="hymn-note">
                <p><i class="fa fa-music"></i> Composed by: Felicisima Nazareno Poblete</p>
            </div>
        </div>
    </div>
</section>
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

<div class="modal fade" id="trackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #000080; color: white;">
        <h5 class="modal-title"><i class="fa fa-graduation-cap me-2"></i><span id="modalTrackTitle"></span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="modalTrackDescription"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="#" id="modalLearnMore" class="btn btn-primary">
          <i class="fa fa-info-circle me-2"></i>Learn More
        </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="strandModal" tabindex="-1" aria-labelledby="strandModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #000080; color: white;">
        <h5 class="modal-title" id="strandModalLabel">
          <i class="fa fa-graduation-cap me-2"></i>
          <span id="strandTitle"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h6 class="fw-bold mb-3">Description:</h6>
            <p id="strandDescription" class="mb-4"></p>
            
            <h6 class="fw-bold mb-3">Subjects Offered:</h6>
            <ul id="strandSubjects" class="list-group mb-4"></ul>
            
            <h6 class="fw-bold mb-3">Career Opportunities:</h6>
            <ul id="strandCareers" class="list-group"></ul>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #000080; color: white;">
                <h5 class="modal-title"><i class="fa fa-image me-2"></i><span id="imageTitle"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid w-100" alt="Facility Image">
            </div>
        </div>
    </div>
</div>

<script>
// Update the onclick handlers for academic track buttons
document.querySelectorAll('.card.h-100.w-100').forEach(button => {
    button.onclick = function(e) {
        e.preventDefault();
        const title = this.querySelector('.card-title').textContent;
        const description = this.querySelector('.card-text').textContent;
        
        // Update modal content
        document.getElementById('modalTrackTitle').textContent = title;
        document.getElementById('modalTrackDescription').textContent = description;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('trackModal'));
        modal.show();
    }
});

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

// Add logo animation handlers
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
});

const strandData = {
  'STEM': {
    title: 'Science, Technology, Engineering, and Mathematics',
    description: 'The STEM strand focuses on advanced concepts in Science, Technology, Engineering, and Mathematics. This strand is designed for students who wish to pursue careers in the fields of Science and Technology.',
    subjects: [
      'Pre-Calculus',
      'Basic Calculus',
      'General Chemistry',
      'General Physics',
      'General Biology',
      'Research in Daily Life'
    ],
    careers: [
      'Engineer',
      'Doctor',
      'Architect',
      'Information Technology Professional',
      'Research Scientist',
      'Mathematician'
    ]
  },
  'HUMSS': {
    title: 'Humanities and Social Sciences',
    description: 'The HUMSS strand is designed for students who intend to take up journalism, communication arts, liberal arts, education, and other social science-related courses in college.',
    subjects: [
      'Creative Writing',
      'Creative Nonfiction',
      'World Religions',
      'Philippine Politics',
      'Disciplines and Ideas in Social Sciences'
    ],
    careers: [
      'Lawyer',
      'Teacher',
      'Psychologist',
      'Journalist',
      'Social Worker',
      'Human Resource Manager'
    ]
  },
  'ABM': {
    title: 'Accountancy, Business and Management',
    description: 'The ABM strand focuses on the basic concepts of business, accounting, management, and economics. This strand is designed for students who want to pursue careers in business, finance, accounting, marketing, or entrepreneurship. The program develops leadership, problem-solving, and analytical skills essential in the corporate world.',
    subjects: [
      'Business Mathematics',
      'Business Finance',
      'Fundamentals of Accountancy',
      'Organization and Management', 
      'Principles of Marketing',
      'Applied Economics',
      'Business Ethics',
      'Strategic Management'
    ],
    careers: [
      'Certified Public Accountant',
      'Financial Analyst',
      'Business Manager/Administrator',
      'Entrepreneur',
      'Investment Banker',
      'Marketing Executive',
      'Human Resource Manager',
      'Management Consultant'
    ]
  },
  'Computer System Servicing (CSS) - NC2': {
    title: 'Computer System Servicing NC2',
    description: 'This track provides comprehensive training in computer hardware servicing, system maintenance, and basic networking. Students learn to assemble, install, maintain, andrepair computer systems and networks.',
    subjects: [
        'Computer Hardware Fundamentals',
        'Operating System Installation',
        'Network Configuration',
        'System Maintenance',
        'Troubleshooting Techniques',
        'Computer Assembly',
        'Basic Electronics',
        'Customer Service'
    ],
    careers: [
        'Computer Technician',
        'IT Support Specialist',
        'Hardware Maintenance Engineer',
        'Network Technician',
        'Service Center Technician',
        'Technical Support Representative',
        'Computer Shop Owner',
        'Systems Administrator'
    ]
  },

  'Computer Programming - NC3': {
    title: 'Computer Programming NC3',
    description: 'Advanced programming course focusing on software development, coding, and system design. Students learn multiple programming languages and modern development practices.',
    subjects: [
        'Programming Fundamentals',
        'Object-Oriented Programming',
        'Web Development',
        'Database Management',
        'Mobile App Development',
        'Systems Analysis and Design',
        'Software Testing',
        'Project Management'
    ],
    careers: [
        'Software Developer',
        'Web Developer',
        'Mobile App Developer',
        'Systems Analyst',
        'Database Administrator',
        'Quality Assurance Engineer',
        'IT Project Manager',
        'Full-Stack Developer'
    ]
  },

  'Food Beverages Services (FBS) - NC2': {
    title: 'Food and Beverage Services NC2',
    description: 'Focuses on professional food and beverage service operations in the hospitality industry. Students learn customer service, food safety, and restaurant operations.',
    subjects: [
        'Food Service Operations',
        'Beverage Service',
        'Customer Relations',
        'Food Safety and Sanitation',
        'Restaurant Operations',
        'Bar Operations',
        'Hospitality Management',
        'Table Service Procedures'
    ],
    careers: [
        'Restaurant Staff',
        'Bartender',
        'Food Service Manager',
        'Cruise Line Staff',
        'Hotel F&B Supervisor',
        'Catering Service Staff',
        'Bar Manager',
        'Restaurant Supervisor'
    ]
  },

  'Commercial Cooking - NC3': {
    title: 'Commercial Cooking NC3',
    description: 'Advanced culinary program focusing on professional cooking techniques, kitchen management, and food production for commercial settings.',
    subjects: [
        'Advanced Cooking Techniques',
        'Menu Planning and Cost Control',
        'Kitchen Management',
        'International Cuisine',
        'Food Production Management',
        'Garde Manger',
        'Food Styling',
        'Culinary Business Operations'
    ],
    careers: [
        'Executive Chef',
        'Restaurant Chef',
        'Food Production Manager',
        'Catering Manager',
        'Restaurant Owner',
        'Food Service Director',
        'Culinary Instructor',
        'Food Product Developer'
    ]
  },

  'Cookery - NC2': {
    title: 'Cookery NC2',
    description: 'Foundational cooking program teaching basic to intermediate culinary skills, food preparation, and kitchen operations.',
    subjects: [
        'Basic Cooking Methods',
        'Food Preparation',
        'Kitchen Safety',
        'Menu Planning',
        'Nutrition Basics',
        'Food Presentation',
        'Culinary Math',
        'Food Cost Control'
    ],
    careers: [
        'Line Cook',
        'Kitchen Staff',
        'Food Service Worker',
        'Catering Staff',
        'Personal Chef',
        'Food Prep Supervisor',
        'Kitchen Manager',
        'Small Restaurant Cook'
    ]
  },

  'Bread and Pastry Production - NC2': {
    title: 'Bread and Pastry Production NC2',
    description: 'Specialized program in baking and pastry arts, focusing on bread making, cake decoration, and pastry production techniques.',
    subjects: [
        'Basic Baking Science',
        'Bread Making',
        'Pastry Production',
        'Cake Decoration',
        'Chocolate Work',
        'Food Safety and Sanitation',
        'Cost Control',
        'Bakery Management'
    ],
    careers: [
        'Baker',
        'Pastry Chef',
        'Cake Decorator',
        'Bakery Owner',
        'Pastry Shop Manager',
               'Dessert Specialist',
        'Bread Making Specialist',
        'Quality Control Officer'
    ]
  }
};

// Update button handlers
document.querySelectorAll('.card.h-100.w-100').forEach(button => {
    button.onclick = function(e) {
        e.preventDefault();
        const title = this.querySelector('.card-title').textContent;
        const strandInfo = strandData[title];
        
        if (strandInfo) {
            // Update modal content
            document.getElementById('strandTitle').textContent = strandInfo.title;
            document.getElementById('strandDescription').textContent = strandInfo.description;
            
            // Update subjects list
            const subjectsList = document.getElementById('strandSubjects');
            subjectsList.innerHTML = strandInfo.subjects.map(subject => 
                `<li class="list-group-item">${subject}</li>`
            ).join('');
            
            // Update careers list
            const careersList = document.getElementById('strandCareers');
            careersList.innerHTML = strandInfo.careers.map(career => 
                `<li class="list-group-item">${career}</li>`
            ).join('');
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('strandModal'));
            modal.show();
        }
    };
});

function openImageModal(imgSrc, title) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imgSrc;
    document.getElementById('imageTitle').textContent = title;
    modal.show();
}

function openVideoModal(videoSrc, title) {
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    const video = document.getElementById('modalVideo');
    
    // Update video source and title
    video.querySelector('source').src = videoSrc;
    document.getElementById('videoTitle').textContent = title;
    
    // Completely disable audio
    video.removeAttribute('controlsList');
    video.setAttribute('controlsList', 'nodownload noplaybackrate nofullscreen noaudio');
    video.muted = true;
    video.defaultMuted = true;
    
    // Remove volume controls
    video.volume = 0;
    
    // Load and show modal
    video.load();
    modal.show();
    
    // Play video when modal opens
    document.getElementById('videoModal').addEventListener('shown.bs.modal', function () {
        video.play();
    });
    
    // Pause video when modal closes
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        video.pause();
    });
}

// Add this code to handle thumbnails
document.addEventListener('DOMContentLoaded', function() {
    const videoElements = document.querySelectorAll('.thumbnail-video');
    
    videoElements.forEach(video => {
        video.addEventListener('loadeddata', function() {
            // Set video to first frame
            video.currentTime = 0.1;
        });
        
        video.addEventListener('seeked', function() {
            // Get the canvas associated with this video
            const canvas = video.nextElementSibling.querySelector('canvas');
            // Set canvas size to match video dimensions
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            // Draw the video frame on the canvas
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        });
        
        // Trigger load
        video.load();
    });
});
</script>

    
  </body>
</html>

