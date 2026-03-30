<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }/*---------------------- Home ----------------------*/

#header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 80px;
    padding: 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: transparent;
    transition: all 0.3s ease;
    z-index: 9999;
}

#header.scrolled {
    background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%) !important;
    /* backdrop-filter: blur(12px); */
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
    background: transparent;
    transition: transform 0.4s ease;
    border-radius: 10px;
    object-fit: contain;
}

#header img:hover {
    transform: scale(1.05) rotate(1deg);
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 32px;
    margin: 0;
    padding: 0;
    align-items: center;
}

.nav-links li {
    margin: 0;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
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

.nav-links a.login-btn:hover {
    border-color: #9b87f2;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(155, 135, 242, 0.3);
}

.menu-toggle {
    display: none;
    font-size: 28px;
    color: #fff;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.2);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    z-index: 1100;
    backdrop-filter: blur(4px);
}

.menu-toggle i {
    pointer-events: none;
}

@media (max-width: 768px) {
    body {
        padding-top: 70px;
    }

    #header {
        padding: 0 18px;
        height: 70px;
        /* FIX: Force transparent background on mobile by default */
        background: transparent !important;
    }

    /* When scrolled, apply gradient background on mobile */
    #header.scrolled {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%) !important;
    }

    .menu-toggle {
        display: flex;
        margin-left: auto;
    }

    .nav-links {
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        width: 100%;
        background: linear-gradient(135deg, #e62a49 0%, #9b87f2 100%);
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 18px;
        padding: 28px 20px 32px;
        display: none;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        border-radius: 0 0 28px 28px;
        z-index: 10000;
        transition: all 0.25s ease;
    }

    .nav-links.active {
        display: flex;
        animation: slideDown 0.3s ease;
    }

    .nav-links a {
        font-size: 1.2rem;
        padding: 8px 0;
        width: 80%;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

    body {
        overflow-x: hidden;
        width: 100%;
    }


    /*---------------------- Home ----------------------*/

    /*---------------------- Home ----------------------*/

    #header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 80px;
        padding: 0 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: transparent;
        transition: all 0.3s ease;
        z-index: 9999;
    }

    #header.scrolled {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%) !important;
        /* backdrop-filter: blur(12px); */
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
        background: transparent;
        transition: transform 0.4s ease;
        border-radius: 10px;
        object-fit: contain;
    }

    #header img:hover {
        transform: scale(1.05) rotate(1deg);
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 32px;
        margin: 0;
        padding: 0;
        align-items: center;
    }

    .nav-links li {
        margin: 0;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
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

    .nav-links a.login-btn:hover {
        border-color: #9b87f2;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(155, 135, 242, 0.3);
    }

    .menu-toggle {
        display: none;
        font-size: 28px;
        color: #fff;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.2);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        z-index: 1100;
        backdrop-filter: blur(4px);
    }

    .menu-toggle i {
        pointer-events: none;
    }

    @media (max-width: 768px) {
        body {
            padding-top: 70px;
        }

        #header {
            padding: 0 18px;
            height: 70px;
            background: transparent !important;
        }

        #header.scrolled {
            background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%) !important;
        }

        .menu-toggle {
            display: flex;
            margin-left: auto;
        }

        .nav-links {
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            width: 100%;
            background: linear-gradient(135deg, #e62a49 0%, #9b87f2 100%);
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 18px;
            padding: 28px 20px 32px;
            display: none;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            border-radius: 0 0 28px 28px;
            z-index: 10000;
            transition: all 0.25s ease;
        }

        .nav-links.active {
            display: flex;
            animation: slideDown 0.3s ease;
        }

        .nav-links a {
            font-size: 1.2rem;
            padding: 8px 0;
            width: 80%;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    }






    /* ----------------------------------- Home Section  ---------------------*/
    #heroCarousel {
        height: 100vh;
        position: relative;
        overflow: hidden;
        margin-top: 0;
    }

    #heroCarousel .carousel-inner,
    #heroCarousel .carousel-item {
        height: 100vh;
    }

    .hero-slide {
        height: 100vh;
        object-fit: cover;
        filter: brightness(68%) contrast(1.05);
        animation: zoomEffect 15s infinite alternate;
    }




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




    .hero-content h1 {
        font-size: 4.2rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 15px;
        background: #ffffff;
        -webkit-background-clip: text;
        background-size: 300% auto;
        animation: gradientFlow 8s ease infinite;
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




    @keyframes zoomEffect {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.1);
        }
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


    @media (max-width: 768px) {

        #heroCarousel {
            height: 70vh;
            overflow: hidden;
        }

        #heroCarousel .carousel-inner,
        #heroCarousel .carousel-item,
        .hero-slide {
            height: 70vh;
        }

        .hero-slide {
            object-fit: cover;
            filter: brightness(65%);
            animation: none;
        }

        .hero-content {
            bottom: 50%;
            transform: translateY(50%);
            padding: 0 15px;
        }

        .hero-content h1 {
            font-size: 1.8rem;
            letter-spacing: 1px;
            line-height: 1.3;
        }

        .hero-content p {
            font-size: 0.9rem;
            padding: 6px 15px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 25px;
            height: 25px;
        }


        .carousel-indicators {
            bottom: 15px;
        }

        .carousel-indicators button {
            width: 8px;
            height: 8px;
        }
    }


    @media (max-width: 480px) {

        #heroCarousel {
            height: 60vh;
        }

        #heroCarousel .carousel-inner,
        #heroCarousel .carousel-item,
        .hero-slide {
            height: 60vh;
        }

        .hero-content h1 {
            font-size: 1.5rem;
        }

        .hero-content p {
            font-size: 0.8rem;
            padding: 5px 12px;
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
        background: #000;
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
        background-color: #f5f5f5;
    }

    .about-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1;
        transition: none;
        filter: brightness(1) contrast(1);
        transform-origin: center;

    }

    .about-img.paper-crumple-out {
        animation: paperCrumpleOut 0.8s ease-in forwards;
        z-index: 2;
    }

    .about-img.paper-crumple-in {
        animation: paperCrumpleIn 0.8s ease-out forwards;
        z-index: 3;
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

    .about-slideshow::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><filter id="noise"><feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="1" stitchTiles="stitch"/></filter><rect width="100" height="100" filter="url(%23noise)" opacity="0.08"/></svg>');
        pointer-events: none;
        z-index: 10;
        mix-blend-mode: multiply;
        opacity: 0.3;
    }

    .row>div {
        animation: fadeInUp 0.8s ease forwards;
    }

    .col-lg-6:first-child {
        animation-delay: 0.2s;
    }

    .col-lg-6:last-child {
        animation-delay: 0.4s;
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

    @keyframes paperCrumpleOut {
        0% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            filter: brightness(1) contrast(1);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        }

        20% {
            transform: scale(0.98) rotate(-0.5deg);
            filter: brightness(0.95) contrast(1.2);
            clip-path: polygon(2% 0, 98% 3%, 95% 97%, 3% 95%);
        }

        40% {
            transform: scale(0.95) rotate(1deg);
            filter: brightness(0.9) contrast(1.3);
            clip-path: polygon(5% 2%, 97% 5%, 92% 95%, 2% 92%);
        }

        60% {
            transform: scale(0.9) rotate(-1.5deg);
            filter: brightness(0.8) contrast(1.4);
            clip-path: polygon(8% 5%, 95% 8%, 88% 92%, 5% 88%);
        }

        80% {
            transform: scale(0.8) rotate(2deg);
            filter: brightness(0.7) contrast(1.5);
            clip-path: polygon(12% 10%, 90% 12%, 82% 88%, 8% 82%);
            opacity: 0.6;
        }

        100% {
            transform: scale(0.5) rotate(5deg);
            filter: brightness(0.5) contrast(1.6);
            clip-path: polygon(20% 15%, 85% 18%, 75% 85%, 15% 75%);
            opacity: 0;
        }
    }

    @keyframes paperCrumpleIn {
        0% {
            transform: scale(1.2) rotate(-5deg);
            filter: brightness(0.5) contrast(1.6);
            clip-path: polygon(15% 10%, 90% 5%, 95% 90%, 5% 95%);
            opacity: 0;
        }

        20% {
            transform: scale(1.1) rotate(-3deg);
            filter: brightness(0.7) contrast(1.4);
            clip-path: polygon(10% 5%, 92% 8%, 90% 92%, 8% 90%);
            opacity: 0.3;
        }

        40% {
            transform: scale(1.05) rotate(-1deg);
            filter: brightness(0.85) contrast(1.2);
            clip-path: polygon(5% 2%, 95% 5%, 95% 95%, 5% 95%);
            opacity: 0.6;
        }

        60% {
            transform: scale(1.02) rotate(0deg);
            filter: brightness(0.95) contrast(1.1);
            clip-path: polygon(2% 0, 98% 2%, 98% 98%, 2% 98%);
            opacity: 0.8;
        }

        80% {
            transform: scale(1.01) rotate(0deg);
            filter: brightness(0.98) contrast(1.05);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            opacity: 0.95;
        }

        100% {
            transform: scale(1) rotate(0deg);
            filter: brightness(1) contrast(1);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {

        #about-full {
            min-height: auto;
            padding: 40px 15px;
        }


        #about-full .row {
            flex-direction: column;
        }

        #about-full h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        #about-full h2::after {
            height: 3px;
        }

        #about-full p {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 18px;
            padding-left: 12px;
        }


        #about-full p:hover {
            padding-left: 12px;
            border-left-color: rgba(230, 42, 73, 0.2);
        }

        .about-slideshow {
            height: 300px;
            margin-top: 20px;
            border-radius: 12px;
            overflow: hidden;
        }

        .about-img {
            height: 100%;
            object-fit: cover;
            animation: none;
        }


        .about-img.paper-crumple-in,
        .about-img.paper-crumple-out {
            animation: none;
        }

        .about-slideshow::after {
            display: none;
        }
    }

    @media (max-width: 480px) {

        #about-full {
            padding: 30px 10px;
        }

        #about-full h2 {
            font-size: 1.6rem;
        }

        #about-full p {
            font-size: 0.85rem;
        }

        .about-slideshow {
            height: 250px;
        }
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


    @media (max-width: 768px) {

        #products {
            min-height: auto;
            padding: 60px 15px;
        }

        #products h2 {
            font-size: 1.8rem;
            margin-bottom: 2rem !important;
        }

        #products h2::after {
            height: 2px;
            bottom: -6px;
        }

        #products .col-md-4 {
            width: 100%;
        }

        .product-card {
            border-radius: 16px;
            margin-bottom: 15px;
            box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: none;
            box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
        }

        .carousel-slides {
            height: 220px;
        }

        .carousel-slides img {
            position: absolute;
            height: 100%;
            object-fit: cover;
            opacity: 1;
            transform: none;
        }


        .product-card:hover .carousel-slides img {
            transform: none;
        }

        .card-body {
            padding: 1rem;
        }

        .card-body h6 {
            font-size: 1rem;
        }

        .card-body .price {
            font-size: 1.2rem;
        }


        .carousel-dots {
            bottom: 6px;
        }

        .carousel-dots span {
            width: 6px;
            height: 6px;
        }
    }


    @media (max-width: 480px) {

        #products {
            padding: 40px 10px;
        }

        #products h2 {
            font-size: 1.5rem;
        }

        .carousel-slides {
            height: 180px;
        }

        .card-body h6 {
            font-size: 0.9rem;
        }

        .card-body .price {
            font-size: 1.1rem;
        }
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
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.15"><path d="M10 10 L90 10 L50 80 Z" fill="none" stroke="%23000000" stroke-width="2"/><path d="M20 20 L70 20 L45 60 Z" fill="none" stroke="%23000000" stroke-width="1.5"/><line x1="50" y1="30" x2="30" y2="70" stroke="%23000000" stroke-width="1"/><circle cx="25" cy="75" r="3" fill="%23000000"/></svg>'),
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path d="M15 85 L75 25 L95 45 L30 95 Z" fill="none" stroke="%23000000" stroke-width="1.8"/><line x1="40" y1="75" x2="70" y2="40" stroke="%23000000" stroke-width="1"/></svg>'),
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.12"><path d="M80 80 L20 60 L60 20 L90 40 Z" fill="none" stroke="%23000000" stroke-width="2"/><circle cx="70" cy="30" r="2" fill="%23000000"/></svg>'),
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.08"><path d="M20 180 Q60 140 100 100 Q140 60 180 20" stroke="%23000000" stroke-width="1" fill="none" stroke-dasharray="5,5"/><path d="M40 160 Q70 130 110 90 Q150 50 170 30" stroke="%23000000" stroke-width="0.8" fill="none" stroke-dasharray="3,3"/></svg>');

        background-repeat: repeat;
        background-position: 0 0, 150px 100px, 300px 200px, 50px 300px;
        background-size: 150px 150px, 200px 200px, 180px 180px, 300px 300px;
        animation: flyPlanes 60s linear infinite;
        z-index: 0;
        pointer-events: none;
    }

    #contact-section::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" opacity="0.1"><path d="M5 5 L40 5 L22 40 Z" fill="none" stroke="%23000000" stroke-width="1.2"/><line x1="22" y1="25" x2="12" y2="45" stroke="%23000000" stroke-width="0.8"/></svg>'),
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" opacity="0.07"><path d="M60 60 L20 45 L45 20 L70 35 Z" fill="none" stroke="%23000000" stroke-width="1.5"/></svg>');

        background-repeat: repeat;
        background-position: 500px 50px, 700px 400px;
        background-size: 100px 100px, 120px 120px;
        animation: flyPlanesReverse 45s linear infinite;
        z-index: 0;
        pointer-events: none;
    }



    .paper-pieces {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .paper-pieces {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .contact-wrapper {
        width: 100%;
        padding: 0 80px;
        position: relative;
        z-index: 2;
    }

    .contact-box {
        /* width: 100%; */
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
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

    .contact-box {
        animation: gentleFloat 6s ease-in-out infinite;
    }


    @keyframes flyPlanes {
        0% {
            background-position: 0 0, 150px 100px, 300px 200px, 50px 300px;
        }

        100% {
            background-position: 500px 500px, 650px 600px, 800px 700px, 550px 800px;
        }
    }

    @keyframes flyPlanesReverse {
        0% {
            background-position: 500px 50px, 700px 400px;
        }

        100% {
            background-position: -200px 300px, 0px 800px;
        }
    }

    @keyframes gentleFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    @media (max-width: 768px) {

        #contact-section {
            padding-top: 60px;
            padding-bottom: 60px;
        }


        #contact-section::before,
        #contact-section::after {
            display: none;
        }

        .contact-wrapper {
            padding: 0 15px;
        }

        .contact-box {
            padding: 20px 15px;
            border-radius: 16px;
            animation: none;
        }


        .contact-left,
        .contact-right {
            width: 100%;
            padding: 0;
        }

        .contact-left {
            border-right: none;
            margin-bottom: 30px;
        }


        .contact-left .title {
            font-size: 1.8rem;
            text-align: center;
        }

        .contact-left p {
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .contact-left p strong {
            min-width: auto;
            display: inline;
        }

        .map {
            height: 200px;
            border-radius: 12px;
        }


        .contact-right .title {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-right .form-control {
            padding: 12px 15px;
            font-size: 0.9rem;
            border-radius: 12px;
        }

        .contact-right textarea {
            min-height: 100px;
        }

        .submit-btn {
            padding: 12px;
            font-size: 1rem;
            border-radius: 30px;
        }


        .submit-btn:hover::before {
            display: none;
        }
    }


    @media (max-width: 480px) {

        #contact-section {
            padding: 40px 10px;
        }

        .contact-left .title {
            font-size: 1.5rem;
        }

        .contact-right .title {
            font-size: 1.3rem;
        }

        .map {
            height: 180px;
        }

        .contact-right .form-control {
            font-size: 0.85rem;
        }

        .submit-btn {
            font-size: 0.9rem;
        }
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
        width: 100%px;
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

    .social-icons a:nth-child(1):hover {
        background: #1877f2;
        background: linear-gradient(145deg, #1877f2, #0d5ab9);
    }


    .social-icons a:nth-child(2):hover {
        background: radial-gradient(circle at 30% 30%, #fdf497, #fd5949, #d6249f, #285AEB);
    }

    .social-icons a:nth-child(3):hover {
        background: #25D366;
        background: linear-gradient(145deg, #25D366, #128C7E);
    }

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






    .footer-links .sub-links {
        list-style: none;
        padding-left: 25px;
        margin-top: 8px;
        margin-bottom: 10px;
    }

    .footer-links .sub-links li {
        margin-bottom: 6px;
        font-size: 0.9rem;
    }

    .footer-links .sub-links li a {
        color: #999;
        font-weight: 300;
        position: relative;
        padding-left: 15px;
    }

    .footer-links .sub-links li a::before {
        content: '›';
        position: absolute;
        left: 0;
        color: #e62a49;
        font-size: 1.2rem;
        line-height: 1;
        transition: transform 0.3s ease;
    }

    .footer-links .sub-links li a:hover::before {
        transform: translateX(3px);
    }

    .footer-links .sub-links li a:hover {
        color: #e62a49;
    }

    .footer-links .sub-links li a::after {
        display: none;
    }


    .footer-links>li>a {
        font-weight: 600;
        color: #fff;
        font-size: 1.1rem;
        margin-bottom: 5px;
        display: inline-block;
    }

    .footer-links>li>a i {
        color: #e62a49;
        margin-right: 8px;
        width: 20px;
        text-align: center;
    }


    .quick-links-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .quick-links-grid .footer-links {
        margin-bottom: 0;
    }


    .payment-methods {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 50px;
        border: 1px solid rgba(230, 42, 73, 0.1);
    }

    .payment-methods span {
        color: #aaa;
        font-size: 0.95rem;
        margin-right: 5px;
    }

    .payment-methods i {
        font-size: 2rem;
        color: #ddd;
        transition: all 0.3s ease;
        filter: grayscale(100%);
        opacity: 0.7;
    }

    .payment-methods i:hover {
        filter: grayscale(0%);
        opacity: 1;
        transform: translateY(-3px);
    }

    .payment-methods .cod {
        background: linear-gradient(145deg, #e62a49, #b11e36);
        color: white;
        padding: 5px 15px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-left: auto;
        letter-spacing: 0.5px;
        box-shadow: 0 5px 15px rgba(230, 42, 73, 0.3);
    }

    /* Policy links */
    .text-md-end .copy a {
        color: #aaa;
        margin: 0 5px;
        font-size: 0.9rem;
    }

    .text-md-end .copy a:hover {
        color: #e62a49;
    }



    /* Animation for sub-links */
    .footer-links .sub-links li {
        animation: slideInLeft 0.5s ease forwards;
        opacity: 0;
        animation-delay: calc(0.1s * var(--item-index));
    }

    .footer-links .sub-links li:nth-child(1) {
        --item-index: 1;
    }

    .footer-links .sub-links li:nth-child(2) {
        --item-index: 2;
    }

    .footer-links .sub-links li:nth-child(3) {
        --item-index: 3;
    }

    .footer-links .sub-links li:nth-child(4) {
        --item-index: 4;
    }

    .footer-links .sub-links li:nth-child(5) {
        --item-index: 5;
    }


    .app-download {
        margin-top: 20px;
    }

    .app-download img {
        height: 40px;
        margin-right: 10px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .app-download img:hover {
        transform: translateY(-3px);
    }


    .newsletter {
        margin-top: 20px;
    }

    .newsletter-input {
        display: flex;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50px;
        overflow: hidden;
        border: 1px solid rgba(230, 42, 73, 0.2);
    }

    .newsletter-input input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 10px 15px;
        color: white;
        outline: none;
    }

    .newsletter-input input::placeholder {
        color: #777;
    }

    .newsletter-input button {
        background: #e62a49;
        border: none;
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-input button:hover {
        background: #b11e36;
    }

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

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }


    @media (max-width: 768px) {

        footer {
            padding: 50px 15px 20px;
        }


        footer::before,
        footer::after {
            display: none;
        }


        footer .row>div {
            width: 100%;
            text-align: center;
            margin-bottom: 25px;
            animation: none;
        }

        footer .brand {
            font-size: 22px;
        }

        footer h5 {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        footer p {
            font-size: 0.85rem;
        }


        .footer-links li:hover {
            transform: none;
        }


        .footer-links {
            text-align: center;
        }

        .footer-links .sub-links {
            padding-left: 0;
        }

        .footer-links .sub-links li a {
            padding-left: 0;
        }

        .footer-links .sub-links li a::before {
            display: none;
        }


        .social-icons {
            justify-content: center;
        }

        .social-icons a {
            margin: 5px;
            width: 35px;
            height: 35px;
            line-height: 35px;
            font-size: 16px;
        }


        .quick-links-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }


        footer .col-md-6 p {
            justify-content: center;
            text-align: center;
        }


        .payment-methods {
            justify-content: center;
            border-radius: 20px;
            padding: 10px;
            gap: 10px;
        }

        .payment-methods i {
            font-size: 1.5rem;
        }

        .payment-methods .cod {
            margin-left: 0;
            margin-top: 10px;
        }

        .copy {
            font-size: 0.8rem;
            padding: 5px 10px;
        }

        .text-md-end {
            text-align: center !important;
        }
    }



    @media (max-width: 480px) {

        footer {
            padding: 40px 10px 15px;
        }

        footer .brand {
            font-size: 20px;
        }

        footer h5 {
            font-size: 1rem;
        }

        footer p {
            font-size: 0.8rem;
        }

        .social-icons a {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .payment-methods i {
            font-size: 1.3rem;
        }

        .copy {
            font-size: 0.75rem;
        }
    }
</style>
