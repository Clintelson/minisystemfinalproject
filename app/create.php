<?php
session_start();

if(!isset($_SESSION['ID'])) {
    header('location: auth/signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>create</title>
</head>

<body class="w-screen h-dvh bg-gray-400">

</body>

</html>