<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>BloodHealth</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
</head>

<body>

    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">BloodHealth</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none active" href="/">Accueil</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('research')}}">Recherchez</a>
                    <a class="me-3 py-2 text-dark text-decoration-none btn btn-primary text-white" href="{{ route('customer.create')}}">Inscrivez vous</a>
                   
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">Pricing</h1>
                <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with
                    this Bootstrap example. It’s built with default Bootstrap components and utilities with little
                    customization.</p>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="../../assets/brand/bootstrap-logo.svg" alt="" width="24"
                        height="19">
                    <small class="d-block mb-3 text-muted">&copy; 2017–2021</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Cool
                                stuff</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Random
                                feature</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team
                                feature</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Stuff for
                                developers</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                                one</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Last
                                time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource</a>
                        </li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource
                                name</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                                resource</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Final
                                resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team</a>
                        </li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none"
                                href="#">Locations</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Privacy</a>
                        </li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Terms</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


    <!-- Scripts -->
</body>

</html>
