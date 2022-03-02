<?php require APPROOT . '/views/includes/home/head.php' ?>

<div class="navbar">
    <?php require APPROOT . '/views/includes/home/navigation.php' ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="registration" method="post">
            <input type="text" name="userName" id="userName" placeholder="Username">
            <span class="invalidFeedback">
                <?= $data['userNameError'] ?>
            </span>

            <input type="text" name="userEmail" id="userEmail" placeholder="Email">
            <span class="invalidFeedback">
                <?= $data['userEmailError'] ?>
            </span>

            <input type="password" name="password" id="password" placeholder="Password">
            <span class="invalidFeedback">
                <?= $data['passwordError'] ?>
            </span>

            <input type="password" name="passwordCheck" id="passwordCheck" placeholder="Password again">
            <span class="invalidFeedback">
                <?= $data['passwordCheckError'] ?>
            </span>

            <input type="text" name="userFirstName" id="userFirstName" placeholder="Firstname">
            <span class="invalidFeedback">
                <?= $data['userFirstNameError'] ?>
            </span>

            <input type="text" name="userLastName" id="userLastName" placeholder="LastName">
            <span class="invalidFeedback">
                <?= $data['userLastNameError'] ?>
            </span>

            <input type="hidden" name="refferalCode" id="refferalCode" value="<?= null ?>">

            <button type="submit" name="loginSubmit" id="loginSubmit" value="Submit">Submit</button>

            <p class="options">Not registered yet? <a href="registration">Create an account</a></p>
        </form>
    </div>
</div>