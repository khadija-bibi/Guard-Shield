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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

    .btn-sm {
        margin: 2px;
    }
    .btn-custom {
    color: white;
    background-color: #154D4B;
    border: 2px solid #154D4B;
    /* padding: 8px 20px;
    border-radius: 5px; */
    transition: 0.3s ease-in-out;
}

.btn-custom:hover {
    background-color: white;
    color: #154D4B;
    border: 2px solid #154D4B;
}
 

        .disabled-option {
            color: #aaa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        /* .sidebar {
            background: linear-gradient(135deg, #00827F, #A9E7D4);
            min-height: 100vh;
        } */
        .sidebar {
            width: 250px; /* Set a fixed width */
            min-height: 100vh;
            background: linear-gradient(to bottom, #1F7972, #96D5C1); /* Adjust gradient */
            padding: 20px; /* Ensure padding */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo-text {
            font-size: 24px;
            background: linear-gradient(135deg, #000000, #00827F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            font-weight: 700;
            
        }

        .logo-text2 {
            font-size: 24px;
        }
        .sidebar img {
            display: block;
            margin: 25px auto; 
            padding: 10px; 
            max-width: 80%; 
        }

        

        /* .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #154D4B;
            border-radius: 5px;
        } */
        .content {
            padding: 20px;
        }
        /* .menu-head{
            font-weight: 600;
            color: #154D4B
        } */
        .menu-head {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            color: #1D4D4A; /* Adjust color */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }

        .sidebar a:hover, .active {
            background-color: #154D4B;
            /* background-color: rgba(255, 255, 255, 0.2); */
        }
        .profile-ring {
    padding: 3.5px; 
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-image {
    border-radius: 50%;
    background-color: #fff; 
    padding: 4px; 
}

.page-item.active .page-link {
    background-color: #154D4B;
    border-color: #154D4B;
    color: white;
}

.page-link {
    color: #154D4B;
}

.page-link:hover {
    color: #154D4B;
}

.card-small {
      border-radius: 15px;
      padding: 20px;
      color: white;
      height: 170px;
    }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-none d-lg-block col-lg-2 p-3">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('assets/image1.png') }}" alt="Image" height="90px" width="100px" style="margin-bottom: 0px">
                <div class="text-center">
                    <span class="logo-text ">Guard Shield</span> 
                    <span class="logo-text2 fw-bolder text-white">360</span>
                </div>
            </div>
            <div style="margin-left: 10px">
                <p class="menu-head" >Home</p>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>
                    Dashboard</a>
                <p class="menu-head">User Management</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index', 'roles.create', 'roles.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circles"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.5 12a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M17.5 12a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M12 2a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /></svg>
                    Roles</a>
                {{-- @endcan --}}
                {{-- @can('view users') --}}
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index', 'users.create', 'users.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    Users</a>
                {{-- @endcan --}}
                 @if(in_array(auth()->user()->user_type, ['superAdmin','adminEmployee']))
                <p class="menu-head">Customer Management</p>
                @can('view companies')
                <a href="{{ route('companies.index') }}" class="{{ request()->routeIs('companies.index','companies.detail', 'companies.docs') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
                    Companies</a>
                @endcan
                @can('view companies request')
                <a href="{{ route('companies-request.index') }}" class="{{ request()->routeIs('companies-request.index', 'company-request.detail', 'company-request.docs') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" /><path d="M12.5 15.5l2 2" /><path d="M15 13l2 2" /></svg>
                    Requests</a>
                @endcan
                @endif
                @if(in_array(auth()->user()->user_type, ['companyOwner','companyEmployee']))
                <p class="menu-head">HRM</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.index', 'employees.create', 'employees.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                    Employees</a>
                <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendence.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                    Attendence</a>
                {{-- @endcan --}}
                <p class="menu-head">CRM</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('services-request.index') }}" class="{{ request()->routeIs('services-request.index', 'service-request.detail',) ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>
                    Service Requests</a>
                {{-- @endcan --}}
                
                <p class="menu-head">Incident Reporting</p>
                <a href="{{ route('incidents.index') }}" class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                    Incidents</a>
                <p class="menu-head">Reviews and Ratings</p>
                <a href="{{ route('feedbacks.index') }}" class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h4.5" /><path d="M10.325 19.605l-2.325 1.395v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" /><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>
                    Feedbacks</a>   
                @endif

            </div>
            
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
                <p class="menu-head" >Home</p>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>
                    Dashboard</a>
                <p class="menu-head">User Management</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index', 'roles.create', 'roles.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circles"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.5 12a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M17.5 12a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M12 2a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /></svg>
                    Roles</a>
                {{-- @endcan --}}
                {{-- @can('view users') --}}
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index', 'users.create', 'users.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    Users</a>
                {{-- @endcan --}}
                 @if(in_array(auth()->user()->user_type, ['superAdmin','adminEmployee']))
                <p class="menu-head">Customer Management</p>
                @can('view companies')
                <a href="{{ route('companies.index') }}" class="{{ request()->routeIs('companies.index','companies.detail', 'companies.docs') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
                    Companies</a>
                @endcan
                @can('view companies request')
                <a href="{{ route('companies-request.index') }}" class="{{ request()->routeIs('companies-request.index', 'company-request.detail', 'company-request.docs') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" /><path d="M12.5 15.5l2 2" /><path d="M15 13l2 2" /></svg>
                    Requests</a>
                @endcan
                @endif
                @if(in_array(auth()->user()->user_type, ['companyOwner','companyEmployee']))
                <p class="menu-head">HRM</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.index', 'employees.create', 'employees.edit') ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                    Employees</a>
                <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendence.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                    Attendence</a>
                {{-- @endcan --}}
                <p class="menu-head">CRM</p>
                {{-- @can('view roles') --}}
                <a href="{{ route('services-request.index') }}" class="{{ request()->routeIs('services-request.index', 'service-request.detail',) ? 'active' : '' }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>
                    Service Requests</a>
                {{-- @endcan --}}
                
                <p class="menu-head">Incident Reporting</p>
                <a href="{{ route('incidents.index') }}" class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                    Incidents</a>
                <p class="menu-head">Reviews and Ratings</p>
                <a href="{{ route('feedbacks.index') }}" class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h4.5" /><path d="M10.325 19.605l-2.325 1.395v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" /><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>
                    Feedbacks</a>   
                @endif

            </div>
        </div>
        
        <div class="col-lg-10 col-md-12 content">
            <nav class="navbar navbar-light bg-light p-3">
                <div class="container-fluid">
                    <div  class="d-flex justify-content-end align-items-center justify-evenly w-100">
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
                        <form action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <button type="submit" class="btn btn-outline-dark  ms-2" >Logout</button>
                        </form>
                        <div class="profile-ring bg-dark ms-2">
                            <img src="{{ URL::asset('assets/image3.png') }}" alt="Profile" class="profile-image" height="50" width="50">
                        </div>                        
                    </div>
                </div>
            </nav>
            <div>
                @yield('content')
            </div>
        </div>
    </div>
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
