<?php
// include('db.php'); // Include database connection

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $first_name = $_POST['firstName'];
//     $last_name = $_POST['lastName'];
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $contact = $_POST['contact'];
//     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//     // Prepare SQL statement
//     $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, contact, password) VALUES (?, ?, ?, ?, ?, ?)");

//     // Check if the statement was prepared successfully
//     if ($stmt) {
//         $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $contact, $password);

//         if ($stmt->execute()) {
//             echo "Registration successful!";
//         } else {
//             echo "Error executing statement: " . $stmt->error;
//         }

//         $stmt->close();
//     } else {
//         echo "Error preparing statement: " . $conn->error;
//     }


// }
?>
<?php
$host = "localhost";
$dbname = "rhn_edu";
$username = "root";
$password = ""; // Default is blank

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample user input (should come from a form)
$first_name = "John";
$last_name = "Doe";
$username = "johndoe";
$email = "johndoe@example.com";
$contact = "1234567890";
$passwords = "mypassword123"; // Use real user input from a form

// Hash password for security
$hashed_password = password_hash($passwords, PASSWORD_DEFAULT);

// Prepare SQL statement
$sql = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, contact, passwords) VALUES (?, ?, ?, ?, ?, ?)");

if (!$sql) {
    die("SQL prepare failed: " . $conn->error);
}

$sql->bind_param("ssssss", $first_name, $last_name, $username, $email, $contact, $hashed_password);

// Execute and check
if ($sql->execute()) {
    echo "User registered successfully!";
} else {
    if ($conn->errno == 1062) {
        echo "Error: Username or Email already exists!";
    } else {
        echo "Error: " . $sql->error;
    }
}

// Close
$sql->close();
$conn->close();
?>
