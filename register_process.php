<?php
session_start();
require_once 'db.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        echo "<script>alert('Email already registered');window.location='register.php';</script>";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$hashedPassword,$role);
    if($stmt->execute()){
        echo "<script>alert('Registration successful');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed');window.location='register.php';</script>";
    }
}
?>