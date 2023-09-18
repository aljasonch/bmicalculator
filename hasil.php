<?php
session_start();
function bmi($height, $weight)
{
    if ($height <= 0 || $weight <= 0) {
        return "Invalid input. Height and weight must be positive values.";
    }
    $height = $height / 100;
    $bmi = $weight / ($height * $height);
    $bmi = round($bmi, 2);
    return $bmi;
}
function parameter($bmi)
{
    if ($bmi < 18.5) {
        $parameter = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        $parameter = "Normal";
    } elseif ($bmi >= 25 && $bmi <= 29.9) {
        $parameter = "Overweight";
    } else {
        $parameter = "Obesity";
    }
    return $parameter;
}
if (!isset($_COOKIE['history_cookie'])) {
    setcookie('history_cookie', 1);
    $index = 1;
    $data1 = array(
        "name" => $_POST['name'],
        "age" => $_POST['age'],
        "gender" => $_POST['gender'],
        "height" => $_POST['height'],
        "weight" => $_POST['weight'],
        "bmi" => bmi($_POST['height'], $_POST['weight']),
        "parameter" => parameter(bmi($_POST['height'], $_POST['weight']))
    );
    setcookie("data[$index]", json_encode($data1));
} else {
    setcookie('history_cookie', $_COOKIE['history_cookie'] + 1);
    $index = $_COOKIE['history_cookie'] + 1;
    $data2 = array(
        "name" => $_POST['name'],
        "age" => $_POST['age'],
        "gender" => $_POST['gender'],
        "height" => $_POST['height'],
        "weight" => $_POST['weight'],
        "bmi" => bmi($_POST['height'], $_POST['weight']),
        "parameter" => parameter(bmi($_POST['height'], $_POST['weight']))
    );
    setcookie("data[$index]", json_encode($data2));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    if (empty($name) || empty($age) || empty($gender) || empty($weight) || empty($height)) {
        $error_message = "<div class='alert alert-danger col-8 mx-auto' style='max-width: 500px;'>All fields are required. Please fill all required fields and submit again.</div>";
        $_SESSION['error_message'] = $error_message;
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator | Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            background-color: #333;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #fff;
        }

        .container {
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand bg-dark p-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">BMI Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="history.php">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <h2 class="mt-3">BMI Result</h2>
        <form action="history.php" method="post">
            <?php
            echo "<strong>For the information you entered :</strong> <br />";
            echo "Name : " . $_POST['name'] . "<br>";
            echo "Age : " . $_POST['age'] . "<br>";
            $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
            echo "Gender : " . $_POST['gender'] . "<br />";
            echo "Height : " . $_POST['height'] . "<br />";
            echo "Weight : " . $_POST['weight'] . "<br />";
            $bmi = bmi($_POST['height'], $_POST['weight']);
            echo "<div class='alert alert-primary mt-3'>Your BMI is  " . bmi($_POST['height'], $_POST['weight']) . ", indicating your weight is in the <strong>" . parameter($bmi) . "</strong> category for adults of your height. <br /></div>";
            ?>
            <table class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">BMI</th>
                        <th scope="col">Weight Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Below 18.5</td>
                        <td>Underweight</td>
                    </tr>
                    <tr>
                        <td>18.5 - 24.9</td>
                        <td>Normal</td>
                    </tr>
                    <tr>
                        <td>25.0 - 29.9</td>
                        <td>Overweight</td>
                    </tr>
                    <tr>
                        <td>30.0 and above</td>
                        <td>Obesity</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-2" style="width: 200px;" formaction="index.php">Calculate Again</button>
                <button type="submit" class="btn btn-primary mt-2" style="width: 200px" formaction="history.php">View History</button>
            </div>
        </form>
    </div>
</body>

</html>