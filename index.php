<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .container {
            max-width: 600px;
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #343a40;
        }

        .form-group label {
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand bg-dark p-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">BMI Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="history.php">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <h1 class="text-center">BMI Calculator</h1>
        <?php
        if (isset($_SESSION['error_message']) && $_SESSION['error_message'] != "") {
            echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <form id="bmiForm" action="hasil.php" method="post">
            <div class="form-group m-3">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" style="width: 100%;">
            </div>
            <div class="form-group m-3">
                <label for="age">Age</label>
                <input class="form-control" type="number" name="age" id="age" min="0" style="width: 100%;">
            </div>
            <div class="form-group m-3">
                <label>Gender</label><br>
                <input class="form-check-input" type="radio" id="male" name="gender" value="M">
                <label class="form-check-label" for="male">Male</label>
                <input class="form-check-input" type="radio" id="female" name="gender" value="F">
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-group m-3">
                <label for="height">Height (cm)</label>
                <input class="form-control" type="number" name="height" id="height" min="100" max="200" style="width: 100%;">
            </div>
            <div class="form-group m-3">
                <label for="weight">Weight (kg)</label>
                <input class="form-control" type="number" name="weight" id="weight" min="30" max="200" style="width: 100%;">
            </div>
            <div class="form-group text-center m-3">
                <button type="submit" class="btn btn-primary btn-block">Calculate BMI</button>
            </div>
        </form>
    </div>
</body>
</html>