<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Front End</title>
    <link href="{{ asset(mix('css/app.css')) }}" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
     <!-- Flipbook StyleSheet -->
  <link href="{{ asset('public/dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Icons Stylesheet -->
  <link href="{{ asset('public/dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset(mix('js/app.js')) }}" type="text/javascript"></script>
    <script src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script src="{{ asset(mix('js/vendor.js')) }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
     <!-- jQuery  -->
<script src="{{ asset('public/dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('public/dflip/js/dflip.min.js') }}" type="text/javascript"></script>


</body>

</html>
