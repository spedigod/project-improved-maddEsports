<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <title><?= SITENAME ?></title>
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
            font-family: 'Lato', sans-serif;
        }
        .top-nav {
            display: block;
        }
        .top-nav ul {
            margin: 0;
            padding: 0;
            position: absolute;
            right: 6%;
            top: 2%;
        }
        .top-nav ul li {
            display: inline-block;
            margin-left: 28px;
        }
        .top-nav ul li a {
            color: #ffffff;
            text-decoration: none;
        }
        .top-nav ul li a:hover {
            color: #afafaf;
            transition: 0.15s sease-in;
        }
        #section-landing {
            background: url('../img/banner.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
        }
        .wrapper-landing {
            position: relative;
            text-align: center;
            margin: 0 auto;
            top: 40%;
        }
        .wrapper-landing h1 {
            font-size: 48px;
            color: #ffffff;
            margin: 0;
            font-weight: 100;
        }
        .wrapper-landing h2 {
            font-size: 42px;
            color: #f2f2f2;
            opacity: 0.6;
            margin: 0;
            font-weight: 100;
        }
        .btn-login,
        .btn-logout {
            border: 1px solid #ffffff;
            border-radius: 0.325em;
            padding: 6px 24px;
        }
        .navbar {
            width: 100%;
            height: 70px;
            background-color: #1a1a1a;
            box-shadow: 0px 0px 0px 10px #1a1a1a;
        }
        .container-login {
            width: 100%;
            margin: 0 auto;
            position: relative;
            top: 20%;
        }
        .wrapper-login {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .wrapper-login input {
            width: 200px;
            height: 26px;
            border: 1px solid #cccccc;
            background-color: #f5f5f5;
            font-size: 18px;
            display: block;
            position: relative;
            margin: 20px auto;
            padding-left: 5px;
            border-radius: 0.324em;
        }
        input::placeholder {
            color: #1a1a1a;
            font-size: 14px;
        }
        .wrapper-login h2 {
            font-size: 40px;
            text-transform: uppercase;
        }
        #loginSubmit {
            width: 205px;
            height: 42px;
            border: 1px solid #000000;
            background-color: #000000;
            color: #ffffff;
            font-size: 20px;
            margin: 20px 0px 0px 0px;
            border-radius: 0.324em;
        }
        #loginSubmit:hover {
            border: 1px solid #a1a1a1;
            background-color: #a1a1a1;
            transition: 0.15s ease-in;
        }
        .options a {
            color: #0044ff;
        }
        .options a:hover {
            color: #000000;
            transition: 0.20s ease-in;
            text-decoration: none;
        }
        .invalidFeedback {
            color: #ff0000;
        }
    </style>
</head>
<body>