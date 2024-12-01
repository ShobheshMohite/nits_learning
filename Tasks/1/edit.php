<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "customer_login");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($_POST['edit_id'])) {
    die("Customer not found!");
}

// Check if edit_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];

    // Fetch the customer's details with state and city names
    $edit_sql = "SELECT c.id, c.firstname, c.middlename, c.lastname, c.gender, c.dob, c.mobile, c.email, s.name AS state_name, ct.name AS city_name, c.state_id, c.city_id 
                 FROM customer c
                 JOIN states s ON c.state_id = s.id
                 JOIN cities ct ON c.city_id = ct.id
                 WHERE c.id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("Customer not found!");
    }

    // Fetch all states for the dropdown
    $states_sql = "SELECT id, name FROM states";
    $states_result = $conn->query($states_sql);

    // Fetch all cities for the dropdown
    $cities_sql = "SELECT id, name FROM cities WHERE state_id = ?";
    $cities_stmt = $conn->prepare($cities_sql);
    $cities_stmt->bind_param("i", $user['state_id']);
    $cities_stmt->execute();
    $cities_result = $cities_stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div style="display: flex;
  justify-content: center;">
    <form method="POST" action="update.php" enctype="multipart/form-data">
    <h2 style="text-align:center;">Edit Customer Details</h2>
        <input type="hidden" name="update_id" value="<?php echo htmlspecialchars($user['id']); ?>">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>"
            required>

        <label for="middlename">Middle Name:</label>
        <input type="text" name="middlename" id="middlename"
            value="<?php echo htmlspecialchars($user['middlename']); ?>">

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>"
            required>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>"
            required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>"
            required>

        <label for="state">State:</label>
        <select name="state" id="state" required onchange="fetchCities(this.value);">
            <?php
            if ($states_result->num_rows > 0) {
                while ($state = $states_result->fetch_assoc()) {
                    echo '<option value="' . $state['id'] . '" ' . (($user['state_id'] == $state['id']) ? 'selected' : '') . '>' . htmlspecialchars($state['name']) . '</option>';
                }
            }
            ?>
        </select>

        <label for="city">City:</label>
        <select name="city" id="city" required>
            <?php
            if ($cities_result->num_rows > 0) {
                while ($city = $cities_result->fetch_assoc()) {
                    echo '<option value="' . $city['id'] . '" ' . (($user['city_id'] == $city['id']) ? 'selected' : '') . '>' . htmlspecialchars($city['name']) . '</option>';
                }
            }
            ?>
        </select>

        
        <label for="file">Select File: </label>
        <input type="file" id="fileupload" name="upload">

        <button type="submit"
            style="padding:10px 20px; background-color:#4CAF50; color:white; border:none; border-radius:5px; font-size:16px;">Update</button>
    </form>
    </div>

    <script>
        async function fetchCities(stateId) {
            if (stateId === "") {
                document.getElementById("city").innerHTML = '<option value="">Select City</option>';
                return;
            }

            try {
                const response = await fetch('getCities.php?state_id=' + stateId);
                if (!response.ok) {
                    console.error("Failed to fetch cities:", response.statusText);
                    return;
                }

                const cities = await response.json();

                // Populate the city dropdown
                const cityDropdown = document.getElementById('city');
                cityDropdown.innerHTML = '<option value="">Select City</option>';

                cities.forEach(city => {
                    cityDropdown.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }
    </script>
</body>

</html>