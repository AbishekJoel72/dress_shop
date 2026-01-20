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

        @if (empty($config->logo))
            <h5 class="mb-0 text-white fw-bold">Trendora</h5>
        @else
            <img src="{{ asset($config->logo) }}" height="60" alt="Company Logo">
        @endif


        <span class="menu-toggle" onclick="toggleMenu()">
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
                <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab" class="d-block w-100 hero-slide"
                    alt="Men Fashion">
                <div class="carousel-caption hero-content">
                    <h1>Premium Men’s Fashion</h1>
                    <p>Shirts • T-Shirts • Jackets • Formals</p>
                    <a href="#products" class="btn btn-light btn-lg">Shop Men</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c" class="d-block w-100 hero-slide"
                    alt="Women Fashion">
                <div class="carousel-caption hero-content">
                    <h1>Trendy Women’s Collection</h1>
                    <p>Dresses • Kurtis • Western Wear</p>
                    <a href="#products" class="btn btn-light btn-lg">Shop Women</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb" class="d-block w-100 hero-slide"
                    alt="Lookbook">
                <div class="carousel-caption hero-content">
                    <h1>Style For Every Story</h1>
                    <p>Latest Trends • Best Prices</p>
                    <a href="#products" class="btn btn-light btn-lg">Explore Collection</a>
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

                <!-- LEFT CONTENT -->
                <div class="col-lg-6">
                    <h2>About Trendora</h2>

                    <p>
                        Trendora is more than just an online clothing store — it is a celebration of style,
                        individuality, and modern living. We are dedicated to bringing you the latest fashion curated
                        from trendy collections across men’s and women’s wear.
                    </p>

                    <p>
                        Every product at Trendora is selected with attention to fabric quality, comfort, and design
                        detail.
                        We believe great fashion should feel good, last long, and suit every mood.
                    </p>

                    <p>
                        Our vision is to make premium fashion accessible to everyone without compromising on elegance.
                        With Trendora, dressing well becomes simple.
                    </p>

                    <p>
                        Because style is not only about clothing — it is about comfort, confidence, and the way you
                        carry
                        yourself.
                    </p>
                </div>

                <!-- RIGHT IMAGE -->
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80"
                        class="about-img">
                </div>

            </div>
        </div>
    </section>







    <!-- PRODUCTS -->
    <section class="container" id="products">

        <h2 class="text-center mb-5">Trending Dresses</h2>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card product-card">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top img-fluid" alt="Women Dress">
                    <div class="card-body text-center">
                        <h6>Women Dress</h6>
                        <p>₹1,299</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card product-card">
                    <img src="https://images.unsplash.com/photo-1520974742243-74d1bb13b3a1?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top img-fluid" alt="Men Shirt">

                    <div class="card-body text-center">
                        <h6>Men Shirt</h6>
                        <p>₹999</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card product-card">
                    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top img-fluid" alt="Party Wear">
                    <div class="card-body text-center">
                        <h6>Party Wear</h6>
                        <p>₹1,899</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card product-card">
                    <img src="https://images.unsplash.com/photo-1520975432074-3e5f6e0a4a1a?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top img-fluid" alt="Casual Dress">

                    <div class="card-body text-center">
                        <h6>Casual Dress</h6>
                        <p>₹1,099</p>
                    </div>
                </div>
            </div>

        </div>

    </section>




    <!-- CONTACT SECTION START -->
    <section id="contact-section">

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

                    <form method="POST">
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
            <div class="col-md-4 mb-3">
                <h4 class="brand">Trendora</h4>
                <p>Fashion that fits your lifestyle. Stylish outfits at affordable prices.</p>

                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- quick links -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="#heroCarousel">Home</a></li>
                    <li><a href="#about-full">About</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#contact-section">Contact</a></li>
                </ul>
            </div>

            <!-- contact -->
            <div class="col-md-4 mb-3">
                <h5>Contact Details</h5>

                @if (!empty($config))
                    <p><i class="fa-solid fa-location-dot"></i> {{ $config->address }}</p>
                    <p><i class="fa-solid fa-envelope"></i> {{ $config->email }}</p>
                    <p><i class="fa-solid fa-phone"></i> {{ $config->phone }}</p>
                @endif

                <p><i class="fa-solid fa-clock"></i> Mon – Sat : 10am – 9pm</p>
            </div>

        </div>

        <hr>

        <p class="text-center copy">
            © {{ date('Y') }} Trendora — All Rights Reserved
        </p>

    </div>
</footer>


<script>
    function toggleMenu() {
        document.getElementById("mobileMenu").classList.toggle("show");
    }
</script>

</html>
