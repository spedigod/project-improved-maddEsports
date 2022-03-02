<nav class="top-nav">
    <ul>
        <?php 
            if (!isset($_SESSION['user_id'])) {
                echo <<<LOGINBTN
                    <li class="btn-login">
                    <a href="home/login">Login</a>
                    </li>
                LOGINBTN;
            } else {
                echo <<<LOGOUTBTN
                    <li class="btn-logout">
                    <a href="home/logout">Logout</a>
                    </li>
                LOGOUTBTN;
            }
        
        ?>
    </ul>
</nav>