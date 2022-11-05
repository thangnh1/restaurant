<?php
session_start();
include('../db/connect.php')
?>
<?php
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = md5($_POST['password']);
    if ($user == '' || $password == '') {
        echo '<p>Please enter full</p>';
    } else {
        $sql_select_admin = mysqli_query($con, "SELECT*FROM tbl_admin WHERE user='$user'AND password='$password' LIMIT 1");
        $count = mysqli_num_rows($sql_select_admin);
        $row_login = mysqli_fetch_array($sql_select_admin);
        if ($count > 0) {
            $_SESSION['login'] = $row_login['admin_name'];
            $_SESSION['admin_id'] = $row_login['admin_id'];
            header('Location: dashboard.php');
        } else {
            echo '<p>Something wrong with your password or username</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>AD Account</title>
</head>

<body>
    <h2 align ="center" >Log in with Admin</h2>
    <div id="id02" class="modal">
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Enter user" class="form-control" required>
            <input type="password" name="password" placeholder="Enter password" class="form-control" required>
            <div class="clearfix">
                <button type="submit" name="login" class="loginbtn">Log In</button>
            </div>
        </form>
    </div>
</body>

</html>