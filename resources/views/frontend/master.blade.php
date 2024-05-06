<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- custom css link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    <title>BFSA</title>
</head>

<body>
    @include('frontend.partials.header')
        @yield('content')
    @include('frontend.partials.footer')
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- font icon -->
    <script src="https://kit.fontawesome.com/ba28829b4c.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        let swiper = new Swiper(".mySwiper", {
            breakpoints: {
                480: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                576: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1400: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },

            loop: true,
            navigation: {
                prevEl: ".swiper-button-prev",
                nextEl: ".swiper-button-next",
            },
        });
    </script>
    <!-- bootstrap script for tooltip -->
    <script>
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );
        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );
    </script>

    <!-- custom js -->
    <script src="{{ asset('frontend/js/app.js') }}"></script>
</body>

</html>
