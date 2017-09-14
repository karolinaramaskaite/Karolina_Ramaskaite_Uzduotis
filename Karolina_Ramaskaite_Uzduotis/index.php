<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="CSS/styles.css">
    <h1></h1>

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
</head>
<body>
<div class="container">
    <div class="header-container">
        <header>
            <div class="header">
                <h1 class="title">Apyrankės</h1>
                    <nav>
                        <ul>
                            <li><a href="?route=home">Užsakymas</a></li>
                            <li><a href="?route=orders">Admin</a></li>
                        </ul>
                    </nav>
            </div>
        </header>        
    </div>
    <div class="main-container">
        <div class="main">

            <article>
            <?php 
                if(isset($_GET['route'])){
                    switch($_GET['route']){
                        case 'home':
                        include ('Home.php');
                            break;  
                        case 'orders':
                            include ('Orders.php');
                            break;
                        default:
                    }
                } else if (isset($_GET['page'])){
                    include ('Orders.php');
                    break;
                } else{
                            
                //the user is coming for the first time
                    include ('Home.php');
                }
                ?>
              
            </article>
        </div>
    <div class="footer-container">
        <footer>
            <h3><i>Pačios gražiausios apyrankės tik Jums už pačią geriausią kainą!</i></h3>
        </footer>
    </div>
    </div>
</div>
</body>
</html>