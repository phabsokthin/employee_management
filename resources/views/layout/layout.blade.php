<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>គ្រប់គ្រង់បុគ្គលិក</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}"><i class='bx bx-menu' ></i></a>
            <b>{{ Auth::user()->name }}</b>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}"><i class='bx bx-user'></i>បុគ្គលិក</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('position') }}"><i class='bx bx-repost' style="font-size: 20px"></i>មុខដំណែង</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('attace_pos') }}" id="navbarDropdown" role="button">
                            <i class='bx bxs-user-rectangle' ></i> វត្តមានបុគ្គលិក
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('salary') }}" tabindex="-1" aria-disabled="true"><i class='bx bx-money' ></i> ប្រាក់ខែបុគ្គលិក</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history') }}" tabindex="-1" aria-disabled="true"><i class='bx bx-history'></i> ប្រវត្តិបុគ្គលិក</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" tabindex="-1" aria-disabled="true"><i class='bx bxs-user-account'></i>User Account</a>
                    </li>
                    <li class="nav-item">
                       <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger btn-sam"><i class='bx bx-log-in' ></i> ចាក់ចេញ</button>
                       </form>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
