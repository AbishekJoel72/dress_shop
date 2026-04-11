<style>
    :root {
        --sidebar-w: 250px;
        --header-h: 64px;
        --footer-h: 56px;
    }

    body {
        margin: 0;
        background: #e3e2e2;
        padding-bottom: 80px;
    }

    .side-bar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 270px;
        background: #0092ca;
        /* background: #0092ca; */
        /* background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%); */
        color: #fff;
        padding: 20px;
        overflow-y: auto;
        transition: width 0.3s ease;
        z-index: 1100;
    }

    .side-bar.collapsed {
        width: 80px;
    }


    .side-bar.collapsed .sidebar-text {
        display: none;
    }

    .side-bar ul {
        list-style: none;
        padding: 0;
        margin: 0;

    }

    .side-bar ul li {
        list-style: none;
    }

    .side-bar ul li a {
        display: flex;
        align-items: center;
        gap: 14px;
        color: #fff;
        text-decoration: none;
        padding: 15px 10px;
        border-radius: 6px;
        white-space: nowrap;
    }


    .side-bar.collapsed ul li a {
        display: flex;
        align-items: center;
        gap: 14px;
        color: #fff;
        text-decoration: none;
        padding: 15px 10px;
        border-radius: 6px;
        white-space: nowrap;
        transition: all 0.2s ease-in-out;
        height: 55px;
    }

    .side-bar ul li a i {
        font-size: 20px;
        min-width: 26px;
        text-align: center;
    }




    .sidebar-title {
        color: #fff;
        font-size: 45px;

    }


    .sidebar-title .short-text {
        display: none;
    }


    .side-bar.collapsed .sidebar-title .full-text {
        display: none;
    }

    .side-bar.collapsed .sidebar-title .short-text {
        display: inline-block;
        font-size: 45px;
        text-align: center;
    }


    .side-bar.collapsed .sidebar-title {
        text-align: center;
    }





    /* Header */
    .header {
        position: fixed;
        top: 0;
        left: 270px;
        right: 0;
        background: #fff;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
        transition: left 0.3s ease;
        z-index: 1000;

    }

    .header.collapsed {
        left: 80px;
    }

    #header {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        padding: 10px 15px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;

    }


    .search input {
        width: 50%;
        max-width: 400px;
        padding: 12px 20px;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        outline: none;
        font-size: 0.95rem;
        background: #fff;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .search input::placeholder {
        color: #999;
    }

    .search input:focus {
        width: 100%;
        border-color: #e62a49;
        box-shadow: 0 0 10px rgba(230, 42, 73, 0.2);
        background: #fff;
    }

    .search input:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }


    .user-box {
        border-radius: 6px;
    }

    /* ===== MOBILE VIEW ===== */
    @media (max-width: 768px) {

        #header {
            flex-direction: column;
            align-items: stretch;
            padding: 10px;
        }

        /* Logo */
        #header img {
            width: 140px;
            height: auto;
            margin-bottom: 8px;
        }

        /* Search Full Width */
        .search {
            width: 100%;
            padding: 5px 0;
        }

        .search input {
            width: 100% !important;
            max-width: 100%;
            border-radius: 10px;
        }

        /* Nav Menu */
        #header .nav {
            width: 100%;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        #header .nav-link {
            font-size: 13px;
            padding: 6px;
        }

        /* Admin Dropdown */
        #header nav.bg-light {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
        }

        #adminDropdown span {
            font-size: 12px;
        }


    }



    .footer {
        position: fixed;
        bottom: 0;
        left: 270px;
        right: 0;
        height: 80px;
        background: #fff;
        color: #0092ca;
        border-top: 1px solid #ddd;
        padding: 25px;
        transition: left 0.3s ease;
        z-index: 1000;

    }

    .footer.collapsed {
        left: 80px;
    }

    #footer {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0px;
        height: 80px;
        width: 100%;
        background: #000;
        border-top: 1px solid #ddd;
        align-items: center;
        padding: 25px;
        z-index: 1000;
    }

    #footer h6,
    #footer p {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        font-weight: 500;
        margin: 0;
    }


    /* Main */
    .main-container {
        margin-left: 280px;
        padding: 110px 20px 20px;
        transition: margin-left 0.3s ease;
    }

    .main-container.collapsed {
        margin-left: 80px;
    }

    #maincontant {
        margin-top: 30px;
        width: 100%;
        padding: 110px 20px 20px;
    }


    .form-control,
    .form-select {
        height: 45px;
    }

    .form-control,
    .form-select,
    textarea {
        border: 1px solid black
    }

    .form-field {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 85px;
    }

    .col-6,
    .col-4,
    .col-3,
    .col-5.col-2,col {
        min-height: 90px;
    }

    .form-field small {
        height: 10px;
        display: block;
        font-size: 15px;
        color: red;
    }

    .text-dangers {
        font-size: 13px;
    }










    /* --------------------------Button color size Adjust------------------------------------ */

    .text-bg-primary {
        background-color: #0092ca;
        border-radius: 2;
    }

    .text-bg-secondary {
        background-color: #5a5f68;
        border-radius: 0;

    }

    .text-bg-info {
        background-color: #66bfbf;
        border-radius: 0;
    }

    .text-bg-success {
        background-color: #4c9173;
        border-radius: 0;

    }

    .text-bg-light {
        background-color: #fbf8f8;
        border-radius: 0;
    }

    .text-bg-dark {
        background-color: #222831;
        border-radius: 0;
    }

    .text-bg-danger {
        background-color: #a93333;
        border-radius: 0;
    }

    .text-bg-warning {
        background-color: #f96d00;
        border-radius: 0;
    }


    .bg-primary {
        background-color: #0092ca;


    }

    .bg-secondary {
        background-color: #5a5f68;


    }

    .bg-info {
        background-color: #66bfbf;

    }

    .bg-success {
        background-color: #4c9173;


    }

    .bg-light {
        background-color: #fbf8f8;

    }

    .bg-dark {
        background-color: #222831;

    }

    .bg-danger {
        background-color: #a93333;

    }

    .bg-warning {
        background-color: #f96d00;

    }

    .btn-primary {
        background-color: #0092ca;
        color: white;
        border-radius: 2;


    }

    .btn-primary:hover {
        background-color: #0092ca;
    }


    .btn-secondary {
        background-color: #5a5f68;
        color: white;
        border-radius: 2;


    }

    .btn-secondary:hover {
        background-color: #5a5f68;
    }


    .btn-info {
        background-color: #66bfbf;
        color: white;
        border-radius: 2;


    }

    .btn-info:hover {
        background-color: #66bfbf;
    }

    .btn-success {
        background-color: #4c9173;
        color: white;
        border-radius: 2;


    }

    .btn-success:hover {
        background-color: #4c9173;
    }

    .btn-danger {
        background-color: #a93333;
        color: white;
        border-radius: 2;


    }

    .btn-danger:hover {
        background-color: #a93333;
    }


    .btn-light {
        background-color: #fbf8f8;
        color: black;
        border-radius: 2;


    }

    .btn-light:hover {
        background-color: #fbf8f8;
    }

    .btn-dark {
        background-color: #222831;
        color: white;
        border-radius: 2;


    }

    .btn-dark:hover {
        background-color: #222831;
    }

    .btn-warning {
        background-color: #f96d00;
        color: white;
        border-radius: 2;


    }

    .btn-warning:hover {
        background-color: #f96d00;
    }

    h1 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    h2 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    h3 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    h4 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    h5 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    h6 {
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }




    /* --------------------------DataTable------------------------------------ */
    #datatable {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 14px;
        background: #ffffff;
        margin-top: 12px;

    }


    #datatable thead th {
        background: #ebe9e956;
        padding: 10px 12px;
        border: 1px solid #5a5f68;
        white-space: nowrap;
    }


    #datatable tbody td {
        padding: 5px 12px;
        border: 1px solid #5a5f68;
        vertical-align: middle;
    }

    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 12px;
    }

    .dataTables_wrapper .row:first-child {
        margin-bottom: 10px;
    }



    /* --------------------------Select2------------------------------------ */
    .select2-container .select2-selection--single {
        height: 45px !important;
        padding: 6px 12px;
        border: 1px solid #ced4da !important;
        border-radius: 6px !important;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #212529;
        line-height: 38px;
        padding-left: 2px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        right: 8px;
    }

    .select2-container--default .select2-results>.select2-results__options {
        max-height: 220px;
    }

    .select2-results__option--highlighted {
        background-color: #0d6efd !important;
        color: white !important;
    }

    .select2-container--open .select2-selection--single {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
    }

    .select2-container .select2-selection--single .select2-selection__placeholder {
        color: #6c757d;
    }

    .select2-container--default .select2-selection--single:focus {
        outline: none !important;
    }
</style>
