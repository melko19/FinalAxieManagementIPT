<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('../css/style.css')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>IPT Final Major Project</title>
</head>
<body>
    @if (session('Error'))
        <div class="alert alert-danger fixed-top">
            <div class="container">
                {{ session('Error') }}
            </div>
        </div>
    @endif
    @if (session('Message'))
        <div class="alert alert-info fixed-top">
            <div class="container">
                {{ session('Message') }}
            </div>
        </div>
    @endif
    @if(session('errors'))
        <div class="alert alert-danger fixed-top">
            <div class="container">
                Please fix the following errors
                <ul>
                    @foreach(session('errors')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div> 
    @endif
    <div >
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent ">
            <div class="container mt-5">
                <h2>Koro Company</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                        @if(Auth::check())          
                            <li class="nav-item">
                                <a class="nav-link active" href="/dashboard">Dashboard</a>
                            </li>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/logout">Logout</a>
                            </li>
                        @else

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login">Login</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link active" href="#">About Axie</a>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>  
    </div>
    @yield('content')
    </div>  
</body>
</html>
