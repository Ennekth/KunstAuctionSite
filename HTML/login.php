<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, firstname, password FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
      // Successful login
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['firstname'] = $row['firstname'];
      echo "<script>alert('Login successful!'); window.location='./dashboard.php';</script>";
    } else {
      echo "<script>alert('Invalid password!'); history.back();</script>";
    }
  } else {
    echo "<script>alert('Email not found!'); history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
