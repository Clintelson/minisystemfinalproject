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

if(isset($_POST['Delete'])) {

    $id = $_POST['del'];

    $del = mysqli_query($conn,"DELETE FROM information WHERE ID ='$id'");

    if($del) {
        echo "<script>
        alert ('Success');
        document.location.href='viewdata.php';
        </script>"; 

    } else {
       echo"<script>
        alert ('failed');
        document.location.href ='viewdata.php';
        </script>";         

    }
}

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

<body class="w-screen h-dvh bg-gray-400 p-10 font-mono flex flex-col gap-5 overflow-x-hidden">

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
            <th>Action</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                $count = 1; 
                while ($items = $result->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $items["FirstName"]; ?></td>
            <td><?php echo $items["MiddleName"]; ?></td>
            <td><?php echo $items["LastName"]; ?></td>
            <td><?php echo $items["Age"]; ?></td>
            <td><?php echo $items["Sex"]; ?></td>
            <td><?php echo $items["Birthdate"]; ?></td>
            <td><?php echo $items["bloodType"]; ?></td>
            <td><?php echo $items["Religion"]; ?></td>
            <td><?php echo $items["yearLevel"]; ?></td>
            <td><?php echo $items["idNumber"]; ?></td>
            <td><?php echo $items["email"]; ?></td>
            <td>
                <form action=" " method="POST"
                    class="bg-orange-400 w-13 h-10 rounded-lg px-3 hover:bg-transparent hover:border hover:border-black transform duration-300 flex items-center">
                    <input type="hidden" name="del" value="<?php echo $items["ID"]; ?>">
                    <button type="submit" name="Delete"> Delete </button>
                </form>
            </td>
        </tr>
        <?php
                  }
              } else {
                  echo "<tr><td colspan='13'>No data found</td></tr>";
              }

              $conn->close();
            ?>
    </table>

</body>

</html>