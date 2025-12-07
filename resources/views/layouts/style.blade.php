<style>
    :root {
        --sidebar-w: 250px;
        --header-h: 64px;
        --footer-h: 56px;
    }

    body {
        margin: 0;
        background: #f7f8fa;
        padding-bottom: 80px;
    }

    .side-bar {
        position: fixed;
        inset: 0 auto 0 0;
        background: #0092ca;
        color: #fff;
        padding: 20px;
        overflow-y: auto;
        width: 290px;
    }

    .side-bar li,
    a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 7px 4px;
        margin: 1px;
    }


    /* Header */
    .header {
        background: #fff;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
        position: fixed;
        top: 0;
        left: 290px;
        right: 0;
        z-index: 1000;

    }

    #header {
        background-color: #0092ca;
        padding: 10px 15px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;

    }

    .footer {
        position: fixed;
        left: 290px;
        /* sidebar width adjust pannunga */
        right: 0;
        bottom: 0;
        height: 80px;
        background: #ffffff;
        color: #0092ca;
        border-top: 1px solid #ddd;
        padding: 25px;
        z-index: 1000;
    }

    #footer {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0px;
        height: 80px;
        width: 100%;
        background: #ffffff;
        color: #0092ca;
        border-top: 1px solid #ddd;
        align-items: center;
        padding: 25px;
        z-index: 1000;
    }



    /* Main */
    .main-container {
        margin-left: 280px;
        padding: 110px 20px 20px;
    }

    #maincontant {
        margin-top: 30px;
        width: 100%;
        padding: 110px 20px 20px;
    }




    @media (max-width: 992px) {
        .header {
            left: 0;
        }

        .main-container {
            margin-left: 0;
        }

        .footer {
            left: 0;
        }
    }



    .text-bg-primary {
        background-color: #0092ca;
        border-radius: 0;
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
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-primary:hover {
        background-color: #0092ca;
    }


    .btn-secondary {
        background-color: #5a5f68;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-secondary:hover {
        background-color: #5a5f68;
    }


    .btn-info {
        background-color: #66bfbf;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-info:hover {
        background-color: #66bfbf;
    }

    .btn-success {
        background-color: #4c9173;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-success:hover {
        background-color: #4c9173;
    }

    .btn-danger {
        background-color: #a93333;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-danger:hover {
        background-color: #a93333;
    }


    .btn-light {
        background-color: #fbf8f8;
        color: black;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-light:hover {
        background-color: #fbf8f8;
    }

    .btn-dark {
        background-color: #222831;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

    }

    .btn-dark:hover {
        background-color: #222831;
    }

    .btn-warning {
        background-color: #f96d00;
        color: white;
        border-radius: 0;
        padding: 5px 10px;
        font-size: 14px;

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





    #datatable {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 14px;
        background: #f8f9fa;

    }


    #datatable thead th {
        background: #f8f9fa;
        /* font-weight: 600; */
        padding: 10px 12px;
        border: 1px solid #5a5f68;
        white-space: nowrap;
    }


    #datatable tbody td {
        padding: 5px 12px;
        border: 1px solid #5a5f68;
        vertical-align: middle;
    }


</style>

<style>
/* Select2 container */
.select2-container .select2-selection--single {
    height: 38px !important;
    padding: 6px 12px;
    border: 1px solid #ced4da !important;
    border-radius: 6px !important;
    display: flex;
    align-items: center;
}

/* Selected text */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #212529;
    line-height: 38px;
    padding-left: 2px;
}

/* Dropdown arrow */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px;
    right: 8px;
}

/* Dropdown box */
.select2-container--default .select2-results > .select2-results__options {
    max-height: 220px;
}

/* Hover effect */
.select2-results__option--highlighted {
    background-color: #0d6efd !important;
    color: white !important;
}

/* When opened */
.select2-container--open .select2-selection--single {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
}

/* Placeholder color */
.select2-container .select2-selection--single .select2-selection__placeholder {
    color: #6c757d;
}

/* Remove blue outline on focus */
.select2-container--default .select2-selection--single:focus {
    outline: none !important;
}
</style>

