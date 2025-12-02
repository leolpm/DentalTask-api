{{-- resources/views/partials/pwa.blade.php --}}

<!-- PWA + Favicons - DentalTask AI -->

<!-- Manifest -->
<link rel="manifest" href="{{ asset('manifest.json') }}">

<!-- Theme / PWA meta -->
<meta name="application-name" content="DentalTask AI">
<meta name="apple-mobile-web-app-title" content="DentalTask AI">
<meta name="theme-color" content="#0f172a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="mobile-web-app-capable" content="yes">

<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon-180x180.png') }}">

<!-- Favicons principais -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

<!-- WebP (browsers modernos) -->
<link rel="icon" type="image/webp" sizes="192x192" href="{{ asset('assets/img/favicons/android-chrome-192x192.webp') }}">
<link rel="icon" type="image/webp" sizes="512x512" href="{{ asset('assets/img/favicons/android-chrome-512x512.webp') }}">

<!-- PNG fallback -->
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicons/android-chrome-192x192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/img/favicons/android-chrome-512x512.png') }}">

{{-- SPLASH SCREENS iOS / iPadOS --}}
{{-- Light mode --}}
<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 320px) and (device-height: 568px)"
      href="{{ asset('assets/img/splash/splash-light-640x1136.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 375px) and (device-height: 667px)"
      href="{{ asset('assets/img/splash/splash-light-750x1334.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 414px) and (device-height: 736px)"
      href="{{ asset('assets/img/splash/splash-light-1242x2208.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 414px) and (device-height: 896px)"
      href="{{ asset('assets/img/splash/splash-light-828x1792.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 375px) and (device-height: 812px)"
      href="{{ asset('assets/img/splash/splash-light-1125x2436.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 390px) and (device-height: 844px)"
      href="{{ asset('assets/img/splash/splash-light-1170x2532.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 428px) and (device-height: 926px)"
      href="{{ asset('assets/img/splash/splash-light-1284x2778.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 428px) and (device-height: 932px)"
      href="{{ asset('assets/img/splash/splash-light-1290x2796.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 393px) and (device-height: 852px)"
      href="{{ asset('assets/img/splash/splash-light-1179x2556.png') }}">

{{-- iPad / iPad Pro - light --}}
<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 768px) and (device-height: 1024px)"
      href="{{ asset('assets/img/splash/splash-light-1536x2048.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 834px) and (device-height: 1112px)"
      href="{{ asset('assets/img/splash/splash-light-1668x2224.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 834px) and (device-height: 1194px)"
      href="{{ asset('assets/img/splash/splash-light-1668x2388.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: light) and (device-width: 1024px) and (device-height: 1366px)"
      href="{{ asset('assets/img/splash/splash-light-2048x2732.png') }}">

{{-- Dark mode --}}
<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 320px) and (device-height: 568px)"
      href="{{ asset('assets/img/splash/splash-dark-640x1136.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 375px) and (device-height: 667px)"
      href="{{ asset('assets/img/splash/splash-dark-750x1334.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 414px) and (device-height: 736px)"
      href="{{ asset('assets/img/splash/splash-dark-1242x2208.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 414px) and (device-height: 896px)"
      href="{{ asset('assets/img/splash/splash-dark-828x1792.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 375px) and (device-height: 812px)"
      href="{{ asset('assets/img/splash/splash-dark-1125x2436.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 390px) and (device-height: 844px)"
      href="{{ asset('assets/img/splash/splash-dark-1170x2532.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 428px) and (device-height: 926px)"
      href="{{ asset('assets/img/splash/splash-dark-1284x2778.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 428px) and (device-height: 932px)"
      href="{{ asset('assets/img/splash/splash-dark-1290x2796.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 393px) and (device-height: 852px)"
      href="{{ asset('assets/img/splash/splash-dark-1179x2556.png') }}">

{{-- iPad / iPad Pro - dark --}}
<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 768px) and (device-height: 1024px)"
      href="{{ asset('assets/img/splash/splash-dark-1536x2048.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 834px) and (device-height: 1112px)"
      href="{{ asset('assets/img/splash/splash-dark-1668x2224.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 834px) and (device-height: 1194px)"
      href="{{ asset('assets/img/splash/splash-dark-1668x2388.png') }}">

<link rel="apple-touch-startup-image"
      media="(prefers-color-scheme: dark) and (device-width: 1024px) and (device-height: 1366px)"
      href="{{ asset('assets/img/splash/splash-dark-2048x2732.png') }}">
