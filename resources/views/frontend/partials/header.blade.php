<header class="">
    <nav class="navbar navbar-expand-lg z-3 nav-fixed">
        <div class="px-lg-0 container">
            <a href="index.html">
                <div class="logo-text">
                    <div class="home-page-logo">
                        <img class="" src="{{ asset('frontend/assets/logo/home-logo1.png') }}" alt="" />
                    </div>
                    <div class="logo-name">
                        <p>Bangladesh Food</p>
                        <p class="safty-auth">Safety Authority</p>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb- input-field-contentlg-0">
                    <li class="nav-item">
                        <a class="nav-link me-3 nav-text" aria-current="page" href="index.html">Home</a>
                    </li>
                    <!-- dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 nav-text dropdown-toggle" href="about.html" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">About BFSA</a>
                        <ul class="dropdown-menu drop-down-menu shadow">
                            <li>
                                <a class="dropdown-item nav-text dropdow-text" href="about.html">Overview</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-text dropdow-text" href="search-lab.html">List of BFSA
                                    Lab</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-text dropdow-text" href="available-test.html">List of
                                    Test</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 nav-text" href="contact.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text" href="user-manual.html">User Manual</a>
                    </li>
                </ul>
                <div class="d-lg-flex align-items-center">
                    <div class="d-flex align-items-center gap-2 nav-btn">
                        <a href="login.html">
                            <button type="button" class="btn bg-success text-white btn-user btn-register">
                                Login
                            </button></a>
                    </div>

                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content">
                        <p class="language-text">English</p>
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0" type="checkbox" role="switch"
                                checked />
                        </div>
                        <p class="language-text">বাংলা</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
