<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Mapbox CSS -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
    <!-- Mapbox JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <title>@yield('title', 'Auth Page')</title>
    <style>
        body {
            background-color: #eaf4f2;
            font-family: 'Poppins', sans-serif; 
        }
        .logo-text {
            font-size: 32px;
            background: linear-gradient(135deg, #000000, #00827F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .logo-text2 {
            font-size: 32px;
        }


        .left-panel {
            background: linear-gradient(135deg, #00827F, #A9E7D4);
            color: white;
            
        }
        .transparent-box {
            background: rgba(255, 255, 255, 0.15); 
            backdrop-filter: blur(10px); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background: linear-gradient(135deg, #00827F, #A9E7D4);
            color: white;
        }
        .btn-custom:hover {
            background-color: #085d58;
            
        }
        .custom-container {
            width: 100%;
            max-width: 400px; 
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="p-sm-1 p-md-2">
    @yield('content')
</body>
</html>