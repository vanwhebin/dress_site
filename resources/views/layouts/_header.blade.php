<header class="pb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Laravel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active ">
                        <a class="nav-link" href="{{ route('help') }}">帮助<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">登录</a>
                    </li>
                    {{--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                           id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown09">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another
                                action</a>
                            <a class="dropdown-item" href="#">Something else
                                here</a>
                        </div>
                    </li>--}}
                </ul>
                <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
</header>
