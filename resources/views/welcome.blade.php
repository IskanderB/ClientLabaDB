<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manage data</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Tenor:ital@0;1&family=PT+Sans:wght@400;700&display=swap">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body class="page-body">
        <div class="container" id="app">
            <client-component :config-data="{{$configData}}" ></client-component>
        </div>
    </body>
</html>
<script src="{{ mix('/js/app.js') }}"></script>
