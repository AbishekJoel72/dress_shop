<div class="side-bar" id="sidebar">
    <h1 class="text-center sidebar-title">
        <span class="full-text">Trendora</span>
        <span class="short-text">T</span>
    </h1>

    <hr class="mt-4">

    <ul class=" ">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-gauge me-2"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('configuration') }}">
                <i class="fa-solid fa-gear me-2"></i>
                <span class="sidebar-text">Configuration</span>
            </a>
        </li>
        <li>
            <a href="{{ route('categories') }}">
                <i class="fa-solid fa-list me-2"></i>
                <span class="sidebar-text">Category</span>
            </a>
        </li>
        <li>
            <a href="{{ route('size_type') }}">
                <i class="fa-solid fa-ruler-combined me-2"></i>
                <span class="sidebar-text">Size Type</span></a>
        </li>
        <li>
            <a href="{{ route('product') }}">
                <i class="fa-solid fa-box me-2"></i>
                <span class="sidebar-text">Product</span></a>
        </li>
        <li>
            <a href="{{ route('order_list') }}">
                <i class="fa-solid fa-cart-shopping me-2"></i>
                <span class="sidebar-text">Order</span></a>
        </li>
        <li>
            <a href="{{ route('payment_list') }}">
                <i class="fa-solid fa-indian-rupee-sign me-2"></i>
                <span class="sidebar-text">Payment</span></a>
        </li>

        <li>
            <a href="{{ route('user_list_details') }}">
                <i class="fa-solid fa-users me-2"></i>
                <span class="sidebar-text">User List</span></a>
        </li>
        <li>
            <a href="{{ route('feedback_list') }}">
                <i class="fa-solid fa-comment-dots me-2"></i>
                <span class="sidebar-text">Feedback</span></a>
        </li>
        <li>
            <a href="{{ route('contact_list') }}">
                <i class="fa-solid fa-envelope me-2"></i>
                <span class="sidebar-text">Contact</span>
            </a>
        </li>
    </ul>


</div>
