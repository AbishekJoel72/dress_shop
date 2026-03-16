<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


    body {
        font-family: 'Poppins', sans-serif;
    }













    /*---------------------- Home ----------------------*/

    #header {
        position: fixed;
        top: 0;
        width: 100%;
        height: 85px;
        padding: 15px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        transition: all 0.1s ease;

    }

    #header.scrolled {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        height: 75px;
        backdrop-filter: blur(12px);
    }

    #header h5 {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(90deg, #ffffff, #ffe6e6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 1px;
        position: relative;
    }

    #header h5::after {
        content: '👗';
        position: absolute;
        right: -35px;
        top: -5px;
        font-size: 1.5rem;
        -webkit-text-fill-color: initial;
        filter: drop-shadow(0 0 5px #e62a49);
    }

    #header img {
        transition: transform 0.4s ease;
        border-radius: 10px;
    }

    #header img:hover {
        transform: scale(1.08) rotate(2deg);
        filter: drop-shadow(0 5px 15px rgba(230, 42, 73, 0.3));
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 35px;
        margin: 0;
        padding: 0;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: 1.1rem;
        position: relative;
        transition: all 0.3s ease;
        padding: 5px 0;
        letter-spacing: 0.5px;
    }



    .nav-links a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        transition: width 0.4s ease;
        border-radius: 0px;
    }

    .nav-links a:hover::after {
        width: 100%;
    }



    .nav-links a.login-btn:hover {
        border-color: #9b87f2;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(155, 135, 242, 0.3);
    }






    /* ===== HERO CAROUSEL ===== */
    #heroCarousel {
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    #heroCarousel .carousel-inner,
    #heroCarousel .carousel-item {
        height: 100vh;
    }

    .hero-slide {
        height: 100vh;
        object-fit: cover;
        filter: brightness(70%);
        animation: zoomEffect 15s infinite alternate;
    }

    @keyframes zoomEffect {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.1);
        }
    }

    /* Gradient Overlay - Your Colors */
    .carousel-item::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .carousel-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        z-index: 1;
    }

    .hero-content {
        bottom: 50%;
        transform: translateY(50%);
        animation: fadeUp 1.5s ease;
        z-index: 3;
        text-align: center;
        left: 0;
        right: 0;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(80%);
        }

        to {
            opacity: 1;
            transform: translateY(50%);
        }
    }

    .hero-content h1 {
        font-size: 4.2rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 15px;
        background:  #ffffff;
        -webkit-background-clip: text;
        background-size: 300% auto;
        animation: gradientFlow 8s ease infinite;
    }

    @keyframes gradientFlow {
        0% {
            background-position: 0% center;
        }

        50% {
            background-position: 100% center;
        }

        100% {
            background-position: 0% center;
        }
    }

    .hero-content p {
        font-size: 1.4rem;
        letter-spacing: 2px;
        margin-top: 10px;
        margin-bottom: 30px;
        color: #ffffff;
        text-shadow: 0 2px 15px #9b87f2;
        background: rgba(0, 0, 0, 0.15);
        padding: 10px 30px;
        border-radius: 60px;
        display: inline-block;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(155, 135, 242, 0.3);
        font-weight: 300;
    }



    .hero-content .btn:hover::before {
        left: 100%;
    }


    /* Indicators */
    .carousel-indicators {
        bottom: 30px;
        gap: 12px;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        border: 2px solid #9b87f2;
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        background: #e62a49;
        transform: scale(1.4);
        border-color: white;
        box-shadow: 0 0 15px #e62a49;
    }

    /* Menu Toggle */
    .menu-toggle {
        display: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #e62a49, #9b87f2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .menu-toggle:hover {
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 0 20px #e62a49;
    }

    /* Responsive */
    @media (max-width: 992px) {
        #header {
            padding: 15px 30px;
        }

        .hero-content h1 {
            font-size: 3.2rem;
        }
    }

    @media (max-width: 768px) {
        #header {
            padding: 15px 20px;
            height: 75px;
        }

        .nav-links {
            display: none;
            position: absolute;
            top: 75px;
            left: 0;
            width: 100%;
            background: linear-gradient(90deg, #e62a49, #9b87f2);
            backdrop-filter: blur(12px);
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 30px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-links.active {
            display: flex;
        }

        .menu-toggle {
            display: flex;
        }

        .hero-content h1 {
            font-size: 2.2rem;
            letter-spacing: 2px;
        }

        .hero-content p {
            font-size: 1rem;
            padding: 8px 20px;
        }

        .hero-content .btn {
            padding: 12px 30px;
            font-size: 1rem;
        }

        #header h5::after {
            right: -30px;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 1.8rem;
        }

        .hero-content p {
            font-size: 0.9rem;
        }
    }
















































    /*---------------------- About ----------------------*/
  #about-full {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

#about-full::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(230, 42, 73, 0.03) 0%, rgba(230, 42, 73, 0) 70%);
    border-radius: 50%;
    z-index: 0;
}

#about-full::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(155, 135, 242, 0.03) 0%, rgba(155, 135, 242, 0) 70%);
    border-radius: 50%;
    z-index: 0;
}

.container {
    position: relative;
    z-index: 2;
}

.row {
    position: relative;
}

#about-full h2 {
    font-size: 3.2rem;
    margin-bottom: 25px;
    background:  #000;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
    letter-spacing: -0.02em;
    position: relative;
    display: inline-block;
}

#about-full h2::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
    border-radius: 4px;
}

#about-full p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #4a4a4a;
    margin-bottom: 25px;
    font-weight: 300;
    position: relative;
    padding-left: 20px;
    border-left: 2px solid rgba(230, 42, 73, 0.2);
    transition: all 0.3s ease;
}

#about-full p:hover {
    border-left-color: #e62a49;
    padding-left: 25px;
}

#about-full p strong {
    color: #e62a49;
    font-weight: 600;
}


.about-slideshow {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    /* box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.3); */
}

.about-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 1.5s ease-in-out;

}

.about-img.active {
    opacity: 1;
    z-index: 1;
}


.col-lg-6:first-child {
    position: relative;
}






.col-lg-6:first-child .decorative-kids {
    position: absolute;
    top: 50%;
    left: -20px;
    font-size: 2.5rem;
    color: #9b87f2;
    opacity: 0.1;
    transform: translateY(-50%);
}

/* Animation */
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

.row > div {
    animation: fadeInUp 0.8s ease forwards;
}

.col-lg-6:first-child {
    animation-delay: 0.2s;
}

.col-lg-6:last-child {
    animation-delay: 0.4s;
}








































    /*---------------------- Product ----------------------*/

    #products {
        min-height: 100vh;
        padding: 120px 0 80px;
        background: #faf9f7;
    }

    #products h2 {
        font-size: 3rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        background: linear-gradient(145deg, #1e1e1e, #4a4a4a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 3rem !important;
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
    }

    #products h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 20%;
        width: 60%;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e62a49, #9b87f2, transparent);
        border-radius: 3px;
    }

    .product-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background: white;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.15, 0.75, 0.4, 1);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 45px -12px rgba(230, 42, 73, 0.25);
    }

    /* Carousel container */
    .carousel-slides {
        position: relative;
        width: 100%;
        height: 350px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .carousel-slides img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        transform: scale(1.02);
    }

    .carousel-slides img.active {
        opacity: 1;
        z-index: 2;
    }

    /* subtle zoom on hover */
    .product-card:hover .carousel-slides img {
        transform: scale(1.08);
        transition: transform 6s linear;
    }

    .card-body {
        padding: 1.5rem 1rem 1.8rem;
        background: white;
        position: relative;
        z-index: 3;
    }

    .card-body h6 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #222;
        letter-spacing: -0.01em;
    }

    .card-body .price {
        font-size: 1.4rem;
        font-weight: 700;
        color: #e62a49;
        margin: 0.3rem 0 1rem;
        background: linear-gradient(145deg, #e62a49, #b11e36);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }



    .product-card:hover .quick-view {
        opacity: 1;
        transform: translateY(0);
    }

    .quick-view:hover {
        background: #e62a49;
        color: white;
        border-color: #e62a49;
    }

    /* Dots indicator for carousel (optional) */
    .carousel-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        z-index: 5;
    }

    .carousel-dots span {
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        cursor: pointer;
        transition: 0.3s;
    }

    .carousel-dots span.active {
        background: white;
        transform: scale(1.2);
    }




































    /*---------------------- Contact ----------------------*/
    #contact-section {
        padding-top: 100px;
        padding-bottom: 80px;
        background: linear-gradient(145deg, #f5f0ff 0%, #fff4f0 100%);
        position: relative;
        overflow: hidden;
    }

    #contact-section::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(230, 42, 73, 0.03) 0%, transparent 70%);
        /* border-radius: 50%; */
        z-index: 0;
    }

    #contact-section::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -5%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(155, 135, 245, 0.04) 0%, transparent 70%);
        /* border-radius: 50%; */
        z-index: 0;
    }

    .contact-wrapper {
        width: 100%;
        padding-left: 100px;
        padding-right: 60px;
        position: relative;
        z-index: 2;
    }

    .contact-box {
        width: 100%;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        /* border-radius: 40px; */
        
        box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
        padding: 20px 0px;
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    /* LEFT SIDE */
    .contact-left {
        border-right: 1px solid rgba(230, 42, 73, 0.15);
        padding-right: 35px;
        position: relative;
    }

    .contact-left .title {
        font-size: 2.8rem;
        font-weight: 700;
        background: #000;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }

    .contact-left .title::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #e62a49, #9b87f2);
        border-radius: 4px;
    }



    .contact-left p strong {
        color: #e62a49;
        font-weight: 600;
        min-width: 100px;
        display: inline-block;
    }

    .map {
        width: 100%;
        height: 240px;
        border-radius: 24px;
        border: 0;
        margin-top: 25px;
        box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.15);
        filter: grayscale(15%) contrast(1.02);
        transition: all 0.4s ease;
    }

    .map:hover {
        filter: grayscale(0%);
        box-shadow: 0 20px 35px -5px rgba(230, 42, 73, 0.2);
    }

    /* RIGHT SIDE */
    .contact-right .title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #1e1e1e;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }


    .contact-right .form-control {
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 15px 20px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
    }

    .contact-right .form-control:focus {
        border-color: #e62a49;
        box-shadow: 0 8px 20px rgba(230, 42, 73, 0.12);
        background: white;
        transform: scale(1.02);
    }

    .contact-right textarea {
        border-radius: 20px;
        resize: vertical;
        min-height: 100px;
    }

    .submit-btn {
        background: linear-gradient(145deg, #e62a49, #b11e36);
        color: white;
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(230, 42, 73, 0.3);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
        font-size: 1.1rem;
        cursor: pointer;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }


    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:active {
        transform: translateY(0);
    }




    /* Floating animation for form */
    @keyframes gentleFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .contact-box {
        animation: gentleFloat 6s ease-in-out infinite;
    }













































    /*---------------------- Footer ----------------------*/
    footer {
        background: linear-gradient(145deg, #0a0a0a 0%, #1a1a1a 100%);
        color: #eee;
        padding: 70px 0 20px 0;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(230, 42, 73, 0.2);
    }

    /* Decorative elements */
    footer::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(230, 42, 73, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    footer::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(155, 135, 245, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    footer .container {
        position: relative;
        z-index: 2;
    }

    footer .brand {
        font-weight: 800;
        font-size: 28px;
        background: linear-gradient(135deg, #ffffff 0%, #e62a49 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }

    footer .brand::after {
        content: '✨';
        position: absolute;
        right: -30px;
        top: 0;
        font-size: 20px;
        opacity: 0.7;
    }

    footer p {
        margin-bottom: 12px;
        color: #aaa;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    footer h5 {
        color: white;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    footer h5::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #e62a49, #9b87f2);
        border-radius: 3px;
    }

    .footer-links {
        list-style: none;
        padding-left: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
        transition: transform 0.3s ease;
    }

    .footer-links li:hover {
        transform: translateX(8px);
    }

    footer a {
        color: #bbb;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        padding-bottom: 2px;
    }

    footer a:hover {
        color: #e62a49;
    }

    footer a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background: #e62a49;
        transition: width 0.3s ease;
    }

    footer a:hover::after {
        width: 100%;
    }

    /* Contact details with icons */
    footer .col-md-4:last-child p {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    footer .col-md-4:last-child p:hover {
        background: rgba(230, 42, 73, 0.05);
        border-color: rgba(230, 42, 73, 0.2);
        transform: translateX(5px);
    }

    footer .col-md-4:last-child i {
        color: #e62a49;
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
    }

    /* Social icons */
    .social-icons {
        margin-top: 25px;
    }

    .social-icons a {
        display: inline-block;
        margin-right: 12px;
        font-size: 18px;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(230, 42, 73, 0.2);
    }

    .social-icons a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .social-icons a:hover {
        background: linear-gradient(145deg, #e62a49, #b11e36);
        color: white;
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 20px -5px rgba(230, 42, 73, 0.4);
        border-color: transparent;
    }

    .social-icons a:hover::before {
        left: 100%;
    }

    /* Facebook specific hover */
    .social-icons a:nth-child(1):hover {
        background: #1877f2;
        background: linear-gradient(145deg, #1877f2, #0d5ab9);
    }

    /* Instagram specific hover */
    .social-icons a:nth-child(2):hover {
        background: radial-gradient(circle at 30% 30%, #fdf497, #fd5949, #d6249f, #285AEB);
    }

    /* WhatsApp specific hover */
    .social-icons a:nth-child(3):hover {
        background: #25D366;
        background: linear-gradient(145deg, #25D366, #128C7E);
    }

    /* Horizontal rule */
    footer hr {
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(230, 42, 73, 0.3), #9b87f2, rgba(230, 42, 73, 0.3), transparent);
        margin: 30px 0 20px;
        opacity: 0.5;
    }

    .copy {
        font-size: 0.9rem;
        opacity: 0.7;
        letter-spacing: 0.5px;
        position: relative;
        display: inline-block;
        padding: 5px 20px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 50px;
        margin-top: 10px;
    }

    .text-center.copy {
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
        position: relative;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    footer .row>div {
        animation: fadeInUp 0.6s ease forwards;
    }

    footer .row>div:nth-child(1) {
        animation-delay: 0.1s;
    }

    footer .row>div:nth-child(2) {
        animation-delay: 0.2s;
    }

    footer .row>div:nth-child(3) {
        animation-delay: 0.3s;
    }

    /* Responsive */
    @media (max-width: 768px) {
        footer {
            padding: 50px 0 20px 0;
        }

        footer .brand {
            font-size: 24px;
        }

        footer .brand::after {
            right: -25px;
            font-size: 16px;
        }

        footer h5::after {
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
        }

        footer h5 {
            display: block;
            text-align: center;
        }

        .footer-links {
            text-align: center;
        }

        .footer-links li:hover {
            transform: translateX(0) scale(1.05);
        }

        footer .col-md-4:last-child p {
            justify-content: center;
        }

        .social-icons {
            text-align: center;
        }
    }

    /* Menu toggle (existing) */
    .menu-toggle {
        display: none;
        color: white;
        font-size: 30px;
    }
</style>
