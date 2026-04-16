<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";
$db   = getenv("DB_NAME") ?: "testdb";

$conn = @new mysqli($host, $user, $pass, $db);
$message = "";
$result = null;

if ($conn->connect_error) {
    $message = "Database connection failed: " . $conn->connect_error;
} else {
    $createTable = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!$conn->query($createTable)) {
        $message = "Table creation failed: " . $conn->error;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["name"])) {
        $name = trim($_POST["name"]);

        $stmt = $conn->prepare("INSERT INTO users (name) VALUES (?)");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            $message = "Data inserted successfully.";
        } else {
            $message = "Insert failed: " . $stmt->error;
        }

        $stmt->close();
    }

    $result = $conn->query("SELECT id, name, created_at FROM users ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP MySQL Azure App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f8;
        }
        .container {
            max-width: 750px;
            margin: auto;
            background: #fff;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        h2, h3 {
            margin-top: 0;
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            margin-right: 10px;
        }
        button {
            padding: 10px 16px;
            cursor: pointer;
        }
        .message {
            margin: 15px 0;
            color: green;
            font-weight: bold;
        }
        .error {
            margin: 15px 0;
            color: red;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>PHP Form with MySQL</h2>

    <?php if (!empty($message)): ?>
        <div class="<?php echo (stripos($message, 'failed') !== false || stripos($message, 'error') !== false) ? 'error' : 'message'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter your name" required>
        <button type="submit">Submit</button>
    </form>

    <h3>Stored Data</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
        </tr>

        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['created_at']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

<?php
if ($conn && !$conn->connect_error) {
    $conn->close();
    
}
?>
