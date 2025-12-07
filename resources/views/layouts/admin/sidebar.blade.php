<div class="side-bar">
    <h1 class="text-center">Trendora</h1>

    <hr class="mt-4">

    <ul class="m-1 ">
        <li>
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge "  ></i> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('configuration') }}"><i class="fa-solid fa-gear"></i> Configuration</a>
        </li>
        <li>
            <a href="{{ route("categories") }}"><i class="fa-solid fa-list"></i> Category</a>
        </li>
        <li>
            <a href="{{ route("size_type") }}"><i class="fa-solid fa-ruler-combined"></i> Size Type</a>
        </li>
        <li>
            <a href="{{ route("product") }}"><i class="fa-solid fa-box"></i> Product</a>
        </li>
        <li>
            <a href="{{ route("order_list") }}"><i class="fa-solid fa-cart-shopping"></i> Order</a>
        </li>
        <li>
            <a href="{{ route('payment_list') }}"><i class="fa-solid fa-indian-rupee-sign"></i> Payment</a>
        </li>
        {{-- <li> --}}
            {{-- <a href="#"><i class="fa-solid fa-rotate-left"></i> Return</a> --}}
        {{-- </li> --}}
        <li>
            <a href="{{ route('user_list_details') }}"><i class="fa-solid fa-users"></i> User List</a>
        </li>
        <li>
            <a href="{{ route('feedback_list') }}"><i class="fa-solid fa-comment-dots"></i> Feedback</a>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-envelope"></i> Contact</a>
        </li>
    </ul>











</div>
