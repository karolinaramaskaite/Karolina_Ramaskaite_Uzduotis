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
            $kaina = 0;

    ?>
    <h1>Sveiki atvykę!</h1>           
    <p class="text">Šiame puslapyje galite užsisakyti savo norimą apyrankę, pasirinkdami
    jos tipą, spalvą, sagties medžiagą, dydį.<br>Norėdami užsisakyti apyrankę, 
    užpildykite žemiau esančią formą.</p>
</header>
<body ng-app="">
 <form action="" method="post">
     <div class="flex-container">
        <div class="flex-item">
            <p class="text"><u>Tipas</u></p>
            <input type="radio" name="tipas" value="Moteriška" > Moteriška (+5 eur) <br>
            <input type="radio" name="tipas" value="Vyriška" > Vyriška (+6 eur)<br> 
        </div>
        <div class="flex-item">
            <p class="text"><u>Medžiaga</u></p>
            <input type="radio" name="medziaga" value="Oda"> Odinė (+10 eur)<br>
            <input type="radio" name="medziaga" value="Netikra Oda" > Netikros odos (+3 eur)<br> 
        </div>
        <div class="flex-item">
            <p class="text"><u>El. paštas</u></p>
            <input type="email" name="email" value="E-mail"><br>
            <br>
    </div>
    </div>
    <div class="flex-container">
        <div class="flex-item">
            <p class="text"><u>Spalva</u></p>
            <input type="radio" name="spalva" value="Raudona" > Raudona (+2 eur)<br>
            <input type="radio" name="spalva" value="Juoda" > Juoda (+3 eur)<br>
            <input type="radio" name="spalva" value="Mėlyna" > Mėlyna (+2 eur)<br>
            <input type="radio" name="spalva" value="Žalia" > Tamsiai žalia (+2 eur)<br>
            <input type="radio" name="spalva" value="Geltona" > Geltona (+2 eur)<br>
            <input type="radio" name="spalva" value="Balta" > Balta (+3 eur)<br>
            <input type="radio" name="spalva" value="Violetinė" > Violetinė (+2 eur)<br>
            <input type="radio" name="spalva" value="Rožinė" > Rožinė (+2 eur)<br>
            <input type="radio" name="spalva" value="Pilka" > Pilka (+3 eur)<br>
        </div> 
        <div class="flex-item">
            <p class="text"><u>Sagties medžiaga</u></p>
            <input type="radio" name="sagtis" value="Geltonas Auksas" > Geltonas auksas (+30 eur)<br>
            <input type="radio" name="sagtis" value="Baltas Auksas" > Baltas auksas (+30 eur)<br>
            <input type="radio" name="sagtis" value="Sidabras" > Sidabras (+5 eur)<br>
            <input type="radio" name="sagtis" value="Geležis" > Geležis (+3 eur)<br>
            <br><p class="text"><u>Dydis (riešo apimtis)</u></p>
            <input type="text" name="dydis" value="20"> cm<br>
        </div>
        <div class="flex-item">
            <p class="text"><u>Tel. nr.</u></p>
            <input type="text" name="telefonas" value="+370"><br>
            <p class="text"><u>Vardas</u></p>
            <input type="text" name="vardas" value="Vardas"><br>
            <p class="text"><u>Pavardė</u></p>
            <input type="text" name="pavarde" value="Pavardė"><br>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item"></div>
        <div class="flex-item"></div>
        <div class="flex-item">
            <input type="submit" value= "Užsisakyti">
        </div>
    </div>
    <br>

    <?php
            // Add new order to the database
            $sql = "SELECT ID FROM uzsakymai ORDER BY ID";    
            $result = $conn->query($sql);
            // ID of the last line
            $lastID = $result->num_rows; 
            // Next ID
            $id = $lastID + 1; 

            $tipas = "";
            $spalva = "";
            $medziaga = "";
            $sagtis = "";
            $dydis = "";

            if(isset($_POST['tipas'], $_POST['spalva'], $_POST['medziaga'], 
            $_POST['sagtis'], $_POST['dydis'], $_POST['email'], $_POST['telefonas'], 
            $_POST['vardas'], $_POST['pavarde'])){
                $spalva = $_POST['spalva'];
                $tipas = $_POST['tipas'];
                $medziaga = $_POST['medziaga'];
                $sagtis = $_POST['sagtis'];
                $dydis = $_POST['dydis'];
                $email = $_POST['email'];
                $telefonas = $_POST['telefonas'];
                $vardas = $_POST['vardas'];
                $pavarde = $_POST['pavarde'];

                if($spalva=="Juoda" || $spalva=="Balta" || $spalva=="Pilka") {
                    $kaina = $kaina + 3;
                } else {
                    $kaina = $kaina + 2;
                }
                if($tipas=="Moteriška") {
                    $kaina = $kaina + 5;
                } else {
                    $kaina = $kaina + 6;
                }
                if($sagtis=="Geltonas Auksas" || $sagtis=="Baltas Auksas") {
                    $kaina = $kaina + 30;
                } else if($sagtis=="Sidabras"){
                    $kaina = $kaina + 5;
                } else {
                    $kaina = $kaina + 3;
                }
                if($medziaga=="Oda") {
                    $kaina = $kaina + 10;
                } else {
                    $kaina = $kaina + 3;
                }
  
                $sql="INSERT INTO uzsakymai VALUES('$id', '$tipas', '$spalva', '$medziaga', '$sagtis', '$dydis', '$kaina', '$email', '$telefonas', '$vardas', '$pavarde')";
                $result = $conn->query($sql);
                
                echo "<p><i>Jūs pasirinkote apyrankę, kurios tipas - ".$tipas.",
                spalva - ".$spalva.", medžiaga - ".$medziaga.", sagtis - ".$sagtis.", 
                dydis - ".$dydis." cm. Tokios apyrankės kaina = ".$kaina." eur</i></p>";
            }
        ?>

</div>
</form>
</body>
</html>