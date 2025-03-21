<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Page')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        vertical-align: middle;
    }

    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    td {
        background-color: #ffffff;
    }

    tr {
        margin-bottom: 10px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-sm {
        margin: 2px;
    }
    .btn-custom {
            background: linear-gradient(135deg, #00827F, #A9E7D4);
            color: white;
        }
        .disabled-option {
            color: #aaa;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(135deg, #00827F, #A9E7D4);
            min-height: 100vh;
        }
        .logo-text {
            font-size: 26px;
            background: linear-gradient(135deg, #000000, #00827F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .logo-text2 {
            font-size: 26px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-none d-lg-block col-lg-2 p-3">
            <h3>
                <span class="logo-text fw-bolder">Guard Shield</span> 
                <span class="logo-text2 fw-bolder text-white">360</span>
            </h3> 
            <div class=""><img src="{{ asset('assets/image.png') }}" alt="Image" height="90px" width="100px"></div>

            <p>Home</p>
            <a href="#" class="active">Dashboard</a>
            <p>User Management</p>
            <a href="{{ route('roles.index') }}">Roles</a>
            <a href="{{ route('users.index') }}">Users</a>
            <p>Operations</p>
            <a href="#">Companies</a>
            <a href="">Requests</a>
        </div>
        
        <!-- Mobile Sidebar Toggle -->
        <div class="d-lg-none">
            <button class="btn btn-dark m-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                &#9776;
            </button>
        </div>
        <div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="text-white">Guard Shield 360</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Home</p>
                <a href="#">Dashboard</a>
                <p>User Management</p>
                <a href="{{ route('roles.index') }}">Roles</a>
                <a href="{{ route('users.index') }}">Users</a>
                <p>Operations</p>
                <a href="#">Companies</a>
                <a href="">Requests</a>
            </div>
        </div>
        
        <div class="col-lg-10 col-md-12 content">
            <nav class="navbar navbar-light bg-light p-3">
                <div class="container-fluid">
                    <div>
                        <form action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Logout</button>
                        </form>
                        <img src="profile.png" alt="Profile" class="rounded-circle" width="40">
                    </div>
                </div>
            </nav>
            <div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
