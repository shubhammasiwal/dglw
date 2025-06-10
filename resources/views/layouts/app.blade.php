<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>AppLayout</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div class="container-fluid">
            <header>
                <div class="d-flex flex-row align-items-center pb-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <span class="fs-4">{{ env('APP_NAME') }}</span>
                    </a>
                    <nav class="d-inline-flex ms-auto">
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('login') }}">Login</a>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('register') }}">Sign Up</a>
                    </nav>
                </div>
            </header>


            <main>
                @yield('content')
            </main>

            <footer class="pt-4 my-md-5 pt-md-5 border-top">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Left -->
                        <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                            <div class="col-12 col-md-4 text-start mb-3 mb-md-0">
                                <small class="text-muted">&copy; 2017–2021</small>
                            </div>
                        </div>
                        <!-- Center -->
                        <div class="col-12 col-md-5 text-center mb-3 mb-md-0">
                            <h5>Features</h5>
                            <ul class="list-unstyled text-small mb-0">
                                <li><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
                                <li><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
                                <li><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
                            </ul>
                        </div>
                        <!-- Right -->
                        <div class="col-12 col-md-5 text-center mb-3 mb-md-0">
                            <h5>Features</h5>
                            <ul class="list-unstyled text-small mb-0">
                                <li><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
                                <li><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
                                <li><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </body>
</html>
