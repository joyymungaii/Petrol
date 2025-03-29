<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";      // Default for XAMPP
$dbname = "mabu";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data for a specific fuel type
function getFuelData($conn, $tableName) {
    $sql = "SELECT SUM(fuel_sold) AS total_liters, SUM(amount_expected) AS total_amount 
            FROM $tableName 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    return [
        'total_liters' => $row['total_liters'] ?? 0,
        'total_amount' => $row['total_amount'] ?? 0
    ];
}

// Fetch data for each fuel type
$petrol = getFuelData($conn, "petrol");
$kerosene = getFuelData($conn, "kerosene");
$diesel = getFuelData($conn, "diesel");

// Calculate grand total
$total_liters = $petrol['total_liters'] + $kerosene['total_liters'] + $diesel['total_liters'];
$total_amount = $petrol['total_amount'] + $kerosene['total_amount'] + $diesel['total_amount'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background-color: #98d8c8;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            color: white;
            font-size: 24px;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            text-align: center;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .card {
            width: 48%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .card h2 {
            color: #333;
            font-size: 20px;
        }

        .card p {
            color: #666;
            font-size: 18px;
            margin-top: 10px;
        }

        .total-card {
            width: 100%;
            background: #7ac9b7;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mabu Logistics</h1>
        <div class="navbar-links">
            <a href="home.php">Home</a>
            <a href="kerosene.php">Kerosene</a>
            <a href="petrol.php">Petrol</a>
            <a href="diesel.php">Diesel</a>
            <a href="login.php">Logout</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2>Dashboard - Last 7 Days Sales</h2>
        <div class="dashboard">
            <div class="card">
                <h2>Petrol</h2>
                <p>Liters Sold: <?php echo number_format($petrol['total_liters'], 2); ?> L</p>
                <p>Total Earnings: Ksh <?php echo number_format($petrol['total_amount'], 2); ?></p>
            </div>

            <div class="card">
                <h2>Kerosene</h2>
                <p>Liters Sold: <?php echo number_format($kerosene['total_liters'], 2); ?> L</p>
                <p>Total Earnings: Ksh <?php echo number_format($kerosene['total_amount'], 2); ?></p>
            </div>

            <div class="card">
                <h2>Diesel</h2>
                <p>Liters Sold: <?php echo number_format($diesel['total_liters'], 2); ?> L</p>
                <p>Total Earnings: Ksh <?php echo number_format($diesel['total_amount'], 2); ?></p>
            </div>

            <div class="total-card">
                <p>Total Liters Sold: <?php echo number_format($total_liters, 2); ?> L</p>
                <p>Total Revenue: Ksh <?php echo number_format($total_amount, 2); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
