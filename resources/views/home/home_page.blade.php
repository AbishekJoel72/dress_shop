<!DOCTYPE html>
<html>

@include('layouts.head')
@include('home.home-page_style')

<body>

    @php
        use App\Models\Configuration;
        $config = Configuration::first();
    @endphp


    <!-- NAVBAR -->
    <nav id="header" class="d-flex justify-content-between align-items-center">


        @if (!empty($config->logo))
            <img src="{{ asset($config->logo) }}" height="60" alt="Company Logo">
        @else
            <h5 class="mb-0 text-white fw-bold">Trendora</h5>
        @endif


        <span class="menu-toggle" onclick="toggleMenu(this)">
            <i class="fa-solid fa-bars"></i>
        </span>




        <ul class="nav-links" id="mobileMenu">
            <li><a href="#heroCarousel">Home</a></li>
            <li><a href="#about-full">About</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#contact-section">Contact</a></li>
            <li><a class="login-btn" href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>




    <!-- HERO -->
    <section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000">

        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1534030347209-467a5b0ad3e6?auto=format&fit=crop&w=1200&q=80"
                    class="d-block w-100 hero-slide" alt="Men Fashion">
                <div class="carousel-caption hero-content">
                    <h1>Premium Men’s Fashion</h1>
                    <p>Shirts • T-Shirts • Jackets • Formals</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80"
                    class="d-block w-100 hero-slide" alt="Women Fashion">
                <div class="carousel-caption hero-content">
                    <h1>Trendy Women’s Collection</h1>
                    <p>Dresses • Kurtis • Western Wear</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=1200&q=80"
                    class="d-block w-100 hero-slide" alt="Kids Fashion">
                <div class="carousel-caption hero-content">
                    <h1>Adorable Kids Collection</h1>
                    <p>Baby Dresses • T-Shirts • Party Wear • Comfy Styles</p>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>



    </section>











    <!-- ABOUT -->
    <section id="about-full">
        <div class="container h-100">
            <div class="row align-items-center h-100">

                <!-- LEFT CONTENT - ABOUT TEXT -->
                <div class="col-lg-6">
                    <h2>About Trendora</h2>

                    <p>
                        <strong>For Men:</strong> Trendora brings you the latest in men's fashion – from formal shirts
                        to casual tees,
                        blazers to streetwear. We focus on perfect fit, premium fabrics, and timeless style.
                    </p>

                    <p>
                        <strong> For Women:</strong> Discover elegance with our women's collection – chic dresses,
                        traditional kurtis,
                        western wear, and party gowns. Designed to celebrate your individuality.
                    </p>

                    <p>
                        <strong> For Kids:</strong> Our kids' range is all about comfort and cuteness. Soft fabrics,
                        playful prints,
                        and durable outfits for your little ones. From baby dresses to trendy teen wear.
                    </p>

                    <p>
                        <strong> Our Promise:</strong> Quality fabrics, affordable prices, and styles that last.
                        Trendora is fashion for every member of your family.
                    </p>
                </div>

                <!-- RIGHT IMAGE - FIXED SIZE SLIDESHOW -->
                <div class="col-lg-6">
                    <div class="about-slideshow">
                        <img src="https://images.unsplash.com/photo-1534030347209-467a5b0ad3e6?auto=format&fit=crop&w=1200&q=80"
                            class="about-img active" alt="Men Fashion">
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80"
                            class="about-img" alt="Women Fashion">
                        <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=1200&q=80"
                            class="about-img" alt="Kids Fashion">
                    </div>
                </div>

            </div>
        </div>
    </section>





    <!-- PRODUCTS -->
    <section class="container" id="products">

        <h2 class="text-center mb-5">Trending Dresses</h2>

        <div class="row g-4">


            <div class="col-md-4">
                <div class="card product-card">
                    <div class="carousel-slides">
                        <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&w=800&q=80"
                            class="card-img-top img-fluid" alt="Women Dress ">
                    </div>
                    <div class="card-body text-center">
                        <h6>Women Dress</h6>
                        <p class="price">₹1,299</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card product-card">
                    <div class="carousel-slides">

                        <img src="https://images.unsplash.com/photo-1621072156002-e2fccdc0b176?auto=format&fit=crop&w=800&q=80"
                            class="card-img-top img-fluid" alt="Men Shirt ">
                    </div>
                    <div class="card-body text-center">
                        <h6>Men Shirt</h6>
                        <p class="price">₹999</p>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card product-card">
                    <div class="carousel-slides">
                        <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=1200&q=80"
                            class="card-img-top img-fluid" alt="Party Wear 3">
                    </div>
                    <div class="card-body text-center">
                        <h6>Kids Wear</h6>
                        <p class="price">₹1,899</p>
                    </div>
                </div>
            </div>

        </div>

        </div>

    </section>




    <!-- CONTACT SECTION START -->
    <section id="contact-section">

        <div class="paper-pieces"></div>
        <div class="container-fluid contact-wrapper">

            <div class="row contact-box">

                <!-- LEFT -->
                <div class="col-lg-6 col-md-12 contact-left">

                    <h2 class="title">Contact Us</h2>
                    <p class="subtitle">We’re happy to help with orders & support.</p>

                    @if (!empty($config))
                        <p><strong>Company:</strong> {{ $config->company_name }}</p>
                        <p><strong>Address:</strong> {{ $config->address }}</p>
                        <p><strong>Email:</strong> {{ $config->email }}</p>
                        <p><strong>Phone:</strong> {{ $config->phone }}</p>
                    @endif

                    <iframe class="map"
                        src="https://www.google.com/maps?q={{ urlencode($config->address ?? 'India') }}&output=embed"
                        loading="lazy" allowfullscreen>
                    </iframe>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-6 col-md-12 contact-right">

                    <h3 class="title">Send Message</h3>

                    <form method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="contact_ss" value="true">
                        <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

                        <input class="form-control mb-3" type="text" name="phone" placeholder="Phone" required>

                        <textarea class="form-control mb-3" rows="10" name="message" placeholder="Message" required></textarea>

                        <button class="btn submit-btn">Submit</button>

                    </form>

                </div>

            </div>

        </div>

    </section>





</body>

<!-- FOOTER -->
<footer>
    <div class="container">

        <div class="row">

            <!-- shop info -->
            <div class="col-md-3 mb-3">
                <h4 class="brand">Trendora</h4>
                <p>Fashion that fits your lifestyle. Stylish outfits at affordable prices for the whole family.</p>

                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- categories -->
            <div class="col-md-3 mb-3">
                <h5>Categories</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-male"></i> Men's Collection</a>
                        <ul class="sub-links">
                            <li><a href="#">Formal Shirts</a></li>
                            <li><a href="#">Casual Tees</a></li>
                            <li><a href="#">Blazers & Coats</a></li>
                            <li><a href="#">Jeans & Trousers</a></li>
                            <li><a href="#">Footwear</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 mb-3">
                <h5 style="visibility: hidden;">Categories</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-female"></i> Women's Collection</a>
                        <ul class="sub-links">
                            <li><a href="#">Chic Dresses</a></li>
                            <li><a href="#">Traditional Kurtis</a></li>
                            <li><a href="#">Western Wear</a></li>
                            <li><a href="#">Party Gowns</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 mb-3">
                <h5 style="visibility: hidden;">Categories</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-child"></i> Kids' Collection</a>
                        <ul class="sub-links">
                            <li><a href="#">Baby Dresses</a></li>
                            <li><a href="#">Boys Wear</a></li>
                            <li><a href="#">Girls Wear</a></li>
                            <li><a href="#">School Uniforms</a></li>
                            <li><a href="#">Party Wear</a></li>
                        </ul>
                    </li>
                    <li class="mt-3"><a href="#"><i class="fas fa-tags"></i> Special Offers</a></li>
                    <li><a href="#"><i class="fas fa-star"></i> New Arrivals</a></li>
                </ul>
            </div>

        </div>

        <!-- contact & quick links row -->
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <h5>Quick Links</h5>
                <div class="quick-links-grid">
                    <ul class="footer-links">
                        <li><a href="#heroCarousel">Home</a></li>
                        <li><a href="#about-full">About Us</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#contact-section">Contact</a></li>
                    </ul>
                    <ul class="footer-links">
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Returns & Exchanges</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Shipping Policy</a></li>
                    </ul>
                </div>
            </div>

            <!-- contact -->
            <div class="col-md-6 mb-3">
                <h5>Contact Details</h5>

                @if (!empty($config))
                    <p><i class="fa-solid fa-location-dot"></i> {{ $config->address }}</p>
                    <p><i class="fa-solid fa-envelope"></i> {{ $config->email }}</p>
                    <p><i class="fa-solid fa-phone"></i> {{ $config->phone }}</p>
                @endif

                <p><i class="fa-solid fa-clock"></i> Mon – Sat : 10am – 9pm</p>
                <p><i class="fa-solid fa-clock"></i> Sun : 11am – 6pm</p>
            </div>
        </div>

        <!-- payment methods -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="payment-methods">
                    <span>We Accept:</span>
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-google-pay"></i>
                    <i class="fab fa-apple-pay"></i>
                    <span class="cod">COD Available</span>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <p class="copy">
                    © {{ date('Y') }} Trendora — All Rights Reserved
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="copy">
                    <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a> | <a
                        href="#">Sitemap</a>
                </p>
            </div>
        </div>

    </div>
</footer>


<script>
    function toggleMenu(el) {
        const menu = document.getElementById("mobileMenu");
        menu.classList.toggle("active");

        const icon = el.querySelector("i");
        icon.classList.toggle("fa-bars");
        icon.classList.toggle("fa-xmark");
    }
    document.querySelectorAll("#mobileMenu a").forEach(link => {
        link.addEventListener("click", function() {

            const menu = document.getElementById("mobileMenu");
            const toggleBtn = document.querySelector(".menu-toggle i");
            menu.classList.remove("active");
            toggleBtn.classList.remove("fa-xmark");
            toggleBtn.classList.add("fa-bars");
        });
    });


    window.addEventListener("scroll", function() {
        let header = document.getElementById("header");
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const aboutImages = document.querySelectorAll('.about-slideshow .about-img');

        if (aboutImages.length > 0) {
            let currentIndex = 0;
            let isTransitioning = false;


            aboutImages[0].classList.add('active');
            aboutImages[0].style.opacity = '1';


            for (let i = 1; i < aboutImages.length; i++) {
                aboutImages[i].style.opacity = '0';
            }

            setInterval(() => {
                if (isTransitioning) return;
                isTransitioning = true;

                const nextIndex = (currentIndex + 1) % aboutImages.length;
                const currentImage = aboutImages[currentIndex];
                const nextImage = aboutImages[nextIndex];

                nextImage.style.opacity = '1';
                nextImage.classList.remove('paper-crumple-in', 'paper-crumple-out');

                currentImage.classList.add('paper-crumple-out');

                setTimeout(() => {
                    nextImage.classList.add('paper-crumple-in');
                }, 100);

                setTimeout(() => {
                    currentImage.style.opacity = '0';
                    currentImage.classList.remove('active', 'paper-crumple-out');
                    nextImage.classList.remove('paper-crumple-in');
                    nextImage.classList.add('active');
                    currentIndex = nextIndex;
                    isTransitioning = false;
                }, 800);

            }, 3000);
        }
    });




    document.addEventListener('DOMContentLoaded', function() {
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach((card, index) => {
            const slides = card.querySelectorAll('.carousel-slides img');

            if (slides.length > 0) {
                slides.forEach(s => s.classList.remove('active'));
                slides[0].classList.add('active');
                if (slides.length > 1) {
                    let current = 0;

                    setInterval(() => {
                        slides[current].classList.remove('active');
                        current = (current + 1) % slides.length;
                        slides[current].classList.add('active');
                    }, 2000);
                }
            }
        });
    });
</script>

</html>
