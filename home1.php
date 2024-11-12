<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
        <link rel="website icon" type="png" href="IMG/images.png">

    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: url('IMG/empty-airplane-indoors-seating-nobody.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }

    .container {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        color: #000000;
        margin: 0px 0;
        text-align: center;
        padding:10px;
        border-radius:10px;
    }

    .ticket {
        background: #ffffff69;
        backdrop-filter: blur(10px);
        border: 1px solid #ddd;
        border-radius: 80px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 50%;
        margin: 10px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ticket h2 {
        margin-top: auto;
        margin-bottom: auto;
        padding: 0;
        font-size: 30px;
        color: darkviolet;
    }

    .ticket p {
        margin:  5px;
        padding: 0;
        font-size: 22px;
        color: black;
    }

  .back-link {
        margin-top: 20px;
        padding: 9px 60px;
        background-color: blueviolet;
        color: #fff;
        border-radius: 30px 10px;
        transition: background-color 0.3s ease;
        font-size: 25px;
        font-family:"Eras Light ITC";
        cursor: pointer;
    }

    .back-link:hover {
        background-color: #00b7ff;
    }
    </style>
</head>
<body>
<div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $depart_port = $_POST["depart_port"];
        $arrivée_port = $_POST["arrivée_port"];

        $host = "localhost";
        $dbname = "gestion_vol";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            die("Connection error: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM voyages_table WHERE depart_port LIKE ? AND arrivée_port LIKE ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ss", $depart_port, $arrivée_port);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);


        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Voici les voyages disponibles</h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='ticket'>";
                echo "<h2>Voyage ID: " . htmlspecialchars($row["voyage_id"]) . "</h2>";
                echo "<p>Du : " . htmlspecialchars($row["depart_port"]) . "</p>";
                echo "<p>Vers : " . htmlspecialchars($row["arrivée_port"]) . "</p>";
                echo "<p>Le : " . htmlspecialchars($row["date_départ"]) . "</p>";
                echo "<p>A : " . htmlspecialchars($row["Heure_départ"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<h1>Aucun voyage trouvé.</h1>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    ?>
    <a class="back-link" href="home.html">Retour</a>
</div>
</body>
</html>

