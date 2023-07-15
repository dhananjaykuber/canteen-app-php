<?php include 'inc/header.php';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "User with email $email already exists.";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $id = mysqli_insert_id($conn);

            $_SESSION['user_id'] = $id;

            echo $_SESSION['user_id'];

            setcookie('name', $name, time() + 60 * 60 * 24 * 30);
            setcookie('email', $email, time() + 60 * 60 * 24 * 30);

            echo 'User created';
        } else {
            echo 'Error occured';
        }
    }

    mysqli_close($conn);
}

?>


<h1>User Signup</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name">
    </div>
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