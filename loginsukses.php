<!DOCTYPE html>
<html>
<head>
    <title>Login Sukses</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <div class="container2">
        <div class="login-form">
        <?php
            ob_start();
            session_start();
            ob_end_clean();
            if(isset($_SESSION["username"])){
            ?>
            <form method="post" action="log-out.php">
                <div class="input">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <br>
                <?php echo htmlspecialchars($_SESSION["username"]); ?>
                <br>
                <br>
                <button type="submit" class="button-logout">Logout</button>
                </div>
            </form>
            <?php
        }
        else
        {
        header("location:index.php?login_gagal");
        }
        ?>
        </div>
    </div>
    <?php
    // Mendefinisikan variabel dan mengembalikan ke isi kosong
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
        // periksa apakah nama hanya huruf dan spasi
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                    }
                    }
        if (empty($_POST["email"])) {
        $emailErr = "Email is required";
            } else {    
            $email = test_input($_POST["email"]);
            // Periksa format email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                }
                }
        if (empty($_POST["comment"])) {
            $comment = "";
            } else {
                $comment = test_input($_POST["comment"]);
                }
        }
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <br>
    <h2>TUGAS 2 PEMROGRAMAN WEB</h2>
    <p>5230411322 | RIVAN GHIBRAN BAHARUDIN SULISTYA</p>
    <form method="post" action="<?php echo
        htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>BUKU TAMU</h2> 
        Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"><?php echo
        $comment;?></textarea>
            <br><br><br>
    <input type="submit" name="submit" value="Submit">
    <p><span class="error">* required field.</span></p>
    </form >
    <?php

    // memasukan data kedalam data base
    if (($_SERVER["REQUEST_METHOD"] == "POST") && (empty($nameErr) && empty($emailErr))) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $comment = $_POST["comment"];

        // Informasi koneksi database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tugas2";

        // Membuat koneksi ke MySQL
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Menyiapkan statement SQL untuk menghindari error dan SQL Injection
        $stmt = $conn->prepare("INSERT INTO bukutamu (name, email, comment) VALUES (?, ?, ?)");

        // Bind parameter untuk mencegah SQL injection
        $stmt->bind_param("sss", $name, $email, $comment); // "sss" artinya ada tiga string

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
            header("location:loginsukses.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    // Menutup statement dan koneksi
        $stmt->close();
        $conn->close();
        }
        ?>
    
</body>
</html>