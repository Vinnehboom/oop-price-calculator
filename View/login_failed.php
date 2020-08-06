<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Login failed!</h4>
    <p>No user found with name <?= "{$first_name} {$last_name}"?></p>
    <form action="index.php" method="post">
        <input type="submit" value="Please try again">
    </form>
</section>
<?php require 'includes/footer.php'?>;
