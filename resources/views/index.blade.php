<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
</head>
<body>
@include('components.topbar')
@include('components.header')
<main>
    <div class="main-photo">
        <div class="glow-point">
            <h1>
                Best food for<br>
                your taste in <br>
                Puebla
            </h1>
            <p>
                Discover delectable cuisine and unforgettable moments <br>
                in our welcoming, culinary haven.
            </p>
            <button onclick="window.location.href = '{{ route('menu') }}';">
                Explore Menu
            </button>
        </div>
    </div>
</main>
<section class="browse">
    <h1> Browse Our Menu </h1>

    <div class="browse-card-container">
        <div class="browse-card">
            <img src="{{ asset('assets/images/breakfast.png') }}" alt="">
            <h2>Breakfast</h2>
            <p>
                In the new era of technology we <br>
                look in the future with certainty <br>
                and pride for our life.
            </p>
            <a href="{{ route('menu') }}"> Explore Menu</a>
        </div>
        <div class="browse-card">
            <img src="{{ asset('assets/images/main-dish.png') }}" alt="">
            <h2>Main Dishes</h2>
            <p>
                In the new era of technology we <br>
                look in the future with certainty <br>
                and pride for our life.
            </p>
            <a href="{{ route('menu') }}"> Explore Menu</a>
        </div>
        <div class="browse-card">
            <img src="{{ asset('assets/images/drinks.png') }}" alt="">
            <h2>Drinks</h2>
            <p>
                In the new era of technology we <br>
                look in the future with certainty <br>
                and pride for our life.
            </p>
            <a href="{{ route('menu') }}"> Explore Menu</a>
        </div>
        <div class="browse-card">
            <img src="{{ asset('assets/images/desserts.png') }}" alt="">
            <h2>desserts</h2>
            <p>
                In the new era of technology we <br>
                look in the future with certainty <br>
                and pride for our life.
            </p>
            <a href="{{ route('menu') }}"> Explore Menu</a>
        </div>
    </div>

</section>
<section class="about-us">
    <img src="{{ asset('assets/images/about-us.png') }}" alt="">
    <div class="about-us-container">
        <h1>We provide healthy<br>food for your family.</h1>
        <p class="bold">Our story Puebla history with a vision to create a unique dining <br>
            experience that merges fine dining, exceptional service, and a  <br>
            vibrant ambiance. Rooted in city's rich culinary culture, we aim to<br>
            honor our local roots while infusing a global palate.</p>
        <p>
            At place, we believe that dining is not just about food, but also about the <br>
            overall experience. Our staff, renowned for their warmth and dedication, <br>
            strives to make every visit an unforgettable event.
        </p>
        <button onclick="window.location.href = '{{ route('about') }}';">More About Us</button>
    </div>
</section>
<section class="event">
    <div class="event-container">
        <h1>We also offer unique <br>services for your events</h1>
        <div class="event-card-container">
            <div class="event-card">
                <img src="{{ asset('assets/images/caterings.png') }}" alt="">
                <h2>Caterings</h2>
                <p>In the new era of technology we look <br>in the future with certainty for life.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/images/birthdays.png') }}" alt="">
                <h2>Birthdays</h2>
                <p>In the new era of technology we look <br>in the future with certainty for life.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/images/weddings.png') }}" alt="">
                <h2>Weddings</h2>
                <p>In the new era of technology we look <br>in the future with certainty for life.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/images/events.png') }}" alt="">
                <h2>Events</h2>
                <p>In the new era of technology we look <br>in the future with certainty for life.</p>
            </div>
        </div>
    </div>
</section>
<section class="reviews">
    <div class="reviews-container">
        <h1>What Our Customers Say</h1>
        <div class="review-card-container">
            <div class="review-card">
                <h2>"The best restaurant"</h2>
                <p>Last night, we dined at place and were <br>
                    simply blown away. From the moment we <br>
                    stepped in, we were enveloped in an <br>
                    inviting atmosphere and greeted with <br>
                    warm smiles.</p>
                <hr>
                <div class="reviewer">
                    <img src="{{ asset('assets/images/nasser.png') }}" alt="">
                    <div class="reviewer-info">
                        <h3>Nasser</h3>
                        <span>Giza, Egypt</span>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <h2>"Simply delicious"</h2>
                <p>Place exceeded my expectations on all <br>
                    fronts. The ambiance was cozy and <br>
                    relaxed, making it a perfect venue for our <br>
                    anniversary dinner. Each dish was <br>
                    prepared and beautifully presented.</p>
                <hr>
                <div class="reviewer">
                    <img src="{{ asset('assets/images/nour.png') }}" alt="">
                    <div class="reviewer-info">
                        <h3>Nour</h3>
                        <span>Giza, Egypt</span>
                    </div>
                </div>
            </div>
            <div class="review-card">

                <h2>"One of a kind restaurant"</h2>
                <p>The culinary experience at place is first <br>
                    to none. The atmosphere is vibrant, the <br>
                    food - nothing short of extraordinary. The <br>
                    food was the highlight of our evening. <br>
                    Highly recommended.</p>
                <hr>
                <div class="reviewer">
                    <img src="{{ asset('assets/images/ekhlas.png') }}" alt="">
                    <div class="reviewer-info">
                        <h3>Ekhlas</h3>
                        <span>Giza, Egypt</span>
                    </div>
                </div>
            </div>
            <div class="review-card">

                <h2>"Absolutely amazing experience"</h2>
                <p>I had the most wonderful time at place. The <br>
                    service was impeccable, and every dish was <br>
                    a masterpiece. The attention to detail and <br>
                    the warm hospitality made our visit truly <br>
                    special. Will definitely be back!</p>
                <hr>
                <div class="reviewer">
                    <img src="{{ asset('assets/images/ekhlas.png') }}" alt="">
                    <div class="reviewer-info">
                        <h3>Menna</h3>
                        <span>Giza, Egypt</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('components.footer')
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
