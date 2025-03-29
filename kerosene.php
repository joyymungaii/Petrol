<?php
// Initialize variables
$fuel_sold = "";
$amount_expected = "";

// Check if "calculate" button is clicked
if (isset($_POST['calculate'])) {
  $fuel_start = $_POST['fuel-start'];
  $fuel_end = $_POST['fuel-end'];

  // Ensure valid input
  if ($fuel_start >= $fuel_end) {
    $fuel_sold = $fuel_start - $fuel_end;
    $amount_expected = $fuel_sold * 151.39;
  } else {
    $fuel_sold = "";
    $amount_expected = "";
    echo "<script>alert('Fuel at the end of the day cannot be greater than at the start!');</script>";
  }
}

// Handle form submission
if (isset($_POST['submit'])) {
  $fuel_start = $_POST['fuel-start'];
  $fuel_end = $_POST['fuel-end'];
  $fuel_sold = $_POST['fuel-sold'];
  $amount_expected = $_POST['amount-expected'];

  // Database connection
  $conn = new mysqli("localhost", "root", "", "mabu");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert data into MySQL
  $stmt = $conn->prepare("INSERT INTO kerosene (fuel_start, fuel_end, fuel_sold, amount_expected) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("dddd", $fuel_start, $fuel_end, $fuel_sold, $amount_expected);

  if ($stmt->execute()) {
    echo "<script>alert('Data successfully submitted!');</script>";
  } else {
    echo "<script>alert('Error submitting data.');</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kerosene Management</title>
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

    /* Navbar styling */
    .navbar {
      background-color: #98d8c8;
      padding: 15px 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
      transition: opacity 0.3s;
    }

    .navbar-links a:hover {
      opacity: 0.8;
    }

    /* Container styling */
    .container {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      text-align: center;
      margin-top: 30px;
    }

    .container h2 {
      color: #333;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .container p {
      color: #666;
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .form-container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      padding: 30px;
      margin: 0 auto;
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #555;
      text-align: left;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
    }

    input:focus {
      outline: none;
      border-color: #98d8c8;
      box-shadow: 0 0 0 2px rgba(152, 216, 200, 0.2);
    }

    button {
      background-color: #98d8c8;
      color: #000;
      border: none;
      border-radius: 4px;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
      margin-top: 10px;
    }

    button:hover {
      background-color: #7ac9b7;
    }

    @media (max-width: 600px) {
      .form-container {
        padding: 20px;
      }
    }

    /* Responsive */
    @media (max-width: 600px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar-links {
        margin-top: 10px;
      }

      .navbar-links a {
        display: inline-block;
        margin: 5px 10px 0 0;
      }

      .container {
        padding: 20px;
        margin: 20px;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <a href="home.html">
      <h1>Mabu Logistics</h1>
    </a>

    <div class="navbar-links">
      <a href="home.html">Home</a>
      <a href="kerosene.php">Kerosene</a>
      <a href="petrol.php">Petrol</a>
      <a href="diesel.php">Diesel</a>
      <a href="login.php">Logout</a>
      <a href="dashboard.php">Dashboard</a>
    </div>
  </nav>

  <div class="container">
    <h2>Kerosene Management</h2>
    <p>Price per liter: Ksh 151.39</p>

    <div class="form-container">
      <h1>Fuel Sales Report</h1>
      <form action="kerosene.php" method="post">
        <form action="kerosene.php" method="post">
          <div class="form-group">
            <label for="fuel-start">Fuels at the start of the day</label>
            <input type="number" id="fuel-start" value="<?= htmlspecialchars($fuel_start) ?>" name="fuel-start"
              required>
          </div>

          <div class="form-group">
            <label for="fuel-end">Fuel at the end of the day</label>
            <input type="number" id="fuel-end" value="<?= htmlspecialchars($fuel_end) ?>" name="fuel-end" required>
          </div>

          <div class="form-group">
            <label for="fuel-sold">Amount of fuel sold</label>
            <input type="number" id="fuel-sold" value="<?= htmlspecialchars($fuel_sold) ?>" name="fuel-sold" readonly>
          </div>

          <div class="form-group">
            <label for="amount-expected">Amount expected (Ksh)</label>
            <input type="number" id="amount-expected" value="<?= htmlspecialchars($amount_expected) ?>"
              name="amount-expected" readonly>
          </div>

          <button type="submit" name="calculate">Calculate</button>
          <button type="submit" name="submit">Submit</button>
        </form>
    </div>
  </div>
</body>

</html>