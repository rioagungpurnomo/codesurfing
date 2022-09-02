<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - File Not Found</title>
    <link rel="shortcut icon" href="https://codesurfing.herokuapp.com/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://codesurfing.herokuapp.com/assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container justify-content-center align-content-center">
        <div class="card mt-5 bg-white shadow-sm">
            <div class="card-body text-center bg-white">
                <h1 class="card-title pt-5">404 - File Not Found</h1>
                <p class="card-text pb-5">Can't find a route for '<strong><?= trim($_GET['url']); ?></strong>'.</p>
            </div>
        </div>
    </div>

    <script src="https://codesurfing.herokuapp.com/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>