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
     height: 80px;
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

#heroCarousel {
    height: 100vh;
}

#heroCarousel .carousel-inner,
#heroCarousel .carousel-item {
    height: 100vh;
}

/* Image full cover */
.hero-slide {
    height: 100vh;
    object-fit: cover;
    filter: brightness(70%);
}

/* Center content */
.hero-content {
    bottom: 50%;
    transform: translateY(50%);
    text-align: center;
}

.hero-content h1 {
    font-size: 3rem;
    font-weight: bold;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}







#about-full {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
}

/* image full height */
.about-img {
    width: 100%;
    height: 80vh;
    object-fit: cover;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* text styling */
#about-full h2 {
    font-size: 2.8rem;
    margin-bottom: 20px;
}

#about-full p {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #555;
}

#products{
    min-height: 100vh;
    padding-top: 120px; /* heading visible below navbar */
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

/* avoid navbar overlap */
#contact-section{
    padding-top:100px;
    padding-bottom:60px;
    background: linear-gradient(135deg,#f8fafc,#e9f0ff);
}

/* full width container */
.contact-wrapper{
    width:100%;
    padding-left:60px;
    padding-right:60px;
}

/* main white frame */
.contact-box{
    width:100%;
    background:#fff;
    border-radius:22px;
    box-shadow:0 15px 40px rgba(0,0,0,.12);
    padding:40px 30px;
}

/* headings */
.title{
    font-weight:800;
    margin-bottom:10px;
}

.subtitle{
    color:#666;
    margin-bottom:15px;
}

/* dashed divider */
.contact-left{
    border-right:2px dashed #ddd;
    padding-right:25px;
}

.map{
    width:100%;
    height:250px;
    border-radius:15px;
    border:0;
    margin-top:15px;
}

/* form boxes */
.contact-right .form-control{
    border-radius:12px;
    border:1px solid #ccc;
}

.contact-right textarea{
    border-radius:12px;
}

/* button */
.submit-btn{
    background:black;
    color:white;
    padding:12px 34px;
    border-radius:30px;
    font-weight:600;
}




.border-divider {
    border-right: 1px solid #ddd;
}

footer{
    background:#0c0c0c;
    color:#eee;
    padding:50px 0 20px 0;
}

footer .brand{
    font-weight:800;
    font-size:22px;
}

footer p{
    margin-bottom:8px;
}

.footer-links{
    list-style:none;
    padding-left:0;
}

.footer-links li{
    margin-bottom:6px;
}

footer a{
    color:#bbb;
    text-decoration:none;
}

footer a:hover{
    color:#fff;
}

/* icons */
.social-icons a{
    display:inline-block;
    margin-right:10px;
    font-size:18px;
    width:35px;
    height:35px;
    line-height:35px;
    text-align:center;
    border-radius:50%;
    background:#222;
}

.social-icons a:hover{
    background:#fff;
    color:#000;
}

.copy{
    font-size:14px;
    opacity:.8;
}






.menu-toggle{
    display:none;
    color:white;
    font-size:30px;
}

</style>
