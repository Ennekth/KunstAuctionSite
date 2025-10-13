<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if ($password !== $confirm) {
    echo "<script>alert('Passwords do not match!'); history.back();</script>";
    exit;
  }

  
  $hashed = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $fname, $lname, $email, $hashed);

  if ($stmt->execute()) {
    echo "<script>alert('Registration successful!'); window.location='login.html';</script>";
  } else {
    echo "<script>alert('Email already registered!'); history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
