<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<header>
    <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "apyrankes";
    
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    ?>
    <h1>Visi užsakymai</h1>
</header>
<body>

    <p><b>Paieška</b></p>
    <form action="" method="post" class="formClass">
        <input type="text" name="Ieskoti" placeholder="Ieškoti">
        <input type="submit" value="Ieškoti">
    </form>

    <?php

        if(isset($_POST['Ieskoti'])){
            $var= $_POST['Ieskoti'];
            $sql = "SELECT * FROM uzsakymai WHERE ID LIKE '%$var%' OR Tipas  LIKE '%$var%' OR Spalva  LIKE '%$var%' OR 
            Medziaga  LIKE '%$var%' OR Sagtis  LIKE '%$var%' OR Dydis  LIKE '%$var%' OR Email  LIKE '%$var%' OR TelNr  LIKE '%$var%' 
            OR Vardas  LIKE '%$var%' OR Pavarde  LIKE '%$var%' OR Kaina  LIKE '%$var%' ORDER BY ID";    
            $result = $conn->query($sql);
        } else {
            $sql = "SELECT * FROM uzsakymai ORDER BY ID";    
            $result = $conn->query($sql);
        }

        echo "<table>";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Tipas</td>";
        echo "<td>Spalva</td>";
        echo "<td>Medžiaga</td>";
        echo "<td>Sagtis</td>";
        echo "<td>Dydis</td>";
        echo "<td>El. Paštas</td>";
        echo "<td>Tel. Nr.</td>";
        echo "<td>Vardas</td>";
        echo "<td>Pavardė</td>";
        echo "<td>Kaina</td>";
        echo "</tr>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["ID"]."</td>";
                echo "<td>".$row["Tipas"]."</td>";
                echo "<td>".$row["Spalva"]."</td>";
                echo "<td>".$row["Medziaga"]."</td>";
                echo "<td>".$row["Sagtis"]."</td>";
                echo "<td>".$row["Dydis"]."</td>";
                echo "<td>".$row["Email"]."</td>";
                echo "<td>".$row["TelNr"]."</td>";
                echo "<td>".$row["Vardas"]."</td>";
                echo "<td>".$row["Pavarde"]."</td>";
                echo "<td>".$row["Kaina"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        echo "</table>";
    ?>
</body>
