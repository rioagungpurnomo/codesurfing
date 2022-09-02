<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CodeSurfing</title>
    <link rel="shortcut icon" href="https://codesurfing.herokuapp.com/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://codesurfing.herokuapp.com/assets/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="https://codesurfing.herokuapp.com/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://codesurfing.herokuapp.com/assets/css/codesurfing.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand mb-0" href="#"><img src="https://codesurfing.herokuapp.com/assets/images/codesurfing.png" class="logo me-1" alt="Codesurfing"><span class="text-codeigniter">Code</span><span class="text-codesurfing fw-semibold">Surfing</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Discuss</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contribute</a></li>
                </ul>
                <div class="d-flex" role="search">
                    <a href="#" class="btn btn-codesurfing me-2 btn-md" type="button">Documentation</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="mb-4 bg-light rounded-3">
        <div class="container py-5">
            <h1 class="display-6 fw-semibold">Welcome to CodeSurfing 1.0.0</h1>
            <p class="fs-5">The small framework with powerful features</p>
        </div>
    </div>

    <div class="mb-4 bg-white rounded-3">
        <div class="container py-5">
            <h3 class="fw-semibold">About this page</h3>
            <p class="fs-6">The page you are looking at is being generated dynamically by CodeSurfing</p>
            <p class="fs-6">If you would like to edit this page you will find it located at:</p>

            <div class="alert alert-light bg-light border text-dark rounded" role="alert">
                application/Views/welcome_message.php
            </div>

            <p class="fs-6">The corresponding controller for this page can be found at:</p>
            <div class="alert alert-light bg-light border text-dark rounded" role="alert">
                application/Controllers/Welcome.php
            </div>
        </div>
    </div>

    <div class="mb-4 bg-light rounded-3">
        <div class="container py-5">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fad fa-books fa-2x text-codesurfing"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5>Documentation</h5>
                    <p class="fs-6">We take security seriously, with built-in protection against CSRF and XSS attacks. Version 4 adds context-sensitive escaping and CSP.</p>
                </div>
            </div>
            <div class="d-flex mt-5 mb-5">
                <div class="flex-shrink-0">
                    <i class="fad fa-comments fa-2x text-codesurfing"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5>Discuss</h5>
                    <p class="fs-6">We take security seriously, with built-in protection against CSRF and XSS attacks. Version 4 adds context-sensitive escaping and CSP.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer" style="margin-top: -20px; margin-bottom: 0; padding-bottom: 0;">
        <div class="bg-codesurfing py-5">
            <div class="container text-center text-white">
                <p class="lead">
                    <?= CS_LOADPAGE; ?>
                </p>
                <p class="lead">Environment : <?= CS_ENVIRONMENT; ?></p>
            </div>
        </div>
        <div class="bg-dark text-center">
            <div class="container">
                <p class="text-light fs-6 py-3">© <?= date('Y'); ?> CodeSurfing Foundation. CodeSurfing is open source project released under the MIT open source licence.</p>
            </div>
        </div>
    </footer>

    <script src="https://codesurfing.herokuapp.com/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>