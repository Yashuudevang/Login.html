<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (!isset($_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['email'], $_POST['password'], $_POST['number'])) {
        echo "All fields are required.";
        exit;
    }

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];

    //database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (firstname, lastname, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $password, $number);
        $stmt->execute();
        echo "Registration successful...";
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Form not submitted.";
}
?>
