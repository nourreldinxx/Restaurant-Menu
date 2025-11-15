document.addEventListener('DOMContentLoaded', function() {
    // Load components - using inline content to work with file:// protocol
    const topbarContent = `
<div class="topbar">
    <div class="contacts">
        <ul>
            <li class="phone">
                <a href="tel:+2001119404075"><i class="fa fa-phone"></i> +2001119404075</a>
            </li>
            <li class="email">
                <a href="mailto:nourahmed10122@gmail.com"><i class="fa fa-envelope"></i> send mail</a>
            </li>
        </ul>
    </div>
    <div class="links">
        <ul>
            <li class="facebook">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i> Facebook</a>
            </li>
            <li class="twitter">
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i> Twitter</a>
            </li>
            <li class="instagram">
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a>
            </li>
            <li class="github">
                <a href="https://github.com/nourreldinxx/Restaurant-Menu"><i class="fab fa-github"></i> GitHub</a>
            </li>
        </ul>
    </div>
</div>`;

    const headerContent = `
<header>
    <h1><img src="assets/images/mainlogo.png" alt="logo"> Restaurant Menu</h1>
    <div class="routes">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="menu.html">Menu</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="booking.html">Book A Table</a></li>
            <li><a href="contacts.html">Contact us</a></li>
            
        </ul>
    </div>
</header>`;

    const footerContent = `
<footer>
    <div class="footer-links">
        <div class="footer-links-and-logo">
            <div class="footer-logo">
                <img src="assets/images/logo.png" alt="">
                <h1>Restaurant Menu</h1>
            </div>
            <p class="footer-p">
                In the new era of technology we look a <br>
                in the future with certainty and pride to bring <br>
                for our company and.
            </p>
            <div class="fo-icons">
                <ul>
                    <li class="facebook">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li class="twitter">
                        <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="instagram">
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="github">
                        <a href="https://github.com/nourreldinxx/Restaurant-Menu"><i class="fab fa-github"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pages-footer">
            <h3>Pages</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="booking.html">Book A Table</a></li>
                <li><a href="contacts.html">Contact us</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-info">
        Copyright © 2025. All Rights Reserved
    </div>
</footer>`;

    // Insert content into DOM
    document.getElementById('topbar').innerHTML = topbarContent;
    document.getElementById('header').innerHTML = headerContent;
    document.getElementById('footer').innerHTML = footerContent;
});