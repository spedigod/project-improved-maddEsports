<nav class="top-nav">
    <ul>
        <li>
            <a href="../pages/index">Home</a>
        </li>
        <li>
            <a href="../pages/about">About</a>
        </li>
        <li>
            <a href="../pages/projects">Projects</a>
        </li>
        <li>
            <a href="../pages/blog">Blog</a>
        </li>
        <li>
            <a href="../pages/contact">Contact</a>
        </li>
        
        <?php 
            if (!isset($_SESSION['user_id'])) {
                echo <<<LOGINBTN
                    <a href="home/login">
                        <button class="button button-login">
                            <div class="button__bg">
                                <span>Login</span>
                            </div>
                        </button>
                    </a>
                LOGINBTN;
            } else {
                echo <<<LOGOUTBTN
                    <a href="home/logout">
                        <button class="button button-login">
                            <div class="button__bg">
                                <span>Logout</span>
                            </div>
                        </button>
                    </a>
                LOGOUTBTN;
            }
        
        ?>
    </ul>
</nav>