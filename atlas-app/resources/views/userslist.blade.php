<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Atlas</title>
        
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        @vite(['resources/js/functions.js'])
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div id="app">
            <Appheader></Appheader>
            @auth
                @if (auth()->user()->role == "admin")
                    <h1>Please go back as admin you cannot view this</h1>
                @elseif (auth()->user()->role == "user")
                    <Usernavbar1 :user="{{ Auth::user() }}"></Usernavbar1>
                    <div class="outer-list">
                        @if($users->isEmpty())    
                            <p>No users found</p>
                        @else
                            <div>
                                @foreach($users as $user)
                                    <div class="m-2">
                                        <a href='/profile/{{$user->username}}' class="a-list">
                                            <div class="card-body card-list">
                                                <h5 class="card-title">{{$user->username}}</h5>
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-text"><strong>Name: </strong>{{$user->first_name}} {{$user->last_name}}</p>
                                                    <p class="card-text"><strong>Birthdate: </strong>{{$user->birthdate}}</p>
                                                    <p class="card-text"><strong>E-mail: </strong>{{$user->email}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>    
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @else
            <Mainnavbar></Mainnavbar>
            <div class="outer-list">
                @if($users->isEmpty())    
                    <p>No users found</p>
                @else
                    @foreach($users as $user)
                        <div class="m-2">
                            <a href='/profile/{{$user->username}}' class="a-list">
                                <div class="card-body card-list">
                                    <h5 class="card-title">{{$user->username}}</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text"><strong>Name: </strong>{{$user->first_name}} {{$user->last_name}}</p>
                                        <p class="card-text"><strong>Birthdate: </strong>{{$user->birthdate}}</p>
                                        <p class="card-text"><strong>E-mail: </strong>{{$user->email}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>    
                    @endforeach
                @endif
            </div>
            @endauth
        </div>
        @vite('resources/js/app.js')
    </body>
</html>