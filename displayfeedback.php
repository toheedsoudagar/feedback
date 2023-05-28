<!DOCTYPE html>
<html>
<head>
  <title>Feedback Form</title>
  <script src="myscript.js"></script>
  <link rel="stylesheet" href="feedback.css">
</head>
<body>
  <div class="feedback-container">
    <h2>Feedback</h2>
    <div id="feedback-list">
      <?php
        // Your PHP code to retrieve and display feedback here
        // Modify the code below based on your database structure and query method
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "feedback";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, email, message FROM feedback";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='feedback-item'>";
                echo "<h3>Name: " . $row['name'] . "</h3>";
                echo "<p>Email: " . $row['email'] . "</p>";
                echo "<p>Message: " . $row['message'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback found.</p>";
        }

        $conn->close();
      ?>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
