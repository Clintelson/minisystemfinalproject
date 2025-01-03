<?php
include('database/database.php');

if (isset($_POST['send'])) {
    
    $first = $_POST['first'];
    $middle = $_POST['Middle']; 
    $last = $_POST['Last'];
    $age = $_POST['Age'];
    $sex = $_POST['Sex'] ?? null;
    $birthdate = $_POST['Birth'];
    $blood_type = $_POST['Blood']; 
    $religion = $_POST['Religion'] ; 
    $year_level = $_POST['Year'];
    $id_number = $_POST['ID'];
    $email = $_POST['Email'];

    $stmt = $conn->prepare("INSERT INTO information (FirstName, MiddleName, LastName, Age, Sex, Birthdate, bloodType, Religion,yearLevel, idNumber, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssissssiss", $first, $middle, $last, $age, $sex, $birthdate, $blood_type, $religion, $year_level, $id_number, $email);

    if ($stmt->execute()) {
        echo "
        <script>
           alert('Data submitted successfully!');
        </script>
        ";

        header("Location: " . $_SERVER['PHP_SELF']);
        exit; 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 
    "
    <script>
    Invalid request method.
    </script>
    ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>registration</title>
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
</head>

<body
    class="relative w-screen h-dvh flex flex-col gap-10 justify-center items-center bg-gray-400 font-mono pt-10 md:pt-0">

    <h1 class="text-[clamp(2rem,5vw,3rem)]">Fill up the form</h1>

    <a href="viewdata.php"
        class="absolute top-10 right-10 h-10 w-fit bg-orange-400 px-2 rounded-lg hover:bg-transparent hover:border hover:border-black transform duration-300 flex items-center">
        View Data
    </a>

    <form method="POST" onsubmit="return validateForm()"
        class="grid grid-cols-1 md:grid-cols-3 gap-10 w-full lg:w-2/3 px-10 lg:px-0 overflow-x-hidden pb-10">

        <div class="flex flex-col">
            <label for="first">First Name</label>
            <input id="first" name="first" type="text" required>
        </div>

        <div class="flex flex-col">
            <label for="Middle">Middle Name</label>
            <input id="Middle" name="Middle" type="text" required>
        </div>

        <div class="flex flex-col">
            <label for="Last">Last Name</label>
            <input id="Last" name="Last" type="text" required>
        </div>

        <div class="flex flex-col">
            <label for="Age">Age</label>
            <input id="Age" name="Age" type="number" required>
        </div>

        <div class="flex flex-col">
            <label for="Sex">Sex</label>
            <select name="Sex" id="Sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="Birth">Birthdate</label>
            <input id="Birth" name="Birth" type="date" required>
        </div>

        <div class="flex flex-col">
            <label for="Blood">Blood Type</label>
            <input id="Blood" name="Blood" type="text" required>
        </div>

        <div class="flex flex-col">
            <label for="Religion">Religion</label>
            <input id="Religion" name="Religion" type="text" required>
        </div>

        <div class="flex flex-col">
            <label for="Year">Year Level</label>
            <select name="Year" id="Year" required>
                <option value="First Year" selected>First Year</option>
                <option value="Second Year">Second Year</option>
                <option value="Third Year">Third Year</option>
                <option value="Fourth Year">Fourth Year</option>
                <option value="Irregular">Irregular</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="ID">ID Number</label>
            <input id="ID" name="ID" type="number" required>
        </div>

        <div class="flex flex-col">
            <label for="Email">Email</label>
            <input id="Email" name="Email" type="email" required>
        </div>

        <div class="flex flex-row gap-5 mt-6">

            <button type="reset"
                class="bg-orange-400 h-10 w-full rounded-lg overflow-hidden whitespace-nowrap hover:bg-transparent hover:border hover:border-black transform duration-300">
                Clear all
            </button>

            <button name="send" type="submit"
                class="bg-orange-400 h-10 w-full rounded-lg overflow-hidden whitespace-nowrap hover:bg-transparent hover:border hover:border-black transform duration-300">
                Submit
            </button>

        </div>

    </form>

    <script>
    function validateForm() {
        var fields = document.querySelectorAll('input[required], select[required]');
        for (var i = 0; i < fields.length; i++) {
            if (fields[i].value.trim() === "") {
                alert("Please fill all required fields.");
                return false; // Prevent form submission
            }
        }
        return true; // Allow form submission
    }
    </script>

</body>

</html>