<link rel="stylesheet" href="views/components/navbar/navbar.style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="assets/Logo-gezinshuis/Breed/GezinshuisRegterink_logo_breed.png" class="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/evenementen">evenementen</a>
            </li>
            <!-- Knop om de modal te openen -->
            <li class="nav-item">
                <a class="nav-link" id="navLogin" data-toggle="modal" href="#loginModal">Aanmelden</a>
            </li>
        </ul>
    </div>
</nav>

<?php
    require 'views/components/loginmodel/loginmodal.component.php';
?>


