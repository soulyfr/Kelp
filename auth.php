<?php 
session_start();

include 'db.php';

$user = $_POST['username'];
$password = $_POST['password'];
$action = $_POST['action'];

if($action === 'signup') {
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashedPass')";
    
    if (mysqli_query($connection, $sql)) {
       
        $user_id = mysqli_insert_id($connection);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user;

        header('Location: index.php?login=true');
        exit();
    } else {
        $_SESSION['error'] = "REGISTRATION FAILED, PLEASE TRY AGAIN";
        header('Location: index.php');
        exit();
    }
}

if($action === 'login') {

    $stmt = $connection->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashedPass);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashedPass)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user;
        header("Location: index.php?login=true");
        exit();
    } else {
        $_SESSION['error'] = "INVALID USERNAME OR PASSWORD";
        header("Location: index.php?");
        exit();
    }
}

?>