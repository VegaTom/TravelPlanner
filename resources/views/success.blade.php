<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }}</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('img/favico.png') }}"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
                width: 12em;
            }

            .logo img{
                height: 100px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>
                <div class="title">{{ __('Success') }}</div>
                <div class="title">{{ __($message ?? 'We have processed your request') }}</div>
            </div>
        </div>
    </body>
</html>
