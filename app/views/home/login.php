<?php 
    if (isset($_SESSION['user_id'])) {
        header("location: ../home");
        exit();
    }
?>
<?php require APPROOT . '/views/includes/pages/head.php' ?>

<div class="navbar">
    <?php require APPROOT . '/views/includes/pages/navigation.php' ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="login" method="post">
            <input type="text" name="userName" id="userName" placeholder="username or email">
            <span class="invalidFeedback">
                <?= $data['userNameError'] ?>
            </span>

            <input type="password" name="password" id="password" placeholder="Password">
            <span class="invalidFeedback">
                <?= $data['passwordError'] ?>
            </span>

            <button type="submit" name="loginSubmit" id="loginSubmit" value="Submit">Submit</button>

            <p class="options">Not registered yet? <a href="registration">Create an account</a></p>
        </form>
    </div>
</div>