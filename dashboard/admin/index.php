<?php

require_once 'authentication/admin-class.php';

$admin = new ADMIN();
$admin->isUserLoggedIn();

$stmt = $admin->runQuery("SELECT * FROM user WHERE id = :id");
$stmt->execute(array(":id" => $_SESSION['adminSession']));
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data is fetched successfully
if (!$user_data) {
    echo "<script>alert('User not found!'); window.location.href = '../../';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../src/styles.css">
    </head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user_data['username']); ?></h1>
        <button><a href="authentication/admin-class.php?admin_signout">Sign Out</a></button>
    </div>
    <footer>
    </footer>
</body>
</html>
