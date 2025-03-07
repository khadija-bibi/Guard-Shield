<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Guard Shield 360</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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

            <a href="#" class="active">Dashboard</a>
            <a href="#">User Management</a>
            <a href="#">Roles</a>
            <a href="#">Users</a>
            <a href="#">Companies</a>
            <a href="#">Settings</a>
            <a href="#">Profile</a>
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
                <a href="#">Dashboard</a>
                <a href="#">User Management</a>
                <a href="#">Roles</a>
                <a href="#">Users</a>
                <a href="#">Companies</a>
                <a href="#">Settings</a>
                <a href="#">Profile</a>
            </div>
        </div>
        
        <div class="col-lg-10 col-md-12 content">
            <nav class="navbar navbar-light bg-light p-3">
                <div class="container-fluid">
                    <span class="navbar-brand">Home / Dashboard</span>
                    <div>
                        <form action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Logout</button>
                        </form>
                        <img src="profile.png" alt="Profile" class="rounded-circle" width="40">
                    </div>
                </div>
            </nav>
            <div class="bg-white p-5 rounded shadow-sm">
                <h4>Welcome to Dashboard</h4>
                <p>Your security, our priority.</p>
            </div>
        </div>
    </div>
</body>
</html>
