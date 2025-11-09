<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Service Seeker Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 25px;
        }

        .navbar-brand {
            font-weight: 700;
            color: #154D4B !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-nav .nav-link {
            color: #154D4B !important;
            font-weight: 500;
            margin-right: 20px;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #0e3d3b !important;
            text-decoration: underline;
        }

        .profile-ring {
            border: 2px solid #154D4B;
            border-radius: 50%;
            padding: 3px;
        }

        .profile-image {
            border-radius: 50%;
            height: 40px;
            width: 40px;
        }

        .btn-logout {
            border: 2px solid #154D4B;
            color: #154D4B;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background-color: #154D4B;
            color: #fff;
        }
        .btn-custom {
            color: white;
            background-color: #154D4B;
            border: 2px solid #154D4B;
            /* padding: 8px 20px;
            border-radius: 5px; */
            transition: 0.3s ease-in-out;
        }
        .logo-text {
            font-size: 24px;
            background: linear-gradient(135deg, #000000, #00827F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            font-weight: 700;
            
        }
        .custom-container {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 40px 50px;
            width: 80%;
            margin: 0 50px 50px 50px auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
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
        font-weight: 600;
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

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/image1.png') }}" alt="Logo">
                Guard Shield 360
            </a>

            <!-- Menu toggle for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('companies/show') ? 'active' : '' }}" href="{{ route('companies.show')}}">Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('service/create') ? 'active' : '' }}" href="{{ route('service-request.create')}}">Create Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('my-requests') ? 'active' : '' }}" href="{{ route('my-requests.index')}}">View Requests</a>
                    </li>
                </ul>
            </div>

            <!-- Right Icons -->
            <div class="d-flex align-items-center">
                <!-- Bell Icon -->
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" id="notificationBell" data-bs-toggle="dropdown">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell ms-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount">
                            0
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-1"  id="notificationList">
                        <li class="dropdown-header text-center fw-bold">Notifications</li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="text-center text-muted">No new notifications</li>
                    </ul>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-logout me-3">Logout</button>
                </form>

                <!-- Profile -->
                <div class="profile-ring">
                    <img src="{{ asset('assets/image3.png') }}" class="profile-image" alt="Profile">
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-2">
        @yield('content')
    </main>
    <script>
        $(document).ready(function(){
            function loadNotifications(){
                $.get("{{ route('notifications.fetch') }}", function(data){
                    let list = '';
                    let unreadCount = data.notifications.filter(n => n.read_at === null).length;

                    if(data.notifications.length > 0){
                        $('#notificationCount').text(unreadCount);
                        data.notifications.forEach(function(notify){
                            let isUnread = notify.read_at === null; 
                            list += `<li class="dropdown-item ${isUnread ? 'fw-bold' : ''}">
                                        ${notify.data.message}
                                    </li>`;
                        });
                    } else {
                        $('#notificationCount').text(0);
                        list = '<li class="text-center text-muted">No new notifications</li>';
                    }

                    $('#notificationList').html('<li class="dropdown-header text-center fw-bold">Notifications</li><hr>'+list);
                });
            }

            loadNotifications();
            setInterval(loadNotifications, 10000);

            $('#notificationBell').on('click', function(){
                $.post("{{ route('notifications.markAsRead') }}", {_token:'{{ csrf_token() }}'}, function(){
                    $('#notificationCount').text(0);
                });
            });
        });
    </script>
</body>
</html>
