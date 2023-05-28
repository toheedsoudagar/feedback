<!DOCTYPE html>
<html>
<head>
  <title>Feedback Form</title>
  <link href="feedback.css" rel="stylesheet">
  </head>
<body>
  <div class="form-container">
    <h2>Feedback Form</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="5" required></textarea>

      <div class="terms-container">
        <input type="checkbox" name="accepted_terms" id="accepted_terms">
      <label for="accepted_terms">I accept the terms and conditions</label>

      </div>


      <button type="submit">Send</button>
    </form>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $message = $_POST["message"];
      $acceptedTerms = isset($_POST["accepted_terms"]) ? 1 : 0;

      // Validate form data (you can add more validation as needed)
      $errors = [];
      if (empty($name)) {
        $errors[] = "Name is required.";
      }
      if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
      }
      if (empty($message)) {
        $errors[] = "Message is required.";
      }
      if (!$acceptedTerms) {
        $errors[] = "You must accept the terms and conditions.";
      }

      // If there are no validation errors, save the form submission to the database
      if (empty($errors)) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "feedback";

        // Connect to MySQL
        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Insert form data into the database
        $sql = "INSERT INTO feedback (name, email, message, accepted_terms) VALUES ('$name', '$email', '$message', '$acceptedTerms')";
        if ($conn->query($sql) === TRUE) {
          echo "<p>Your feedback has been submitted successfully.</p>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
      } else {
        // Display validation errors
        foreach ($errors as $error) {
          echo "<p class='error-message'>$error</p>";
        }
        

      }
    }
    ?>
  </div>
</body>
</html>
