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
        height: 80px;
        padding: 14px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        background: transparent;
        transition: all 0.4s ease;
    }

    #header.scrolled {
        background: #0092ca;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(6px);
    }

    #header img {
        transition: transform 0.3s ease;
    }

    #header img:hover {
        transform: scale(1.05);
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 30px;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        position: relative;
    }

    .nav-links a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -6px;
        width: 0;
        height: 2px;
        background: #fff;
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
        width: 100%;
    }


    #heroCarousel {
        height: 100vh;
    }

    #heroCarousel .carousel-inner,
    #heroCarousel .carousel-item {
        height: 100vh;
    }
    .hero-slide {
        height: 100vh;
        object-fit: cover;
        filter: brightness(65%);
    }

    .hero-content {
        bottom: 50%;
        transform: translateY(50%);
        text-align: center;
    }

    .hero-content h1 {
        font-size: 3.2rem;
        font-weight: 700;
        text-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
    }

    .hero-content p {
        font-size: 1.2rem;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    .hero-content .btn {
        padding: 12px 28px;
        border-radius: 30px;
        font-weight: 600;
    }









  /*---------------------- About ----------------------*/
    #about-full {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    .about-img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }
    #about-full h2 {
        font-size: 2.8rem;
        margin-bottom: 20px;
    }

    #about-full p {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #555;
    }












  /*---------------------- Product ----------------------*/
    #products {
        min-height: 100vh;
        padding-top: 120px;
    }


    .product-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        transition: .4s;
    }

    .product-card img {
        height: 350px;
        width: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    .product-card:hover {
        transform: translateY(-8px);
    }














  /*---------------------- Contact ----------------------*/
    #contact-section {
        padding-top: 100px;
        padding-bottom: 60px;
        background: linear-gradient(135deg, #f8fafc, #e9f0ff);
    }


    .contact-wrapper {
        width: 100%;
        padding-left: 100px;
        padding-right: 60px;
    }


    .contact-box {
        width: 100%;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, .12);
        padding: 40px 30px;
    }


    .title {
        font-weight: 800;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #666;
        margin-bottom: 15px;
    }


    .contact-left {
        border-right: 2px dashed #ddd;
        padding-right: 25px;
    }

    .map {
        width: 100%;
        height: 250px;
        border-radius: 15px;
        border: 0;
        margin-top: 15px;
    }


    .contact-right .form-control {
        border-radius: 12px;
        border: 1px solid #ccc;
    }

    .contact-right textarea {
        border-radius: 12px;
    }


    .submit-btn {
        background: black;
        color: white;
        padding: 12px 34px;
        border-radius: 30px;
        font-weight: 600;
    }


    .border-divider {
        border-right: 1px solid #ddd;
    }













  /*---------------------- Footer ----------------------*/
    footer {
        background: #0c0c0c;
        color: #eee;
        padding: 50px 0 20px 0;
    }

    footer .brand {
        font-weight: 800;
        font-size: 22px;
    }

    footer p {
        margin-bottom: 8px;
    }

    .footer-links {
        list-style: none;
        padding-left: 0;
    }

    .footer-links li {
        margin-bottom: 6px;
    }

    footer a {
        color: #bbb;
        text-decoration: none;
    }

    footer a:hover {
        color: #fff;
    }


    .social-icons a {
        display: inline-block;
        margin-right: 10px;
        font-size: 18px;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        border-radius: 50%;
        background: #222;
    }

    .social-icons a:hover {
        background: #fff;
        color: #000;
    }

    .copy {
        font-size: 14px;
        opacity: .8;
    }






    .menu-toggle {
        display: none;
        color: white;
        font-size: 30px;
    }
</style>
