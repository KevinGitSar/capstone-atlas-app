<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atlas</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css'])
    </head>
    <body>
    <div id="app">
        <Appheader></Appheader>
        <Mainnavbar></Mainnavbar>
    </div>
    <div class="container">
            @if(session()->has('message'))
                <div class="w-50 ml-auto mr-auto text-center alert alert-danger alert-dismissible fade show" role="alert">
                    <p class="m-0 p-0"><strong>{{session('message')}}<button type="button" class="float-left close m-0 p-0" data-dismiss="alert" aria-label="Close">&times;</button></strong></p>
                </div>
            @endif
            <h2 class="text-center display-4 m-2">Log in</h2>
            <form method="POST" action="/users/authenticate">
                {{ csrf_field() }}
                <div class="form-row form-center">
                    <div class="form-group col-md-6">
                        <label for="username">Username: </label>
                        <input type="text" class="form-control" name="username" placeholder="Username" />
                        @error('username')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                        <br />
                        <label for="password">Password: </label>
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                        @error('password')
                            <p class="text-danger fs-6 mt-1">{{$message}}</p>
                        @enderror
                        <br />
                        <div>
                            <button type="submit" class="btn btn-outline-success btn-lg">Log in</button>
                            <p class="m-0 bottom-zero">Don't have an account? <a href="/register">Sign up here!</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>