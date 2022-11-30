<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Atlas</title>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div id="app">
            <Appheader></Appheader>
            @auth
            <Usernavbar1 :user="{{ Auth::user() }}"></Usernavbar1>
                @if(session()->has('message'))
                <div class="w-50 ml-auto mr-auto text-center alert alert-success alert-dismissible fade show" role="alert">
                    <p class="m-0 p-0"><strong>{{session('message')}}<button type="button" class="float-left close m-0 p-0" data-dismiss="alert" aria-label="Close">&times;</button></strong></p>
                </div>
                @endif
            <div class="container w-75">
                <h1 class="text-center">Profile Settings</h1>
                <h2 class="text-center">Account Details</h2>
                <form class="mt-5" method="POST" action="/settings/updating/{{Auth::user()->id}}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-row form-center">
                    <div class="form-group col-md-3">
                        <label for="first_name">First Name: </label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{Auth::user()->first_name}}" />
                        
                        @error('firstName')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="last_name">Last Name: </label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{Auth::user()->last_name}}" />
                        @error('lastName')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row form-center">
                    <div class="form-group col-md-3">
                        <label>Birthdate: </label>
                        <input type="date" name="birthdate" class="form-control" value="{{Auth::user()->birthdate}}" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">E-mail: </label>
                        <input type="text" class="form-control" name="email" placeholder="E-mail" value="{{Auth::user()->email}}"/>
                        @error('email')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row form-center">
                    <div class="form-group col-md-6">
                        <label for="username">Username: </label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="{{Auth::user()->username}}"/>
                        @error('username')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-around w-75 ml-auto mr-auto mt-4">
                    <div>
                        <button type="submit" class="btn btn-outline-success btn-lg"> Save Changes  </button>
                    </div>
                    <div>
                        <button type="button" onclick="window.location.href=`/password`" class="btn btn-outline-danger btn-lg">Change Password</button>
                    </div>
                </div>
                </form>
            </div>
            @else
            <Mainnavbar></Mainnavbar>
            @endauth
        </div>
        @vite('resources/js/app.js')
    </body>
</html>