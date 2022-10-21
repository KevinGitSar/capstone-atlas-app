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
            <div id="postform" class="atlas-content-container">
                <form method="POST" action="/userpage/post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-row form-center">
                        <div class="form-group col-md-3 mt-3">
                            <input type="file" name="image" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-row form-center">
                        <input type="hidden" class="form-control" name="username" value="{{ Auth::user()->username }}" />
                        <div class="form-group col-md-3">
                            <label for="location">Add a Location: </label>
                            <input type="text" class="form-control" name="location" placeholder="Example: Hamilton, Ontario, Canada" />
                            @error('location')
                                <p class="text-danger fs-6 mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row form-center">
                        <div class="form-group col-md-3">
                            <label>Add a Description: </label>
                            <textarea name="description" class="form-control" placeholder="Add a description here..."></textarea>
                        </div>
                    </div>
                    <div class="form-row form-center">
                        <div class="form-group col-md-3">
                            <label for="tags">Add Tags: </label>
                            <input type="text" class="form-control" name="tags" placeholder="Example: #pets#cats#kitty" />
                            @error('tags')
                                <p class="text-danger fs-6 mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row form-center">
                        <div class="form-group col-md-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-success btn-lg">POST!</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <Mainnavbar></Mainnavbar>
            <!-- oops you're not logged in please login here! -->
            @endauth
        </div>
        @vite('resources/js/app.js')
    </body>
</html>