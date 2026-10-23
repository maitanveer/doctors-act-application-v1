@extends('layouts.app')



@section('title', 'Texas Doctor’s Act (HB 2038) - Provisional Medical License Pathway')

@section('content')
    <div class="license-pathway-page">
        <!-- Hero Banner -->
        <section class="pathway-hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <div class="hero-badge-wrapper">
                                <span class="badge bg-primary mb-3">Texas House Bill 2038</span>
                                <div class="badge-glow"></div>
                            </div>
                            <h1 class="hero-title">
                                <span class="title-line text-white">Texas Provisional</span>
                                <span class="title-line highlight">Medical License</span>
                                <span class="title-line text-white">Pathway</span>
                            </h1>
                            <p class="hero-subtitle">
                                <i class="fas fa-globe-americas me-2" style="padding:20px"></i>For Foreign-Trained
                                Physicians
                            </p>
                            <p class="hero-description">
                                A strategic initiative to expand healthcare capacity in Texas while maintaining
                                the highest standards of medical practice and rigorous TMB oversight.
                            </p>
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">✓</span>
                                        <span class="stat-text">Strengthen Healthcare Readiness</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">✓</span>
                                        <span class="stat-text">Increase Physician Access</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">✓</span>
                                        <span class="stat-text">Uphold Texas Standards</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hero-actions mt-4">
                                <a href="#eligibility" class="btn btn-primary btn-lg me-3">
                                    <i class="fas fa-file-medical me-2" style="padding:10px"></i>View Requirements
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-user-plus me-2" style="padding:10px"></i>Register Now
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="hero-visual">
                            <div class="floating-card">
                                <div class="card-header">
                                    <i class="fas fa-file-contract"></i>
                                    <h4 class="text-white">HB 2038</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-white">Texas Doctor's Act</p>
                                    <small>Effective September 1, 2023</small>
                                </div>
                            </div>

                            <div class="tx-flag-container">
                                <div class="tx-flag">
                                    <div class="flag-stripe blue"></div>
                                    <div class="flag-stripe white">
                                        <div class="tx-star">★</div>
                                    </div>
                                    <div class="flag-stripe red"></div>
                                </div>
                                <div class="flag-glow"></div>
                            </div>

                            <div class="legal-badge floating">
                                <i class="fas fa-scale-balanced"></i>
                                <span>Texas Medical Board Regulated</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Animated Background Elements -->
            <div class="hero-bg-elements">
                <div class="bg-element element-1"></div>
                <div class="bg-element element-2"></div>
                <div class="bg-element element-3"></div>
                <div class="bg-element element-4"></div>
            </div>

            <!-- Scroll Indicator -->
            <div class="scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <style>
            .pathway-hero {
                background: linear-gradient(135deg,
                        #001f3f 0%,
                        #003366 25%,
                        #004080 50%,
                        #003366 75%,
                        #001f3f 100%);
                color: white;
                padding: 120px 0 100px;
                position: relative;
                overflow: hidden;
                min-height: 90vh;
                display: flex;
                align-items: center;
            }

            .pathway-hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background:
                    radial-gradient(circle at 20% 80%, rgba(0, 191, 255, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(191, 64, 191, 0.1) 0%, transparent 50%);
                animation: gradientShift 15s ease infinite;
            }

            @keyframes gradientShift {

                0%,
                100% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }
            }

            .hero-badge-wrapper {
                position: relative;
                display: inline-block;
            }

            .badge-glow {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 120%;
                height: 200%;
                background: rgba(0, 123, 255, 0.3);
                filter: blur(20px);
                z-index: 0;
                border-radius: 30px;
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 0.5;
                }

                50% {
                    opacity: 0.8;
                }
            }

            .hero-badge-wrapper .badge {
                position: relative;
                z-index: 1;
                background: linear-gradient(45deg, #0056b3, #007bff);
                border: 2px solid rgba(255, 255, 255, 0.2);
                padding: 12px 24px;
                font-size: 1rem;
                font-weight: 600;
                letter-spacing: 1px;
                text-transform: uppercase;
                border-radius: 30px;
                box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3);
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 800;
                margin-bottom: 1.5rem;
                line-height: 1.2;
            }

            .title-line {
                display: block;
                position: relative;
                animation: slideUp 0.8s ease-out forwards;
                opacity: 0;
            }

            .title-line:nth-child(1) {
                animation-delay: 0.2s;
            }

            .title-line:nth-child(2) {
                animation-delay: 0.4s;
            }

            .title-line:nth-child(3) {
                animation-delay: 0.6s;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .title-line.highlight {
                color: #4dabf7;
                text-shadow: 0 0 30px rgba(77, 171, 247, 0.5);
                position: relative;
                display: inline-block;
            }

            .title-line.highlight::after {
                content: '';
                position: absolute;
                bottom: 5px;
                left: 0;
                width: 100%;
                height: 8px;
                background: rgba(77, 171, 247, 0.2);
                border-radius: 4px;
                z-index: -1;
            }

            .hero-subtitle {
                font-size: 1.4rem;
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 2rem;
                display: flex;
                align-items: center;
                animation: fadeIn 1s ease-out 0.8s forwards;
                opacity: 0;
            }

            @keyframes fadeIn {
                to {
                    opacity: 1;
                }
            }

            .hero-description {
                font-size: 1.2rem;
                max-width: 600px;
                line-height: 1.8;
                color: rgba(255, 255, 255, 0.85);
                margin-bottom: 3rem;
                animation: fadeIn 1s ease-out 1s forwards;
                opacity: 0;
            }

            .hero-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 2rem;
                animation: fadeIn 1s ease-out 1.2s forwards;
                opacity: 0;
            }

            .stat-item {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 15px;
                transition: all 0.3s ease;
            }

            .stat-item:hover {
                background: rgba(255, 255, 255, 0.15);
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                background: rgba(77, 171, 247, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: #4dabf7;
            }

            .stat-content {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .stat-number {
                font-size: 1.2rem;
                color: #4dabf7;
                font-weight: 700;
            }

            .stat-text {
                font-size: 0.95rem;
                font-weight: 500;
            }

            .hero-actions {
                animation: fadeIn 1s ease-out 1.4s forwards;
                opacity: 0;
            }

            .btn-primary {
                background: linear-gradient(45deg, #0056b3, #007bff);
                border: none;
                padding: 15px 30px;
                font-weight: 600;
                border-radius: 50px;
                transition: all 0.3s ease;
                box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(0, 123, 255, 0.4);
            }

            .btn-outline-light {
                border: 2px solid rgba(255, 255, 255, 0.3);
                padding: 15px 30px;
                font-weight: 600;
                border-radius: 50px;
                transition: all 0.3s ease;
            }

            .btn-outline-light:hover {
                background: rgba(250, 249, 249, 0.1);
                border-color: white;
                transform: translateY(-3px);
            }

            /* Right side visualization */
            .hero-visual {
                position: relative;
                height: 400px;
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-20px);
                }
            }

            .floating-card {
                position: absolute;
                top: 20px;
                left: -40px;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                padding: 20px;
                width: 180px;
                z-index: 2;
                animation: floatCard 4s ease-in-out infinite;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            @keyframes floatCard {

                0%,
                100% {
                    transform: translateY(0) rotate(-5deg);
                }

                50% {
                    transform: translateY(-15px) rotate(0deg);
                }
            }

            .floating-card .card-header {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
                color: #4dabf7;
            }

            .floating-card h4 {
                margin: 0;
                font-weight: 700;
            }

            .floating-card p {
                margin: 0;
                font-size: 0.9rem;
                opacity: 0.9;
            }

            .floating-card small {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
            }

            .tx-flag-container {
                position: relative;
                width: 220px;
                height: 140px;
                margin: 40px auto;
            }

            .tx-flag {
                width: 100%;
                height: 100%;
                border-radius: 15px;
                overflow: hidden;
                position: relative;
                z-index: 2;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
                transition: transform 0.5s ease;
            }

            .tx-flag:hover {
                transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
            }

            .flag-glow {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 120%;
                height: 160%;
                background: linear-gradient(45deg, #002868, #bf0a30);
                filter: blur(40px);
                opacity: 0.5;
                animation: glowPulse 3s ease-in-out infinite;
            }

            @keyframes glowPulse {

                0%,
                100% {
                    opacity: 0.3;
                }

                50% {
                    opacity: 0.6;
                }
            }

            .flag-stripe {
                height: 33.33%;
                position: relative;
            }

            .flag-stripe.blue {
                background: #002868;
            }

            .flag-stripe.white {
                background: white;
            }

            .flag-stripe.red {
                background: #bf0a30;
            }

            .tx-star {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 50px;
                color: #002868;
                animation: starSpin 20s linear infinite;
            }

            @keyframes starSpin {
                from {
                    transform: translate(-50%, -50%) rotate(0deg);
                }

                to {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }

            .legal-badge.floating {
                position: absolute;
                bottom: 20px;
                right: -20px;
                background: linear-gradient(45deg, #004080, #0059b3);
                color: white;
                padding: 15px 25px;
                border-radius: 30px;
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                z-index: 3;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                animation: floatBadge 5s ease-in-out infinite;
            }

            @keyframes floatBadge {

                0%,
                100% {
                    transform: translateY(0) rotate(3deg);
                }

                50% {
                    transform: translateY(-10px) rotate(-3deg);
                }
            }

            .hero-bg-elements {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                pointer-events: none;
                overflow: hidden;
            }

            .bg-element {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.05);
            }

            .element-1 {
                top: 10%;
                right: 10%;
                width: 200px;
                height: 200px;
                animation: floatElement 20s linear infinite;
            }

            .element-2 {
                bottom: 20%;
                left: 5%;
                width: 150px;
                height: 150px;
                animation: floatElement 25s linear infinite reverse;
            }

            .element-3 {
                top: 50%;
                right: 20%;
                width: 100px;
                height: 100px;
                animation: floatElement 15s linear infinite;
            }

            .element-4 {
                bottom: 10%;
                right: 30%;
                width: 120px;
                height: 120px;
                animation: floatElement 30s linear infinite reverse;
            }

            @keyframes floatElement {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                }

                25% {
                    transform: translate(50px, -50px) rotate(90deg);
                }

                50% {
                    transform: translate(0, -100px) rotate(180deg);
                }

                75% {
                    transform: translate(-50px, -50px) rotate(270deg);
                }

                100% {
                    transform: translate(0, 0) rotate(360deg);
                }
            }

            .scroll-indicator {
                position: absolute;
                bottom: 30px;
                left: 50%;
                transform: translateX(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-size: 1.5rem;
                animation: bounce 2s ease infinite;
                cursor: pointer;
            }

            @keyframes bounce {

                0%,
                20%,
                50%,
                80%,
                100% {
                    transform: translateX(-50%) translateY(0);
                }

                40% {
                    transform: translateX(-50%) translateY(-10px);
                }

                60% {
                    transform: translateX(-50%) translateY(-5px);
                }
            }

            /* Responsive */
            @media (max-width: 992px) {
                .pathway-hero {
                    min-height: auto;
                    padding: 100px 0 80px;
                }

                .hero-title {
                    font-size: 2.8rem;
                }

                .hero-visual {
                    height: 350px;
                    margin-top: 50px;
                }

                .floating-card {
                    left: 10px;
                }

                .legal-badge.floating {
                    right: 10px;
                }
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.2rem;
                }

                .hero-subtitle {
                    font-size: 1.2rem;
                }

                .hero-stats {
                    grid-template-columns: 1fr;
                }

                .tx-flag-container {
                    width: 180px;
                    height: 120px;
                }

                .hero-actions .btn {
                    display: block;
                    width: 100%;
                    margin-bottom: 15px;
                }

                .hero-actions .me-3 {
                    margin-right: 0 !important;
                }
            }
        </style>

        @push('styles')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @endpush

        <!-- Mission Overview -->
        <section class="mission-overview section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Mission & Purpose</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="mission-card">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mission-content">
                                <h3 class="mission-title">Expanding Medical Capacity Across Texas</h3>
                                <p class="mission-description">
                                    The Texas Doctor's Act (HB 2038) establishes a new <strong>Provisional Medical
                                        License</strong>
                                    for qualified foreign-trained physicians. This innovative pathway addresses critical
                                    healthcare gaps while ensuring rigorous oversight by the Texas Medical Board (TMB).
                                </p>

                                <div class="mission-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon">
                                            <i class="fas fa-hospital"></i>
                                        </div>
                                        <div class="highlight-content">
                                            <h4>Focus Areas</h4>
                                            <p>Rural communities & medically underserved areas</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="highlight-content">
                                            <h4>Quality Assurance</h4>
                                            <p>Maintains strict Texas Medical Board oversight</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mission-objectives">
                                <h4 class="objectives-title">Primary Objectives</h4>
                                <br>

                                <div class="objectives-list">
                                    <div class="objective-item">
                                        <div class="objective-number">01</div>
                                        <div class="objective-content">
                                            <h5>Strengthen Healthcare Readiness</h5>
                                            <p>Build a robust medical workforce prepared for Texas' growing needs</p>
                                        </div>
                                    </div>
                                    <div class="objective-item">
                                        <div class="objective-number">02</div>
                                        <div class="objective-content">
                                            <h5>Increase Physician Access</h5>
                                            <p>Expand availability of qualified physicians in underserved regions</p>
                                        </div>
                                    </div>
                                    <div class="objective-item">
                                        <div class="objective-number">03</div>
                                        <div class="objective-content">
                                            <h5>Uphold Texas Standards</h5>
                                            <p>Ensure all licensed physicians meet Texas' high medical standards</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1: Eligibility Requirements -->
        <section class="eligibility-section section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Eligibility Requirements</h2>
                    <p class="section-subtitle">To qualify for the Provisional License, applicants must meet all criteria
                        below</p>
                    <div class="section-divider"></div>
                </div>

                <div class="eligibility-grid">
                    <!-- Requirement 1 -->
                    <div class="requirement-card">
                        <div class="requirement-header">
                            <div class="requirement-number">1</div>
                            <h3 class="requirement-title">Medical Education</h3>
                        </div>
                        <div class="requirement-body">
                            <ul class="requirement-list">
                                <li class="requirement-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span><strong>MD or equivalent</strong> medical degree</span>
                                </li>
                                <li class="requirement-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Medical school must qualify applicant for <strong>ECFMG
                                            eligibility</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Requirement 2 -->
                    <div class="requirement-card">
                        <div class="requirement-header">
                            <div class="requirement-number">2</div>
                            <h3 class="requirement-title">Foreign Licensure</h3>
                        </div>
                        <div class="requirement-body">
                            <ul class="requirement-list">
                                <li class="requirement-item">
                                    <i class="fas fa-id-card text-primary"></i>
                                    <span>Active medical license in <strong>good standing</strong> from another
                                        country</span>
                                </li>
                                <li class="requirement-item">
                                    <i class="fas fa-ban text-danger"></i>
                                    <span>No pending disciplinary action or professional sanctions</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Requirement 3 -->
                    <div class="requirement-card">
                        <div class="requirement-header">
                            <div class="requirement-number">3</div>
                            <h3 class="requirement-title">Postgraduate Training / Experience</h3>
                        </div>
                        <div class="requirement-body">
                            <div class="experience-path">
                                <div class="path-header">
                                    <h4>Path A — Countries requiring residency:</h4>
                                </div>
                                <div class="path-requirements">
                                    <div class="path-item">
                                        <div class="path-icon">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <div class="path-content">
                                            <strong>Completed residency</strong> or equivalent postgraduate training
                                        </div>
                                    </div>
                                    <div class="path-item">
                                        <div class="path-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <div class="path-content">
                                            Minimum <strong>5 years</strong> of post-residency clinical practice
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="experience-path">
                                <div class="path-header">
                                    <h4>Path B — Countries not requiring residency:</h4>
                                </div>
                                <div class="path-requirements">
                                    <div class="path-item">
                                        <div class="path-icon">
                                            <i class="fas fa-briefcase-medical"></i>
                                        </div>
                                        <div class="path-content">
                                            Minimum <strong>10 years</strong> of licensed medical practice following
                                            graduation
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Exam & Competency Requirements -->
        <section class="exams-section section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Exam & Competency Requirements</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="exams-grid">
                    <div class="exam-card">
                        <div class="exam-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h3 class="exam-title">Texas Medical Jurisprudence Examination</h3>
                        <div class="exam-badge required">Required</div>
                        <p class="exam-description">
                            Test knowledge of Texas medical laws, rules, and regulations
                        </p>
                    </div>

                    <div class="exam-card">
                        <div class="exam-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <h3 class="exam-title">USMLE Step 1 & Step 2</h3>
                        <div class="exam-badge required">Required</div>
                        <p class="exam-description">
                            Or statutory equivalents as recognized by Texas Medical Board
                        </p>
                    </div>

                    <div class="exam-card">
                        <div class="exam-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h3 class="exam-title">English Language Proficiency</h3>
                        <div class="exam-badge required">Required</div>
                        <p class="exam-description">
                            Demonstrated through approved testing (TOEFL, IELTS) or medical education in English
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Legal & Employment Requirements -->
        <section class="legal-section section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Legal & Employment Requirements</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="legal-card">
                            <div class="legal-card-header p-4">
                                <div class="legal-number">1</div>
                                <h3 class="legal-title text-white">Work Authorization</h3>
                            </div>
                            <div class="legal-card-body">
                                <p>Must be legally authorized to work in the United States</p>
                                <div class="legal-note">
                                    <i class="fas fa-passport"></i>
                                    <span>Valid work visa or permanent residency required</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="legal-card">
                            <div class="legal-card-header">
                                <div class="legal-number">2</div>
                                <h3 class="legal-title">Employment in Texas</h3>
                            </div>
                            <div class="legal-card-body">
                                <p>Must hold a verified job offer from a Texas healthcare facility:</p>
                                <ul class="facility-list">
                                    <li><i class="fas fa-hospital text-primary"></i> Hospital</li>
                                    <li><i class="fas fa-clinic-medical text-primary"></i> Facility-based practice</li>
                                    <li><i class="fas fa-users text-primary"></i> Group medical practice</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="legal-card">
                            <div class="legal-card-header">
                                <div class="legal-number">3</div>
                                <h3 class="legal-title">National Security Restrictions</h3>
                            </div>
                            <div class="legal-card-body">
                                <p>A provisional license cannot be issued to applicants who are citizens of:</p>
                                <div class="restriction-list">
                                    <div class="restriction-item">
                                        <i class="fas fa-flag-usa text-danger"></i>
                                        <span>Countries identified as U.S. national security concerns</span>
                                    </div>
                                    <div class="restriction-item">
                                        <i class="fas fa-ban text-danger"></i>
                                        <span>Countries subject to ITAR restrictions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: License Conditions -->
        <section class="license-conditions section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">License Conditions</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="condition-card">
                            <div class="condition-header">
                                <div class="condition-number">1</div>
                                <h3 class="condition-title">Duration</h3>
                            </div>
                            <div class="condition-body">
                                <div class="duration-display">
                                    <div class="duration-circle">
                                        <span class="duration-number">2</span>
                                        <span class="duration-unit">years</span>
                                    </div>
                                    <div class="duration-details">
                                        <p>Initial provisional license is valid for <strong>2 years</strong> from date of
                                            issuance</p>
                                        <small class="text-muted">Non-renewable under same conditions</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="condition-card">
                            <div class="condition-header">
                                <div class="condition-number">2</div>
                                <h3 class="condition-title">Approved Practice Settings</h3>
                                <span class="condition-subtitle">Initial License Period</span>
                            </div>
                            <div class="condition-body">
                                <p>Physician may only practice in:</p>
                                <div class="practice-settings">
                                    <div class="setting-item">
                                        <div class="setting-icon">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div class="setting-content">
                                            <strong>ACGME-affiliated</strong> facilities
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-icon">
                                            <i class="fas fa-school"></i>
                                        </div>
                                        <div class="setting-content">
                                            <strong>AOA-affiliated</strong> facilities
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-icon">
                                            <i class="fas fa-h-square"></i>
                                        </div>
                                        <div class="setting-content">
                                            Hospitals or clinical sites connected to <strong>accredited residency
                                                programs</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 5: Renewal Requirements -->
        <section class="renewal-section section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Renewal Requirements</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="renewal-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="renewal-card">
                                <h3 class="renewal-card-title">Requirements for Renewal</h3>
                                <p>To renew the provisional license, physicians must:</p>
                                <ul class="renewal-checklist">
                                    <li>
                                        <i class="fas fa-certificate text-success"></i>
                                        Hold a valid <strong>ECFMG certificate</strong>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-double text-success"></i>
                                        Have passed <strong>USMLE Step 1 and Step 2</strong> (or equivalents)
                                    </li>
                                    <li>
                                        <i class="fas fa-file-contract text-success"></i>
                                        Maintain <strong>good standing</strong> with Texas Medical Board
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="renewal-card">
                                <h3 class="renewal-card-title">Practice Restrictions After Renewal</h3>
                                <p>Renewed license holders may only work in:</p>
                                <div class="restriction-areas">
                                    <div class="area-item rural">
                                        <div class="area-icon">
                                            <i class="fas fa-tractor"></i>
                                        </div>
                                        <div class="area-content">
                                            <h5>Rural Areas</h5>
                                            <small>Designated rural counties</small>
                                        </div>
                                    </div>
                                    <div class="area-item mua">
                                        <div class="area-icon">
                                            <i class="fas fa-clinic-medical"></i>
                                        </div>
                                        <div class="area-content">
                                            <h5>Medically Underserved Areas (MUA)</h5>
                                            <small>HRSA-designated shortage areas</small>
                                        </div>
                                    </div>
                                    <div class="area-item hpsa">
                                        <div class="area-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <div class="area-content">
                                            <h5>Health Professional Shortage Areas (HPSA)</h5>
                                            <small>Primary care shortage regions</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 6: Pathway to Full License -->
        <section class="pathway-full section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Pathway to Full Texas Medical Licensure</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="pathway-timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-circle"></div>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">Experience Requirement</h4>
                            <p>Complete <strong>4 of the previous 7 years</strong> of active practice under the provisional
                                license</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-circle"></div>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">Examination Requirements</h4>
                            <p>Meet all Texas Medical Board examination and fitness requirements</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-circle"></div>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">Potential Denial Factors</h4>
                            <p>The TMB may deny full licensure if the applicant has:</p>
                            <div class="denial-factors">
                                <span class="badge bg-danger text-white">Criminal convictions</span>
                                <span class="badge bg-warning text-dark text-white">Misconduct</span>
                                <span class="badge bg-secondary text-white">Active investigations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: Disqualifying Factors -->
        <section class="disqualifying-section section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Disqualifying Factors</h2>
                    <div class="section-divider"></div>
                </div>

                <div class="disqualifying-grid">
                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-shield-alt text-danger"></i>
                        </div>
                        <h4>National Security Restrictions</h4>
                        <p>Citizenship in restricted countries</p>
                    </div>

                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-gavel text-danger"></i>
                        </div>
                        <h4>Criminal Offenses</h4>
                        <p>Certain felony convictions</p>
                    </div>

                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-user-slash text-danger"></i>
                        </div>
                        <h4>Misrepresentation</h4>
                        <p>False credentials or documentation</p>
                    </div>

                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <h4>Disciplinary History</h4>
                        <p>Unresolved professional sanctions</p>
                    </div>

                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-file-signature text-danger"></i>
                        </div>
                        <h4>Fraudulent Documentation</h4>
                        <p>False or altered documents</p>
                    </div>

                    <div class="disqualify-card">
                        <div class="disqualify-icon">
                            <i class="fas fa-user-shield text-danger"></i>
                        </div>
                        <h4>Military Discharge</h4>
                        <p>Discharge for misconduct</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 8: Official Resources -->
        <section class="resources-section section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Official Resources</h2>
                    <p class="section-subtitle">For compliance and updates, refer to official sources</p>
                    <div class="section-divider"></div>
                </div>

                <div class="resources-grid">
                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-scale-balanced text-primary"></i>
                        </div>
                        <h4 class="resource-title text-white">Texas Medical Board (TMB)</h4>
                        <p class="resource-description">Primary regulatory authority for medical licensure</p>
                        <a href="https://www.tmb.state.tx.us/" class="resource-link" target="_blank" rel="noopener noreferrer">Visit TMB Website <i
                                class="fas fa-external-link-alt"></i></a>
                    </div>

                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-file-contract text-success"></i>
                        </div>
                        <h4 class="resource-title text-white">Texas Legislature – HB 2038</h4>
                        <p class="resource-description">Official bill text and legislative history</p>
                        <a href="https://capitol.texas.gov/" class="resource-link" target="_blank" rel="noopener noreferrer">View Bill Text <i
                                class="fas fa-external-link-alt"></i></a>
                    </div>

                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-newspaper text-info"></i>
                        </div>
                        <h4 class="resource-title">Texas Register</h4>
                        <p class="resource-description">Rulemaking updates and official notices</p>
                        <a href="https://www.sos.state.tx.us/texreg/" class="resource-link" target="_blank" rel="noopener noreferrer">Check Updates <i
                                class="fas fa-external-link-alt"></i></a>
                    </div>

                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-ambulance text-danger"></i>
                        </div>
                        <h4 class="resource-title">HRSA Designations</h4>
                        <p class="resource-description">HPSA/MUA official designations</p>
                        <a href="https://data.hrsa.gov/" class="resource-link" target="_blank" rel="noopener noreferrer">Find Areas <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section section-padding bg-primary text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="cta-title">Ready to Begin Your Texas Medical Journey?</h2>
                        <p class="cta-description">Contact us for guidance through the provisional license application
                            process</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('application') }}" class="btn btn-dark btn-lg">
                            <i class="fas fa-file-medical me-2"></i> Go to the Application
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Base Styles */
        :root {
            --primary-color: #003366;
            --secondary-color: #bf0a30;
            --accent-color: #015529;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        .license-pathway-page {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .section-padding {
            padding: 80px 0;
        }

        /* Hero Section */
        .pathway-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, #002244 100%);
            color: white;
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .pathway-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .hero-content .badge {
            font-size: 0.9rem;
            padding: 8px 16px;
            background: var(--secondary-color);
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1.1rem;
            max-width: 600px;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-number {
            font-size: 1.5rem;
            color: var(--success-color);
        }

        .stat-text {
            font-weight: 500;
        }

        .tx-flag {
            width: 200px;
            height: 120px;
            margin: 0 auto;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .flag-stripe {
            height: 33.33%;
        }

        .flag-stripe.blue {
            background: #002868;
        }

        .flag-stripe.white {
            background: white;
            position: relative;
        }

        .flag-stripe.red {
            background: #bf0a30;
        }

        .tx-star {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            color: #002868;
        }

        .legal-badge {
            background: white;
            color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }


        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto 1rem;
        }

        .section-divider {
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            margin: 20px auto;
            border-radius: 2px;
        }

        /* Mission Overview */
        .mission-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .mission-title {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .mission-description {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            color: #555;
        }

        .mission-highlights {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .highlight-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .highlight-icon {
            width: 50px;
            height: 50px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--accent-color);
        }

        .highlight-content h4 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: var(--dark-color);
        }

        .objectives-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .objective-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .objective-number {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .objective-content h5 {
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .objective-content p {
            color: #666;
            margin: 0;
        }

        /* Eligibility Grid */
        .eligibility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .requirement-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            border-top: 5px solid var(--accent-color);
        }

        .requirement-card:hover {
            transform: translateY(-5px);
        }

        .requirement-header {
            background: var(--light-color);
            padding: 25px;
            border-bottom: 1px solid #eee;
        }

        .requirement-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .requirement-title {
            font-size: 1.4rem;
            color: var(--dark-color);
            margin: 0;
        }

        .requirement-body {
            padding: 25px;
        }

        .requirement-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .requirement-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
        }

        .requirement-item i {
            margin-top: 3px;
            flex-shrink: 0;
        }

        .experience-path {
            background: var(--light-color);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .experience-path:last-child {
            margin-bottom: 0;
        }

        .path-header h4 {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .path-requirements {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .path-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .path-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            flex-shrink: 0;
        }

        /* Exams Grid */
        .exams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .exam-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .exam-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
        }

        .exam-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .exam-title {
            font-size: 1.3rem;
            color: var(--dark-color);
            margin-bottom: 15px;
        }

        .exam-badge {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .exam-badge.required {
            background: var(--success-color);
        }

        .exam-description {
            color: #666;
            margin-bottom: 10px;
        }

        /* Legal Cards */
        .legal-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .legal-card-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            position: relative;
        }

        .legal-number {

            left: 25px;
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .legal-title {
            font-size: 1.3rem;
            color: white;
            padding-left: 50px;
        }

        .legal-card-body {
            padding: 25px;
        }

        .facility-list {
            list-style: none;
            padding: 0;
            margin: 15px 0 0 0;
        }

        .facility-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding: 8px;
            background: var(--light-color);
            border-radius: 8px;
        }

        .restriction-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 15px;
        }

        .restriction-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: rgba(220, 53, 69, 0.1);
            border-left: 4px solid var(--danger-color);
            border-radius: 0 8px 8px 0;
        }

        /* License Conditions */
        .condition-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .condition-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-color);
        }

        .condition-number {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .condition-title {
            font-size: 1.4rem;
            color: var(--dark-color);
            margin: 0;
        }

        .condition-subtitle {
            font-size: 0.9rem;
            color: #666;
            margin-left: auto;
        }

        .duration-display {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .duration-circle {
            width: 120px;
            height: 120px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .duration-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .duration-unit {
            font-size: 1rem;
        }

        .practice-settings {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .setting-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: var(--light-color);
            border-radius: 10px;
        }

        .setting-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        /* Renewal Section */
        .renewal-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .renewal-card-title {
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-color);
        }

        .renewal-checklist {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .renewal-checklist li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            padding: 12px;
            background: var(--light-color);
            border-radius: 8px;
        }

        .renewal-checklist li:last-child {
            margin-bottom: 0;
        }

        .restriction-areas {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .area-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 10px;
            background: var(--light-color);
        }

        .area-item.rural {
            border-left: 4px solid #28a745;
        }

        .area-item.mua {
            border-left: 4px solid #17a2b8;
        }

        .area-item.hpsa {
            border-left: 4px solid #ffc107;
        }

        .area-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .area-item.rural .area-icon {
            color: #28a745;
        }

        .area-item.mua .area-icon {
            color: #17a2b8;
        }

        .area-item.hpsa .area-icon {
            color: #ffc107;
        }

        .area-content h5 {
            font-size: 1.1rem;
            margin-bottom: 3px;
            color: var(--dark-color);
        }

        .area-content small {
            color: #666;
            font-size: 0.85rem;
        }

        /* Pathway Timeline */
        .pathway-timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .pathway-timeline::before {
            content: '';
            position: absolute;
            left: 50px;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-color);
            transform: translateX(-50%);
        }

        .timeline-item {
            display: flex;
            margin-bottom: 40px;
            position: relative;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            width: 100px;
            flex-shrink: 0;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .marker-circle {
            width: 20px;
            height: 20px;
            background: var(--primary-color);
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 0 0 3px var(--primary-color);
        }

        .timeline-content {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .timeline-title {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .denial-factors {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        /* Disqualifying Grid */
        .disqualifying-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .disqualify-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--danger-color);
            transition: transform 0.3s ease;
        }

        .disqualify-card:hover {
            transform: translateY(-5px);
        }

        .disqualify-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .disqualify-card h4 {
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .disqualify-card p {
            color: #666;
            margin: 0;
            font-size: 0.95rem;
        }

        /* Resources Grid */
        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .resource-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .resource-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
        }

        .resource-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .resource-title {
            font-size: 1.3rem;
            /* color: var(--primary-color); */
            margin-bottom: 10px;
        }

        .resource-description {
            color: #666;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .resource-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: gap 0.3s ease;
        }

        .resource-link:hover {
            gap: 12px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #002244 100%);
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.2rem;
            opacity: 0.9;
            color: white;
            margin: 0;
        }

        .btn-light {
            background: white;
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: var(--light-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .duration-display {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .pathway-hero {
                padding: 80px 0 40px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-padding {
                padding: 60px 0;
            }

            .mission-card {
                padding: 30px 20px;
            }

            .eligibility-grid,
            .exams-grid,
            .disqualifying-grid,
            .resources-grid {
                grid-template-columns: 1fr;
            }

            .pathway-timeline::before {
                left: 30px;
            }

            .timeline-marker {
                width: 60px;
            }
        }

        @media (max-width: 576px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-title {
                font-size: 1.5rem;
            }

            .cta-description {
                font-size: 1rem;
            }
        }
    </style>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush



    @push('styles')
        <style>
            .header .header-inner {
                background: #fff;
                z-index: 999;
                width: 100%;
            }

            body {
                font-family: "Poppins", sans-serif;
                font-weight: 400;
                font-size: 14px;
                color: #888;
            }

            /* Home page specific styles */
            .hero-section {
                background: linear-gradient(135deg, #001f3f, #003366);
                background-size: cover;
                background-position: center;
                color: white;
                padding: 100px 0;
                text-align: center;
            }

            .services-preview {
                padding: 80px 0;
            }

            .service-card {
                text-align: center;
                padding: 30px;
                border: 1px solid #ddd;
                border-radius: 10px;
                transition: transform 0.3s;
            }

            .service-card:hover {
                transform: translateY(-10px);
            }

            .service-card i {
                font-size: 48px;
                color: #015529;
                margin-bottom: 20px;
            }

            .glowing-text .btn {
                background: linear-gradient(45deg, #015529, #028a3f);
                color: white;
                padding: 10px 30px;
                border-radius: 30px;
                font-weight: bold;
                text-transform: uppercase;
                position: relative;
                overflow: hidden;
            }

            .glowing-text .btn span {
                position: relative;
                z-index: 1;
            }

            .glowing-text .btn:before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                transition: 0.5s;
            }

            .glowing-text .btn:hover:before {
                left: 100%;
            }
        </style>
    @endpush
@endsection
