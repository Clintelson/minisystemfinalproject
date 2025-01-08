<?php

session_start();

include('../database/database.php');

if (!isset($_GET['id'])) {
    die('ID not provided.');
}

$id = $_GET['id'];

$query = "SELECT * FROM information WHERE id =?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if (isset($_POST['send'])) {
    
    $first = $_POST['first'];
    $middle = $_POST['Middle'];
    $last = $_POST['Last'];
    $age = $_POST['Age'];
    $sex = $_POST['Sex'];
    $birth = $_POST['Birth'];
    $blood = $_POST['Blood'];
    $religion = $_POST['Religion'];
    $year = $_POST['Year'];
    $idNumber = $_POST['ID'];
    $email = $_POST['Email'];

    $sendUpdate = "UPDATE information SET FirstName = ?, MiddleName = ?, LastName = ?, Age = ?, Sex = ?, Birthdate = ?, Religion = ?, yearLevel = ?, idNumber = ?, email = ?, bloodType = ? WHERE id = ?";

    $stmt = $conn->prepare($sendUpdate);
    $stmt->bind_param("sssisssiissi", $first, $middle, $last, $age, $sex, $birth, $religion, $year, $idNumber, $email, $blood, $id);

    if ($stmt->execute()) {
        echo 
        "
        <script>
        alert('Record Updated Successfully');
        window.location.href='index.php';
        </script>
        ";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Update</title>
</head>

<style>
input,
select {
    width: 100%;
    height: 40px;
    outline: none;
    border: solid 1px;
    border-radius: 12px;
    padding: 7px 16px 7px 16px;
}
</style>

<body
    class="relative w-screen h-dvh flex flex-col gap-10 justify-center items-center bg-gray-400 font-mono pt-10 md:pt-0">

    <h1 class="text-[clamp(2rem,5vw,3rem)]">UPDATE RECORD</h1>

    <a href="index.php"
        class="absolute top-10 right-10 h-10 w-fit bg-orange-400 px-2 rounded-lg hover:bg-transparent hover:border hover:border-black transform duration-300 flex items-center">
        CANCEL
    </a>

    <form method="POST" onsubmit="return validateForm()"
        class="grid grid-cols-1 md:grid-cols-3 gap-10 w-full lg:w-2/3 px-10 lg:px-0 overflow-x-hidden pb-10">

        <div class="flex flex-col">
            <label for="first">First Name</label>
            <input id="first" name="first" type="text" value="<?= htmlspecialchars($data['FirstName']) ?>" required>
        </div>

        <div class=" flex flex-col">
            <label for="Middle">Middle Name</label>
            <input id="Middle" name="Middle" type="text" value="<?= htmlspecialchars($data['MiddleName']) ?>" required>
        </div>

        <div class="flex flex-col">
            <label for="Last">Last Name</label>
            <input id="Last" name="Last" type="text" value="<?= htmlspecialchars($data['LastName']) ?>" required>
        </div>

        <div class="flex flex-col">
            <label for="Age">Age</label>
            <input id="Age" name="Age" type="number" value="<?= htmlspecialchars($data['Age']) ?>" required>
        </div>

        <div class="flex flex-col">
            <label for="Sex">Sex</label>
            <select name="Sex" id="Sex" required>
                <option value="Male" <?= $data['Sex'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $data['Sex'] == 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="Birth">Birthdate</label>
            <input id="Birth" name="Birth" type="date" value="<?= htmlspecialchars($data['Birthdate']) ?>" required>
        </div>

        <div class="flex flex-col">
            <label for="Blood">Blood Type</label>
            <input id="Blood" name="Blood" type="text" value="<?= htmlspecialchars($data['bloodType']) ?>" required>
        </div>

        <div class=" flex flex-col">
            <label for="Religion">Religion</label>
            <input id="Religion" name="Religion" type="text" value="<?= htmlspecialchars($data['Religion']) ?>"
                required>
        </div>

        <div class=" flex flex-col">
            <label for="Year">Year Level</label>
            <Select name="Year" id="Year" required>
                <option value="1st Year" <?= $data['yearLevel'] == '1st Year' ? 'selected' : '' ?>>1st Year</option>
                <option value="2nd Year" <?= $data['yearLevel'] == '2nd Year' ? 'selected' : '' ?>>2nd Year</option>
                <option value="3rd Year" <?= $data['yearLevel'] == '3rd Year' ? 'selected' : '' ?>>3rd Year</option>
                <option value="4th Year" <?= $data['yearLevel'] == '4th Year' ? 'selected' : '' ?>>4th Year</option>
                <option value="Irregular" <?= $data['yearLevel'] == 'Irregular' ? 'selected' : '' ?>>Irregular
                </option>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="ID">ID Number</label>
            <input id="ID" name="ID" type="number" value="<?= htmlspecialchars($data['idNumber']) ?>" required>
        </div>

        <div class="flex flex-col">
            <label for="Email">Email</label>
            <input id="Email" name="Email" type="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>

        <div class="flex flex-row gap-5 mt-6">

            <button type="reset"
                class="bg-orange-400 h-10 w-full rounded-lg overflow-hidden whitespace-nowrap hover:bg-transparent hover:border hover:border-black transform duration-300">
                Clear all
            </button>

            <button name="send" type="submit"
                class="bg-orange-400 h-10 w-full rounded-lg overflow-hidden whitespace-nowrap hover:bg-transparent hover:border hover:border-black transform duration-300">
                Update
            </button>

        </div>

    </form>

    <script>
    function validateForm() {
        var fields = document.querySelectorAll('input[required], select[required]');
        for (var i = 0; i < fields.length; i++) {
            if (fields[i].value.trim() === "") {
                alert("Please fill all required fields.");
                return false;
            }
        }
        return true;
    }
    </script>

</body>

</html>