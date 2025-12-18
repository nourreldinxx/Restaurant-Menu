<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <section class="menu-section">
        <div class="menu-container">
            <h1>Our Menu</h1>
            <p class="menu-subtitle">
                We consider all the drivers of change gives you the components you need to change to create a truly happens.
            </p>
            
            <div class="menu-filters">
                <button class="filter-btn active" data-category="all">All</button>
                <button class="filter-btn" data-category="breakfast">Breakfast</button>
                <button class="filter-btn" data-category="main-dish">Main Dishes</button>
                <button class="filter-btn" data-category="drinks">Drinks</button>
                <button class="filter-btn" data-category="desserts">Desserts</button>
            </div>

            <div class="menu-items-grid">
                @forelse($menuItems as $item)
                <div class="menu-item" data-category="{{ $item->category }}">
                    <div class="menu-item-image">
                        <img src="{{ $item->image ?: 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=400&h=300&fit=crop' }}" alt="{{ $item->name }}">
                    </div>
                    <div class="menu-item-content">
                        <span class="menu-price">${{ number_format($item->price, 2) }}</span>
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p>No menu items available yet. Please check back later.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @include('components.footer')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
</body>
</html>
