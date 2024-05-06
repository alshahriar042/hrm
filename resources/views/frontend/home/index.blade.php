@extends('frontend.master')

@section('content')
    <main>
        <!-- banner start -->
        <section class="">
            <div id="carouselSlider1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="sliders-img carousel-item active carousel-item-list position-relative">
                        <img src="{{ asset('frontend/assets/image/bg-bfsa.png') }}" class="w-100" alt="..." />
                        <div class="text-center banner-text-content">
                            <div class="banner-title-info">
                                <h1 class="banner-title">
                                    Automated Health Certification System and an Online Lab
                                    Information Repository
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner end -->
        <!-- search card start -->
        <section class="container">
            <!-- search card start -->
            <div class="search-grid">
                <div class="search-card shadow rounded-3">
                    <a href="search-lab.html" class="card-links">
                        <div class="d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="card-icon-img">
                                <img src="{{ asset('frontend/assets/image/card-image.png') }}" alt="" />
                            </div>
                            <h6 class="card-tilte">Search a Lab</h6>
                            <p class="card-text">9 Labs</p>
                        </div>
                    </a>
                </div>
                <div class="search-card shadow rounded-3">
                    <a href="available-test.html" class="card-links">
                        <div class="d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="card-icon-img">
                                <img src="{{ asset('frontend/assets/image/card-image.png') }}" alt="" />
                            </div>
                            <h6 class="card-tilte">Available Tests</h6>
                            <p class="card-text">100 Tests</p>
                        </div>
                    </a>
                </div>
                <div class="search-card shadow rounded-3">
                    <a href="" class="card-links">
                        <div class="d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="card-icon-img">
                                <img src="{{ asset('frontend/assets/image/card-image.png') }}" alt="" />
                            </div>
                            <h6 class="card-tilte">BFSA Labs</h6>
                            <p class="card-text">9 Labs</p>
                        </div>
                    </a>
                </div>

                <div class="search-card shadow rounded-3">
                    <a href="" class="card-links">
                        <div class="d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="card-icon-img">
                                <img src="{{ asset('frontend/assets/image/card-image.png') }}" alt="" />
                            </div>
                            <h6 class="card-tilte">Labs Under Suspension / Deferment</h6>
                            <p class="card-text">10 Labs</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- search card end -->
        <!-- news events start -->
        <section class="section-conatiner online-repo">
            <div class="container">
                <h3 class="title">News and Events</h3>
                <ul class="news-events">
                    <li>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href="notices.html"
                            title="অফিস আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের জেলা কার্যালয়ে
                কর্মরত নমুনা সংগ্রহ সহকার...">দরপত্র
                            বিজ্ঞপ্তি (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের সক্ষমতা
                            বৃদ্ধিকরণ প্রকল্পের রাসায়নিক দ্রব্যাদি ও টেষ্টিং কিটস ক্রয়ের
                            পুনঃদরপত্র বিজ্ঞপ্তি সংক্রান্ত)</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href=""
                            title="অফিস আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের দাপ্তরিক কার্যক্রম সুষ্ঠুভাবে সম্পাদনের ...">অফিস
                            আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের সক্ষমতা বৃদ্ধিকরণ
                            প্রকল্পের আওতায় স্থাপিত নিজস্ব কল সেন্টার (নম্বর: ১৬১৫৫ টোল
                            ফ্রি) এর বিষয়ভিত্তিক জিজ্ঞাসা/পরামর্শের তথ্য প্রদানের নিমিত্ত
                            নিম্নবর্ণিত কর্মকর্তাগণকে নির্দেশক্রমে দায়িত্ব প্রদান
                            প্রসঙ্গে)।</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href="notices.html"
                            title="অফিস আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের দাপ্তরিক কার্যক্রম সুষ্ঠুভাবে সম্পাদনের ...">সভার
                            নোটিশ (Harmonized Food Safety Regulation of BFSA এর খসড়া
                            পর্যালোচনা এবং চূড়ান্তকরণের নিমিত্ত সেমিনার আয়োজন কমিটির প্রথম
                            সভা প্রসঙ্গে)।</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href="notices.html"
                            title="অফিস আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষ কর্তৃক গঠিত নিম্নোক্ত কারিগরি কমিটির সাচিব...">অফিস
                            আদেশ (বাংলাদেশ নিরাপদ খাদ্য কর্তৃপক্ষের প্রধান কার্যালয়ে
                            সংযুক্তিতে কর্মরত জনাব ছানোয়ার হোসেন, নিরাপদ খাদ্য পরিদর্শক কে
                            আঞ্চলিক খাদ্য নিয়ন্ত্রক, ঢাকা এর অধীনে বদলি করায় তাঁকে বাংলাদেশ
                            নিরাপদ খাদ্য কর্তৃপক্ষ হতে ২৭ ফেব্রুয়ারি ২০২৩ খ্রিষ্টাব্দ
                            অপরাহ্ণ হতে নির্দেশক্রমে অবমুক্তকরণ প্রসঙ্গে)।</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href="notices.html"
                            title="অনাপত্তি সনদ (NOC) (সুমাইয়া আফরিন জিনিয়া, নিরাপদ খাদ্য অফিসার, বাংলাদেশ নিরাপদ খাদ্য ...">জরুরি
                            নোটিশ (পরীবাগ, শাহবাগে অবস্থিত "ভাই ভাই রেস্টুরেন্ট"
                            আগামী ০৫/০৩/২০২৩ তারিখ পর্যন্ত বন্ধ ঘোষণা করা সংক্রান্ত)</a>
                    </li>
                </ul>
            </div>
        </section>

        <!-- news events end -->
        <!-- online repository start -->
        <section class="section-conatiner container">
            <h3 class="title">Our Service</h3>
            <div class="card-tamplate-grid">
                <div class="">
                    <div class="online-img">
                        <img src="{{ asset('frontend/assets/image/onlineReop-2.png') }}" alt="" />
                    </div>

                    <h6 class="online-card-title">Search Lab</h6>
                    <p class="online-card-text text-center">
                        Select your required service from the service directory and submit
                        the application by providing the required information.
                    </p>
                </div>
                <div class="">
                    <div class="online-img">
                        <img src="{{ asset('frontend/assets/image/onlineReop-2.png') }}" alt="" />
                    </div>

                    <h6 class="online-card-title">Search Test</h6>
                    <p class="online-card-text text-center">
                        Select your required service from the service directory and submit
                        the application by providing the required information.
                    </p>
                </div>
                <div class="">
                    <div class="online-img">
                        <img src="{{ asset('frontend/assets/image/onlineRepo-3.png') }}" alt="" />
                    </div>

                    <h6 class="online-card-title">Details Information</h6>
                    <p class="online-card-text text-center">
                        Select your required service from the service directory and submit
                        the application by providing the required information.
                    </p>
                </div>
            </div>
        </section>
        <!-- online repository end -->

        <!-- recent post start -->
        <section class="recent-blog">
            <div class="container mb-4">
                <h3 class="title">Recent updates</h3>
                <div class="post-content">
                    <!-- Swiper -->
                    <div class="swippers-container">
                        <!-- Swiper -->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <!-- blog card 1 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-1.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 2 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-2.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 3 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-3.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 4 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-4.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 5 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-5.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 6 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-1.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- blog card 7 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-1.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- product card 7 -->
                                <div class="swiper-slide">
                                    <a href="single-blog.html">
                                        <div>
                                            <div class="slider-img">
                                                <img src="{{ asset('frontend/assets/slider/postSlider-1.jpg') }}" alt="" />
                                            </div>
                                            <div class="bolg-content">
                                                <p class="online-card-text blog-text">
                                                    BFSA Platform: Digital is another 162 services
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-button-next next-btn">
                                <i class="fa-solid fa-circle-arrow-right slider-icon"></i>
                            </div>
                            <div class="swiper-button-prev prev-btn">
                                <i class="fa-solid fa-circle-arrow-left slider-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- need help start -->
            <div class="need-help">
                <div class="container">
                    <h3 class="title">Need any help?</h3>
                    <div class="need-content">
                        <div class="need-left">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOneHelp">
                                        <button
                                            class="accordion-button faq-btn d-flex align-items-center justify-content-between"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOneHelp" aria-expanded="true"
                                            aria-controls="collapseOneHelp">
                                            <div>
                                                <img src="{{ asset('frontend/assets/image/call_icon.png') }}" alt="" />
                                                <span class="call-text"> call</span>
                                            </div>
                                            <div class="arrow-acc-icon">
                                                <i class="fa-solid fa-chevron-up"></i>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOneHelp" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOneHelp" data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-0 py-0">
                                            <ul class="call-list">
                                                <li
                                                    class="d-flex align-items-center justify-content-between pe-3 call-number border-bottom">
                                                    <div class="call-text">
                                                        <h6>333</h6>
                                                        <p class="">
                                                            Government information and services
                                                        </p>
                                                    </div>
                                                    <div class="phone-icon">
                                                        <i class="fa-solid fa-phone"></i>
                                                    </div>
                                                </li>
                                                <li
                                                    class="d-flex align-items-center justify-content-between pe-3 call-number border-bottom">
                                                    <div class="call-text">
                                                        <h6>999</h6>
                                                        <p class="">emergency services</p>
                                                    </div>
                                                    <div class="phone-icon">
                                                        <i class="fa-solid fa-phone"></i>
                                                    </div>
                                                </li>
                                                <li
                                                    class="d-flex align-items-center justify-content-between pe-3 call-number">
                                                    <div class="call-text">
                                                        <h6>09666727278</h6>
                                                        <p class="">Any problem / query regardingBFSA</p>
                                                    </div>
                                                    <div class="phone-icon">
                                                        <i class="fa-solid fa-phone"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="need-right">
                            <div>
                                <img src="{{ asset('frontend/assets/image/help-img.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- need help end -->
        </section>
        <!-- recent post end -->
    </main>
@endsection
