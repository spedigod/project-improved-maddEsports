<nav class="top-nav">
    <div class="dropdown-menu">
        <a class="dropdown-btn" href="home/profile">
            <i class="fas fa-angle-down"></i>
        </a>
        <a href="">
            <img class="nav-profile" src="public\img\profile-picture\profile-picture.id.jpg" alt="profile-picture">
        </a>
        
        <div class="dropdown-menu-content">
            <a href="home/profile">Profile</a>
            <a href="webshop">Webshop</a>
            <a href="home/team">Team</a>
            <a href="home/events">Events</a>
            <?php 
            if (!isset($_SESSION['user_id'])) {
                echo <<<LOGINBTN
                    <a href="home/login">Login</a>
                LOGINBTN;
            } else {
                echo <<<LOGOUTBTN
                    <a href="home/logout">Logout</a>
                LOGOUTBTN;
            }
        
            ?>
        </div>
    </div>
</nav>