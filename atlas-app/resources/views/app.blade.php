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
                    <Adminnavbar :user="{{ Auth::user() }}"></Adminnavbar>
                    <div class="container">
                        <div class="text-center d-flex justify-content-around">
                            <button id="report-btn" class="btn btn-secondary">Reported Users</button>
                            <button id="ban-btn" class="btn btn-dark">Banned Users</button>
                            <button id="analytic-btn" class="btn btn-light">Analytics</button>
                        </div>
                        <div id="report-list" class="d-none justify-content-around mt-5">
                            <div class="container report-list-container">
                                <div id="put-header"></div>
                                <div id="put-btns" class="btn-group-vertical overflow-auto"></div>
                            </div>
                            <div id="put-header2"></div>
                            <div class="container show-reported-container overflow-auto">
                                <div id="show-reported"></div>
                                <div id="add-buttons" class="d-flex justify-content-around"></div>
                            </div>
                        </div>
                    </div>
                @elseif (auth()->user()->role == "user")
                    <Usernavbar1 :user="{{ Auth::user() }}"></Usernavbar1>
                    <div class="tag-search">
                        <form action="/home" method="GET">
                            <input name="tag" type="text" placeholder="Filter..." />
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    <div class="gallery justify-content-center">
                    @foreach($post as $item)
                        <div class="gallery-item">
                            <img class="gallery-image" src="{{url('storage/'.$item->image)}}" alt="{{$item->image}}">
                        </div>
                    @endforeach
                    </div>
                @endif
            @else
            <Mainnavbar></Mainnavbar>
            <div class="tag-search">
                <form action="/home" method="GET">
                    <input name="tag" type="text" placeholder="Filter..." />
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="gallery justify-content-center">
                @if(isset($post))
                    @foreach($post as $item)
                    <div class="gallery-item">
                        <img class="gallery-image" src="{{url('storage/'.$item->image)}}" alt="{{$item->image}}">
                    </div>
                    @endforeach
                @else
                    <h1>Session Expired</h1>
                @endif
            </div>
            @endauth
        </div>
        @vite('resources/js/app.js')
    </body>
</html>