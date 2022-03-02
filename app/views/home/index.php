<?php 
    if (!isset($_SESSION['user_id'])) {
        header("location: home/login");
        exit();
    }
?>
<?php require APPROOT . '/views/includes/home/head.php' ?>

<div class="navbar">
    <?php require APPROOT . '/views/includes/home/navigation.php' ?>
</div>
<p>Ez egy paragrafus <a href="">linkkel</a> ellatva</p>
<h1><p>Hello World</p></h1>
<h2><p>Hello World</p></h2>
<h3><p>Hello World</p></h3>
<h4><p>Hello World</p></h4>