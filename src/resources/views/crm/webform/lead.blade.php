<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.includes.header')
    <title>{{ app_trans('default.webform') }}</title>
</head>
<body>
    <main id="app">
        <lead-web-form></lead-web-form>
    </main>
    @include('layouts.includes.footer')
</body>
</html>
