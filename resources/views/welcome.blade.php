<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manage data</title>
    </head>
    <body>
        <div class="container" id="app">
            <client-component :config-data="{{$configData}}" ></client-component>
        </div>
    </body>
</html>
<script src="{{ mix('/js/app.js') }}"></script>
