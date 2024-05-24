<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['gender']) && !empty($_POST['age']) && !empty($_POST['adhaar_no']) && !empty($_POST['city']) && !empty($_POST['pin_code']) && !empty($_POST['contact_number']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        // Get form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $adhaar_no = $_POST['adhaar_no'];
        $city = $_POST['city'];
        $pin_code = $_POST['pin_code'];
        $contact_number = $_POST['contact_number'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check1 = 1; // Set check1 to 1
        
        // Database connection
        $conn = new mysqli("localhost", "root", "", "vaccination_program_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO citizens (first_name, last_name, gender, age, adhaar_no, city, pin_code, contact_number, username, password, check1) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssissi", $first_name, $last_name, $gender, $age, $adhaar_no, $city, $pin_code, $contact_number, $username, $password, $check1);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: loading3.php");
            exit; 
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
        $conn->close();
    } else {
        // Handle case where required fields are not filled
        header('Location:register1.html');
    }
} else {
    // Handle case where form is not submitted
    echo "Form not submitted.";
}
?>
