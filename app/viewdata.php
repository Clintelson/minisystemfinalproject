<?php

include('database/database.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM information";

if (!empty($search)) {
  $query .= " WHERE firstName LIKE '%$search%' 
                OR middleName LIKE '%$search%' 
                OR lastName LIKE '%$search%' 
                OR age LIKE '%$search%' 
                OR sex LIKE '%$search%' 
                OR birthdate LIKE '%$search%' 
                OR bloodType LIKE '%$search%' 
                OR religion LIKE '%$search%' 
                OR yearLevel LIKE '%$search%' 
                OR idNumber LIKE '%$search%' 
                OR email LIKE '%$search%'";
}

$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>viewdata</title>

    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        text-align: center;
        margin-top: 20px;
    }

    td,
    th {
        border: 1px solid rgb(185, 185, 185);
        border-left: none;
        border-right: none;
        padding: 15px;
    }
    </style>
</head>

<body class="w-screen h-dvh bg-gray-400 p-10 font-mono flex flex-col gap-5">

    <div class="w-full flex flex-row justify-between items-center relative">

        <form method="GET" action=""
            class="bg-white flex flex-row w-fit px-3 py-1 border border-1 border-black rounded-3xl">
            <input type="text" name="search" class="bg-transparent outline-none"
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="w-10 px-2 py-1 border-l-2 flex justify-center items-center">
                <img src="../public/img/search.svg" alt="search">
            </button>
        </form>

        <h1 class="text-[clamp(2rem,5vw,3rem)] absolute left-1/2 -top-5">DATA</h1>

        <a href="index.php"
            class="h-10 w-fit bg-orange-400 px-2 rounded-lg hover:bg-transparent hover:border hover:border-black transform duration-300 flex items-center">
            Back
        </a>

    </div>

    <table>
        <tr>
            <th>Count</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Birthdate</th>
            <th>Blood Type</th>
            <th>Religion</th>
            <th>Year Level</th>
            <th>ID Number</th>
            <th>Email</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                $count = 1; 
                while ($items = $result->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $items["firstName"]; ?></td>
            <td><?php echo $items["middleName"]; ?></td>
            <td><?php echo $items["lastName"]; ?></td>
            <td><?php echo $items["Age"]; ?></td>
            <td><?php echo $items["sex"]; ?></td>
            <td><?php echo $items["birthdate"]; ?></td>
            <td><?php echo $items["bloodType"]; ?></td>
            <td><?php echo $items["religion"]; ?></td>
            <td><?php echo $items["yearLevel"]; ?></td>
            <td><?php echo $items["idNumber"]; ?></td>
            <td><?php echo $items["email"]; ?></td>
        </tr>
        <?php
                  }
              } else {
                  echo "<tr><td colspan='12'>No data found</td></tr>";
              }

              $conn->close();
            ?>
    </table>

</body>

</html>