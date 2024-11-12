<?php

$full_name = $_POST["full_name"];
$email = $_POST["email"];
$Message = $_POST["Message"];




$host = "localhost";
$dbname = "gestion_vol";
$username = "root";
$password ="";

$conn= mysqli_connect(hostname: $host,
              username: $username,
              password: $password,
              database: $dbname);

if(mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_error());
}

$sql ="INSERT INTO contact_table (full_name,email, Message)
       VALUES (?,?,?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $Message);

if (mysqli_stmt_execute($stmt)) {
    $message = "Message sent!.";
 } else {
    $message = "Error sending message: " . mysqli_error($conn);
    }

?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Submission Result</title>
                <style>

                     body {
                        font-family: Arial, sans-serif;
                         margin: 50px;
                         background: url('IMG/empty-airplane-indoors-seating-nobody.jpg') no-repeat center center fixed;
                            }
                        .message {
                            background-color: rgba(52, 52, 52, 0.7); /* Semi-transparent background for the form */
                            padding: 40px;
                            color: #fff;
                            font-size: 20px;
                            border-radius: 25px;
                            border-radius: 10px;
                            text-align: center;
                         }
                        .back-link {
                            margin-left: 530px;
                            padding: 20px 50px;
                            border: none;
                            border-radius: 25px;
                            background-color: darkviolet;
                            color: #fff;
                            font-size: 16px;
                            letter-spacing: 1px;
                            cursor: pointer;
                            transition: background-color 0.3s ease;

                        }
                        .back-link:hover {
                            background-color: violet;
                        }
                </style>
        </head>
        <body>

        <div class="message">
            <?php echo $message; ?>

        </div>
        <br><br>
        <a class="back-link" href="contact.html">Retour</a>
    </body>
</html>
