@extends('layouts.app')

@section('content')
    {{-- Carousel Start --}}
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active"
                style="background: url('{{ asset('images/banner_102.jpg') }}') center center / cover no-repeat; min-height: 400px;">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Example headline.</h1>
                        <p class="opacity-75">Some representative placeholder content for the first slide of the
                            carousel.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="carousel-item"
                style="background: url('{{ asset('images/banner_102.jpg') }}') center center / cover no-repeat; min-height: 400px;">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Example headline.</h1>
                        <p class="opacity-75">Some representative placeholder content for the first slide of the
                            carousel.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="carousel-item"
                style="background: url('{{ asset('images/banner_102.jpg') }}') center center / cover no-repeat; min-height: 400px;">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Example headline.</h1>
                        <p class="opacity-75">Some representative placeholder content for the first slide of the
                            carousel.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- Carousel End --}}

    {{-- Content Start --}}
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img src="http://dglw.local:8080/images/narendra_modi.png" alt="Profile"
                    class="bd-placeholder-img rounded-circle" width="140" height="140">
                <h2 class="fw-normal">Narendra Modi</h2>
                <p>Prime Minister</p>
                <p>
                    <a class="btn btn-secondary" href="#">View details »</a>
                </p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="http://dglw.local:8080/images/honorable_minister.png" alt="Profile"
                    class="bd-placeholder-img rounded-circle" width="140" height="140">
                <h2 class="fw-normal">Dr. Mansukh Mandaviya</h2>
                <p>Hon'ble Minister</p>
                <p>
                    <a class="btn btn-secondary" href="#">View details »</a>
                </p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="http://dglw.local:8080/images/ministerofstatemole.png" alt="Profile"
                    class="bd-placeholder-img rounded-circle" width="140" height="140">
                <h2 class="fw-normal">Sushri Shobha Karandlaje</h2>
                <p>Hon'ble Minister of State</p>
                <p>
                    <a class="btn btn-secondary" href="#">View details »</a>
                </p>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
        <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Scheme <span class="text-body-secondary">Title</span>
                </h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum magni saepe unde animi sequi
                    soluta odit architecto accusantium voluptatum dignissimos dolores, obcaecati sapiente necessitatibus
                    reiciendis autem laborum vitae consequuntur neque?</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa"
                        dy=".3em">500x500</text>
                </svg>
            </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Scheme <span class="text-body-secondary">Title</span>
                </h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum magni saepe unde animi sequi
                    soluta odit architecto accusantium voluptatum dignissimos dolores, obcaecati sapiente necessitatibus
                    reiciendis autem laborum vitae consequuntur neque?</p>
            </div>
            <div class="col-md-5 order-md-1">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa"
                        dy=".3em">500x500</text>
                </svg>
            </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Scheme <span class="text-body-secondary">Title</span>
                </h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum magni saepe unde animi sequi
                    soluta odit architecto accusantium voluptatum dignissimos dolores, obcaecati sapiente necessitatibus
                    reiciendis autem laborum vitae consequuntur neque?</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa"
                        dy=".3em">500x500</text>
                </svg>
            </div>
        </div>
        <!-- /END THE FEATURETTES -->
    </div>
    {{-- Content End --}}

    {{-- Scripts --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" class="astro-vvvwv3sm"></script>
@endsection
