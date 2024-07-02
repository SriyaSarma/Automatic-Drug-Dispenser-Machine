<?php
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];


    //Database connection
    $conn = new mysqli('localhost','root','','website');
    if($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        $stmt = $conn->prepare("insert into signup(Username, Email, Password) values(?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        echo "<script>
alert('Registred successfully');
window.location.href='index.php';
</script>";
        $stmt->close();
        $conn->close();
    }
?>