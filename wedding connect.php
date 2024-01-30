<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $wdate = $_POST['wdate']; 

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'ramsen');
    if ($conn->connect_error) {
        die('Connection failed::::::::::: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO wedding (type, phone, email, wdate) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die('Error in preparing statement: ' . $conn->error);
        }

        $stmt->bind_param("siss", $type, $phone, $email, $wdate); 
        $stmt->execute();

        if ($stmt->error) {
            die('Error in execution: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        echo "<script>alert('Data submitted successfully!'); window.location.href = 'booking.html';</script>";
    }
}
?>
