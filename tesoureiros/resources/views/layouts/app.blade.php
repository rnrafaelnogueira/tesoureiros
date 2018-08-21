<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NG') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<?php
$navbar =  Navbar::withBrand(config('app.name'), url('/admin/dashboard'))->inverse();
if(Auth::check()){
    $arrayLinks = [
        ['link' => route('users.index'), 'title' => 'Membros'],
    ];

    $menuRight = Bootstrapper\Facades\Navigation::links([
        [
            Auth::user()->name,
            [
                [
                    'link' => route('logout') ,
                    'title' => 'Logout',
                    'linkAttributes' => [
                        'onclick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                    ]
                ]
            ]
        ]
    ])->right();

    $menus = Bootstrapper\Facades\Navigation::links($arrayLinks);
    $navbar->withContent($menus)->withContent($menuRight);
}
?>
{!! $navbar !!}
<?php $formLogout = FormBuilder::plain([
    'id' => 'form-logout',
    'route' => ['logout'],
    'method' => 'POST',
    'style' => 'display:none'
])?>

{!! form($formLogout) !!}

<div id="app">
    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
