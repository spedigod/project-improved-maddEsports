<?php
    unset($_SESSION['user_id']);
    header("location: ../home/login");
    exit();
?>