<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Welcome to Amazin' Site!</h4>
    <p><?php echo $message ?></p>
    <form action="index.php" method="post">
        <label for="first-name"></label><input type="text" name="first_name">
        <label for="last-name"></label><input type="text" name="last_name">
        <input type="submit" value="Log In">
    </form>
</section>
<?php require 'includes/footer.php'?>;