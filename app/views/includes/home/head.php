<?php 
    #Check if user is logged in 
    if (!isset($_SESSION['user_id'])) {
        header("location: home/login");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ddd0d37282.js" crossorigin="anonymous"></script>
    <title><?= SITENAME?></title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        html, body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            top: 0;
            bottom: 0;
            font-family: 'Roboto Condensed', sans-serif;
            background: rgba(7, 16, 21, 1);
        }
        p {
            color: rgba(255, 235, 219, 1);
            font-weight: 300;
            font-size: 1em;
            letter-spacing: .1em;
        }
        a {
            color: rgba(112, 112, 120, 1);
            font-weight: 500;
            text-decoration: none;
            transition: 200ms all linear;
            text-transform: capitalize;
        }
        a:hover {
            color: rgba(39, 125, 161, 1);
        }
        h1 {
            font-size: 3em;
        }
        h2 {
            font-size: 2.5em;
        }
        h3 {
            font-size: 2em;
        }
        h4 {
            font-size: 1.5em;
        }
        /* Header navigation */
        nav {
            width: 100%;
            height: fit-content;
            display: flex;
            justify-content: flex-end;
            background-color: rgba(2, 11, 15, 1);
            border-bottom: 2px rgba(1, 1, 1, 1) solid;
        }
        .dropdown-menu {
            position: relative;
            display: inline-block;
            padding: 20px 20px 20px 20px;
        }
        .dropdown-menu img.nav-profile {
            width: 50px;
            height: 50px;
            border-radius: 40%;
            transition: 300ms all ease-in-out;
        }
        .dropdown-menu:hover img.nav-profile {
            opacity: .5;
        }
        .dropdown-menu-content {
            display: none;
            position: absolute;
            background-color: rgba(2, 11, 15, 1);
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
            top: 94px;
        }
        .dropdown-menu-content a {
            color: rgba(255, 235, 219, 1);
            font-size: small;
            letter-spacing: 1.5px;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: 150ms all ease-in-out;
        }
        .dropdown-menu-content a:hover {
            letter-spacing: 5px;
            margin-left: 5%;
        }
        .dropdown-menu:hover .dropdown-menu-content {
            display: block;

        }
        .dropdown-btn {
            margin: 10px;
        }
    </style>
</head>
<body>