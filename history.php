<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI History | Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
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

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-dark th {
            background-color: #333;
            color: #fff;
        }

        .table-success td {
            background-color: #d4edda;
        }

        .table-warning td {
            background-color: #fff3cd;
        }

        .table-danger td {
            background-color: #f8d7da;
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
                        <a class="nav-link text-white" href="index.php">Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 class="mt-4">BMI History</h2>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Height</th>
                <th scope="col">Weight</th>
                <th scope="col">BMI</th>
                <th scope="col">Category</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = $_COOKIE['history_cookie'];
            for ($i = 1; $i <= $index; $i++) {
                $data = json_decode($_COOKIE["data"][$i], associative: true);
                $bmi = $data['bmi'];
                $category = $data['parameter'];

                $tableClass = '';
                if ($category === "Normal") {
                    $tableClass = 'table-success';
                } elseif ($category === "Underweight" || $category === "Overweight") {
                    $tableClass = 'table-warning';
                } elseif ($category === "Obesity") {
                    $tableClass = 'table-danger';
                }

                echo "<tr class='$tableClass'>";
                echo "<td>" . $data['name'] . "</td>";
                echo "<td>" . $data['age'] . "</td>";
                echo "<td>" . (isset($data['gender']) ? $data['gender'] : '') . "</td>";
                echo "<td>" . $data['height'] . "</td>";
                echo "<td>" . $data['weight'] . "</td>";
                echo "<td>" . $data['bmi'] . "</td>";
                echo "<td>" . $data['parameter'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>