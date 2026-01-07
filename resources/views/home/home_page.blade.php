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
            <li><a href="/">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a class="login-btn" href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-overlay">
            <h1>Style for Every Story</h1>
            <p>Trending Fashion for Men & Women</p>
            <a href="#products" class="btn btn-dark btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="container" id="about">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h2>About Trendora</h2>
                <p>
                    Trendora is a modern online fashion store for men and women.
                    From casual wear to party collections, we bring styles that
                    match your lifestyle.
                </p>
                <p>
                    Fashion is more than clothing — it’s confidence, comfort,
                    and expression.
                </p>
            </div>

            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=900&q=80"
                    class="img-fluid rounded shadow">
            </div>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section class="container py-5" id="products">
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
                    <img src="https://images.unsplash.com/photo-1521335629791-ce4aec67dd47?auto=format&fit=crop&w=800&q=80"
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
                    <img src="https://images.unsplash.com/photo-1520975922284-7b9587a4f07c?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top img-fluid" alt="Casual Dress">
                    <div class="card-body text-center">
                        <h6>Casual Dress</h6>
                        <p>₹1,099</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- CONTACT -->
    <section class="container" id="contact">
        <div class="row shadow rounded p-5">

            <div class="col-md-5 border-divider">
                <h3>Get in Touch</h3>
                <p>Reach out for orders, queries & support.</p>

                @if (!empty($config))
                    <p><strong>Company:</strong> {{ $config->company_name }}</p>
                    <p><strong>Address:</strong> {{ $config->address }}</p>
                    <p><strong>Email:</strong> {{ $config->email }}</p>
                    <p><strong>Phone:</strong> {{ $config->phone }}</p>
                @endif
            </div>

            <div class="col-md-7">
                <h4>Send Message</h4>
                <form method="POST">
                    @csrf
                    <input class="form-control mb-3" type="email" name="email" placeholder="Email">
                    <input class="form-control mb-3" type="text" name="phone" placeholder="Phone">
                    <textarea class="form-control mb-3" rows="4" name="message" placeholder="Message"></textarea>
                    <button class="btn btn-dark px-4">Submit</button>
                </form>
            </div>

        </div>
    </section>

</body>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <h5>Trendora</h5>
                <p>Fashion that fits your lifestyle.</p>
            </div>

            <div class="col-md-4">
                <h6>Quick Links</h6>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6>Contact</h6>
                <p>{{ $config->email }}</p>
                <p>{{ $config->phone }}</p>
            </div>

        </div>
        <hr>
        <p class="text-center">© {{ date('Y') }} Trendora</p>
    </div>
</footer>

<script>
    function toggleMenu() {
        document.getElementById("mobileMenu").classList.toggle("show");
    }
</script>
