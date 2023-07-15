<?php include 'inc/navbar.php';

// if (isset($_SESSION['used_id'])) {
//     header('Location: index.php');
//     exit;
// } 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        setcookie('name', $row['name'], time() + 60 * 60 * 24 * 30);
        setcookie('email', $email, time() + 60 * 60 * 24 * 30);

        $_SESSION['user_id'] = $row['id'];

        if ($row['is_admin']) {
            $_SESSION['is_admin'] = $row['is_admin'];
        }


        header('Location: index.php');
        exit;
    } else {
        echo "User with email $email does not exists.";
    }

    mysqli_close($conn);
}


?>


<div class="auth-container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="auth-form">
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>
</div>