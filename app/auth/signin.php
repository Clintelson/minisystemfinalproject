<?php
session_start();

include('../../database/database.php');

if (isset($_SESSION['ID'])) {
    header('location: ../index.php');
} 

if (isset($_POST['login'])) {

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['ID'] = $user['ID'];
   
        header('location: ../index.php');
        exit;
    } else {
        
        $error = "Wrong Credentials";

    }
   
    $stmt->close();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Signin</title>
    <style>
    input {
        outline: none;
        padding: 7px 10px 7px 10px;
        border: solid 2px gray;
        border-radius: 17px;
    }

    .error-message {
        color: red;
        font-size: 14px;
        text-align: center;
    }
    </style>
</head>

<body class="w-screen h-dvh bg-gray-400 flex justify-center items-center font-mono p-10">

    <div class="w-full max-w-96 border p-10 rounded-xl">

        <form method="POST" class="flex flex-col gap-5">

            <div class="flex flex-col">
                <label for="user">Username</label>
                <input id="user" name="user" type="text">
            </div>

            <div class="flex flex-col">
                <label for="pass">Password</label>
                <input id="pass" name="pass" type="password">

                <div class="mt-2 ml-1 w-full flex items-center gap-1 text-right">
                    <input id="show" type="checkbox" onclick="myFunction()"
                        class="w-4 h-4 accent-blue-500 rounded-md border-gray-300 focus:ring focus:ring-blue-300">
                    <label for="show">Show Password</label>
                </div>
            </div>

            <?php if (!empty($error)) : ?>
            <div class="error-message w-full flex items-center justify-center"><?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <button type="submit" name="login"
                class="w-full h-12 bg-[#CC5500] hover:border rounded-3xl py-3 mt-5 hover:bg-transparent">
                Sign in
            </button>

        </form>

    </div>

    <script>
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>


</body>

</html>