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
            font-family: 'Roboto', sans-serif;
            background: rgba(3, 9, 13, 1);
        }
        p {
            color: rgba(234, 223, 215, 1);
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
        .top-nav {
            display: block;
            min-height: 80px;
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
            margin-left: 30px;
        }
        .top-nav ul li a {
            font-size: 1.2em;
            line-height: 1.2em;

        }
        .button {
            font-size: 1.2em;
            width: 140px;
            height: 50px;
            margin-left: 30px;
            padding: 5px 25px 5px 25px;
            cursor: pointer;
        }
        .button-login {
            background: transparent;
            border: 3px rgba(39, 125, 161, 1) solid;
            border-radius: 0.325em;
            color: rgba(112, 112, 120, 1);
            overflow: hidden;
	        transition: all 0.4s cubic-bezier(0.1, 0, 0.3, 1);
        }
        #section-landing {
            background: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
        }
        div.background-blend {
            background: rgb(3,9,13);
            background: linear-gradient(0deg, rgba(3,9,13,1) 0%, rgba(3,9,13,0.2) 50%, rgba(3,9,13,1) 100%);
            height: 100%;
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