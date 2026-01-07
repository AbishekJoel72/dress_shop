<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #0092ca;
    --accent: #e4b7b2;
    --text: #666;
}
body {
    font-family: 'Poppins', sans-serif;
    color: var(--text);
}

#header {
    background: var(--primary);
    padding: 14px 30px;
    position: fixed;
    width: 100%;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 25px;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
}

.login-btn {
    background: #fff;
    color: #111 !important;
    padding: 6px 15px;
    border-radius: 20px;
}

.hero {
    height: 90vh;
    background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d') center/cover;
}

.hero-overlay {
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
}

.product-card {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    transition: .4s;
}

.product-card img {
    height: 280px;
    width: 100%;
    object-fit: cover;
}

.product-card:hover img {
    transform: scale(1.1);
}

.product-card:hover {
    transform: translateY(-8px);
}

#contact {
    background: #f9f9f9;
    border-radius: 25px;
}

.border-divider {
    border-right: 1px solid #ddd;
}

footer {
    background: #111;
    color: #fff;
    padding: 40px 0;
}

footer a {
    color: #aaa;
    text-decoration: none;
}
footer a:hover {
    color: #fff;
}


/* MOBILE RESPONSIVE FIX */
@media (max-width: 768px) {

    /* Navbar mobile layout */
    #header {
        padding: 10px 15px;
    }

    .nav-links {
        position: fixed;
        top: 70px;
        right: 0;
        background: var(--primary);
        width: 100%;
        flex-direction: column;
        text-align: center;
        gap: 15px;
        padding: 20px 0;
        display: none;
    }

    .nav-links.show {
        display: flex;
    }

    /* Navbar items clickable, full width */
    .nav-links li {
        width: 100%;
    }

    /* Add hamburger */
    .menu-toggle {
        display: block;
        font-size: 28px;
        color: #fff;
        cursor: pointer;
    }

    /* Hide desktop nav */
    #header img, #header h5 {
        max-width: 140px;
    }

    /* Hero section fix */
    .hero {
        height: 60vh;
        background-position: center;
    }

    .hero-overlay h1 {
        font-size: 24px;
    }

    .hero-overlay p {
        font-size: 14px;
    }

    /* About section mobile */
    #about .row {
        flex-direction: column-reverse;
    }

    #about img {
        width: 100%;
        height: auto;
    }

    /* Product card height auto */
    .product-card img {
        height: 200px;
    }

    /* Contact box column layout */
    .border-divider {
        border-right: none;
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;
        padding-bottom: 10px;
    }
}

/* Hamburger hidden on desktop */
.menu-toggle{
    display:none;
    color:white;
    font-size:30px;
}

</style>
