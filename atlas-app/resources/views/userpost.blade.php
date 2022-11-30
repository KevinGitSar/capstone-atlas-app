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
                @if(auth()->user()->username == $username)
                    <Usernavbar1 :user="{{ Auth::user() }}"></Usernavbar1>
                    <div class="atlas-content-container">
                        <div class="d-flex justify-content-between">
                            <div class="center-btn">
                                <button onclick="location.href='/userpost/{{$previousPost->username}}/post/{{$previousPost->id}}'">Previous</button>
                            </div>
                            <div class="single-post">
                                <div class="text-center">
                                    <h3>{{$post->username}}</h3>
                                </div>
                                <div class="d-flex justify-content-between main-box">
                                    <div class="flex-fill text-center left-box">
                                        <div>
                                            <div class="dropdown">
                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                <ul class="dropdown-menu atlas-menu-container">
                                                    <li>
                                                        <form action="/post/delete/{{$post->id}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <a href="javascript:;" class="dropdown-item atlas-menu-item m-0" onclick="parentNode.submit()">Delete</a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            <img class="single-post-image" src="{{url('storage/'.$post->image)}}" alt="{{$post->image}}">
                                        </div>
                                    </div>
                                    <div class="right-box">
                                        <div class="post-section">
                                            <p>{{$post->description}}</p>
                                            <p>{{$post->location}}</p>
                                            <p>{{$post->tags}}</p>
                                        </div>
                                        <div class="comment-section">
                                            <div id="show-comments" class="overflow-auto">
                                                @if(isset($comments))
                                                    @foreach ($comments as $comment)
                                                        @if($comment->userUsername == auth()->user()->username)
                                                        <div class="card">
                                                            <div class="dropdown">
                                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                                <ul class="dropdown-menu atlas-menu-container">
                                                                    <li>
                                                                        <form action="/comment/delete/{{$comment->id}}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            <a href="javascript:;" class="dropdown-item atlas-menu-item m-0" onclick="parentNode.submit()">Delete</a>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>{{$comment->userUsername}}</strong></p>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="card">
                                                            <div class="dropdown">
                                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                                <ul class="dropdown-menu atlas-menu-container">
                                                                    <li>
                                                                        <a href="/report/{{$comment->userUsername}}" class="dropdown-item atlas-menu-item m-0">Report</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>{{$comment->userUsername}}</strong></p>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div>
                                                <form id="add-comment">
                                                    <input type="hidden" name="userUsername" value="{{$username}}"/>
                                                    <input type="hidden" name="post" value="{{$post->image}}"/>
                                                    <input type="text" id="comment-input" name="comment" minlength="1" maxlength="50"/>
                                                    <button id="comment-btn" type="submit">Add Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="center-btn">
                                <button onclick="location.href='/userpost/{{$nextPost->username}}/post/{{$nextPost->id}}'">Next</button>
                            </div>
                        </div>
                    </div>
                    @else
                    <Usernavbar1 :user="{{ Auth::user() }}"></Usernavbar1>
                    <div class="atlas-content-container">
                        <div class="d-flex justify-content-between">
                            <div class="center-btn">
                                <button onclick="location.href='/userpost/{{$previousPost->username}}/post/{{$previousPost->id}}'">Previous</button>
                            </div>
                            <div class="single-post">
                                <div class="text-center">
                                    <h3>{{$post->username}}</h3>
                                </div>
                                <div class="d-flex justify-content-between main-box">
                                    <div class="flex-fill text-center left-box">
                                        <div>
                                            <div class="dropdown">
                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                <ul class="dropdown-menu atlas-menu-container">
                                                    <li>
                                                        <a href="/report/{{$post->username}}" class="dropdown-item atlas-menu-item m-0">Report</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <img class="single-post-image" src="{{url('storage/'.$post->image)}}" alt="{{$post->image}}">
                                        </div>
                                    </div>
                                    <div class="right-box">
                                        <div class="post-section">
                                            <p>{{$post->description}}</p>
                                            <p>{{$post->location}}</p>
                                            <p>{{$post->tags}}</p>
                                        </div>
                                        <div class="comment-section">
                                            <div id="show-comments" class="overflow-auto">
                                                @if(isset($comments))
                                                    @foreach ($comments as $comment)
                                                    @if($comment->userUsername == auth()->user()->username)
                                                        <div class="card">
                                                            <div class="dropdown">
                                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                                <ul class="dropdown-menu atlas-menu-container">
                                                                    <li>
                                                                        <form action="/comment/delete/{{$comment->id}}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            <a href="javascript:;" class="dropdown-item atlas-menu-item m-0" onclick="parentNode.submit()">Delete</a>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>{{$comment->userUsername}}</strong></p>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="card">
                                                            <div class="dropdown">
                                                                <button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button>
                                                                <ul class="dropdown-menu atlas-menu-container">
                                                                    <li>
                                                                        <a href="/report/{{$comment->userUsername}}" class="dropdown-item atlas-menu-item m-0">Report</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body">
                                                                <p><strong>{{$comment->userUsername}}</strong></p>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div>
                                                <form id="add-comment">
                                                    <input type="hidden" name="userUsername" value="{{auth()->user()->username}}"/>
                                                    <input type="hidden" name="post" value="{{$post->image}}"/>
                                                    <input type="text" id="comment-input" name="comment" minlength="1" maxlength="50"/>
                                                    <button id="comment-btn" type="submit">Add Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="center-btn">
                                <button onclick="location.href='/userpost/{{$nextPost->username}}/post/{{$nextPost->id}}'">Next</button>
                            </div>
                        </div>
                    </div>
                    @endif
            @else
            <Mainnavbar></Mainnavbar>
                <div class="atlas-content-container">
                    <div class="d-flex justify-content-between">
                        <div class="center-btn">
                            <button onclick="location.href='/userpost/{{$previousPost->username}}/post/{{$previousPost->id}}'">Previous</button>
                        </div>
                        <div class="single-post">
                            <div class="text-center">
                                <h3>{{$post->username}}</h3>
                            </div>
                            <div class="d-flex justify-content-between main-box">
                                <div class="flex-fill text-center left-box">
                                    <div>
                                        <img class="single-post-image" src="{{url('storage/'.$post->image)}}" alt="{{$post->image}}">
                                    </div>
                                </div>
                                <div class="right-box">
                                    <div class="post-section">
                                        <p>{{$post->description}}</p>
                                        <p>{{$post->location}}</p>
                                        <p>{{$post->tags}}</p>
                                    </div>
                                    <div class="comment-section">
                                        <div id="show-comments" class="overflow-auto">
                                            @if(isset($comments))
                                                @foreach ($comments as $comment)
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p><strong>{{$comment->userUsername}}</strong></p>
                                                            <p>{{$comment->comment}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="center-btn">
                            <button onclick="location.href='/userpost/{{$nextPost->username}}/post/{{$nextPost->id}}'">Next</button>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        @vite('resources/js/app.js')
    </body>
</html>