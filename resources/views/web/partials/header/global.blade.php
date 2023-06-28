<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@if(trim($__env->yieldContent('seo_title')))@yield('seo_title')@else{{config('seo.title')}}@endif</title>
<meta name="description" content="@if(trim($__env->yieldContent('seo_description')))@yield('seo_description')@else{{config('seo.description')}}@endif">
<meta property="og:title" content="@if(trim($__env->yieldContent('seo_title')))@yield('seo_title')@else{{config('seo.title')}}@endif">
<meta property="og:description" content="@if(trim($__env->yieldContent('seo_description')))@yield('seo_description')@else{{config('seo.description')}}@endif">
<meta property="og:url" content="{{url()->current()}}">
@if (trim($__env->yieldContent('seo_image')))
<meta property="og:image" content="{{url('/')}}/image/opengraph/@yield('seo_image')">
@else
<meta property="og:image" content="{{url('/')}}/assets/img/pos-quality1-og.png">
@endif
<meta property="og:site_name" content="@if(trim($__env->yieldContent('seo_title')))@yield('seo_title')@else{{config('seo.title')}}@endif">
<meta name="twitter:card" content="@if(trim($__env->yieldContent('seo_description')))@yield('seo_description')@else{{config('seo.description')}}@endif">
<link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/assets/img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="/assets/img/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/assets/img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="format-detection" content="telephone=no">
<link href="{{ mix('assets/css/app.css') }}" type="text/css" rel="stylesheet" />
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
</head>
<body>
<header class="site-header">
  <div>
    <figure class="logo">
      <a href="https://quality1.ch/{{ str_replace('_', '-', app()->getLocale()) }}" target="_blank" title="quality1.ch">
        <img src="/assets/img/logo.png" width="1200" height="526" alt="Quality1">
      </a>
    </figure>
    <nav class="language">
      <ul>
        <li>
        <a href="{{ route('de.page.listing') }}" class="{{ request()->routeIs('de.page.listing') || request()->routeIs('page.listing') ? 'is-active' : '' }}">DE</a>
        </li>
        <li>
          <a href="{{ route('fr.page.listing') }}" class="{{ request()->routeIs('fr.page.listing') ? 'is-active' : '' }}">FR</a>
        </li>
        <li>
          <a href="{{ route('it.page.listing') }}" class="{{ request()->routeIs('it.page.listing') ? 'is-active' : '' }}">IT</a>
        </li>
      </ul>
    </nav>
  </div>
</header>