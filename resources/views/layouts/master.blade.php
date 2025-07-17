<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Jelajahi wisata Dieng yang penuh pesona, dari Candi Dieng hingga panorama alam yang memukau di Wonosobo.')">
    <meta name="keywords"
        content="Wisata Dieng, Candi Dieng, Wisata Wonosobo, Dataran Tinggi Dieng, Destinasi Wisata Indonesia">
    <meta name="author" content="Affandi Putra Pradana">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/png" href="{{ asset('image/home/'.$home->logo) }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Open Graph (Facebook, WhatsApp) -->
    <meta property="og:title" content="Lestari Wisata Dieng - Keindahan Alam">
    <meta property="og:description"
        content="Jelajahi keindahan Dieng, dari Candi Dieng hingga panorama alam yang memukau di Wonosobo.">
    <meta property="og:image" content="{{ asset('image/home/'.$home->hero_image) }}">
    <meta property="og:url" content="https://www.namadomain.com/wisata-dieng">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wisata Dieng - Keindahan Alam">
    <meta name="twitter:description"
        content="Jelajahi keindahan Dieng, dari Candi Dieng hingga panorama alam yang memukau di Wonosobo.">
    <meta name="twitter:image" content="{{ asset('image/home/'.$home->hero_image) }}">


    <title>@yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    {{-- Remix Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card-paket.css') }}">
</head>

<body>
    <header>
        @include('partials.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('partials.footer')
    </footer>

    {{-- Bootstrap JS (sudah termasuk Popper.js) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    @yield('script')
</body>

</html>
