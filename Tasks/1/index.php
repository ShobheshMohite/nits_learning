<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">

  <script>

    document.addEventListener("DOMContentLoaded", function () {
      // Set the max value for DOB
      document.getElementById("dob").setAttribute("max", new Date().toISOString().split("T")[0]);
    });

    //for adding cities
    async function loadCities(stateId) {
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
        // console.log(cities);
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

</head>

<body>

  <form action="processLogin.php" method="POST">

    <h2>Customer Login Form</h2>

    <label for="firstname">First Name: </label>
    <input type="text" id="firstname" name="firstname" required />

    <label for="middleName">Middle Name: </label>
    <input type="text" id="middlename" name="middlename" />

    <label for="lastName">Last Name: </label>
    <input type="text" id="lastname" name="lastname" />

    <label for="gender">Gender: </label>
    <div class="gender-group">
      <div>
        <input type="radio" id="male" name="gender" value="male" required />
        <label for="male">Male</label>
      </div>

      <div><input type="radio" id="female" name="gender" value="female" required />
        <label for="female">Female</label>
      </div>

      <div><input type="radio" id="other" name="gender" value="other" required>
        <label for="other">Other</label>
      </div>

    </div>

    <label for="dob">Date Of Birth: </label>
    <input type="date" id="dob" name="dob" required>

    <label for="mobile">Mobile Number: </label>
    <input type="text" id="mobile" name="mobile" maxlength="10" pattern="\d{10}" title="Enter a 10-Digit Mobile Number"
      required>

    <label for="email">Email: </label>
    <input type="email" id="email" name="email" maxlength="100" required>

    <label for="state">State</label>
    <select name="state" id="state" required onchange="loadCities(this.value)">
      <option value="">Select State</option>
      <?php
      //cities from db
      $conn = new mysqli('localhost', 'root', '', 'customer_login');

      $result = $conn->query('SELECT * FROM states');
      while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'> {$row['name']} </option>";
      }
      ?>
    </select>

    <label for="city">City</label>
    <select id="city" name="city" required>
      <option value="">Select City</option>
    </select>

    <button type="submit">Submit</button>

  </form>

</body>

</html>
<?php



?>