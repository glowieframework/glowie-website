<section class="preloader">
    <div class="spinner-border"></div>
</section>
<header>
    <section class="menu">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <a href="./"><img src="assets/images/logo.png" class="logo"></a>
                </div>
                <div class="col-12 col-lg-9 menu-links">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a href="./" class="nav-link <?= $page == 'home' ? 'active' : '' ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="docs" class="nav-link <?= $page == 'docs' ? 'active' : '' ?>">Documentation</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/glowieframework" class="nav-link">GitHub</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/glowieframework/glowie/discussions" class="nav-link">Support</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="shape-divider">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</header>
<a class="mobile-menu-button"><i class="fas fa-bars"></i></a>
<section class="mobile-menu">
    <span class="nav-link">
        <a href="./" class="<?= $page == 'home' ? 'active' : '' ?>">Home</a>
    </span>
    <span class="nav-link">
        <a href="docs" class="<?= $page == 'docs' ? 'active' : '' ?>">Documentation</a>
    </span>
    <span class="nav-link">
        <a href="https://github.com/glowieframework">GitHub</a>
    </span>
    <span class="nav-link">
        <a href="https://github.com/glowieframework/glowie/discussions">Support</a>
    </span>
</section>