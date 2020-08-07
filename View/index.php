<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>
        Hello
    <?php if(isset($_SESSION["currentUser"])){
        echo $_SESSION["currentUser"]->getName();
    } else {
        echo 'stranger';
    }
    ?>
    </h4>

    <form action="./index.php" method="post">
    <select name="product">
        <option>Product...</option>
        <?php foreach ($products as $product) {
            {echo "<option value='{$product->getProductId()}'> {$product->getProductName()} </option>";}}?>
    </select>

        <?php if(!$_SESSION['loggedIn']): ?>
        <select name="customer">
            <option>Customer...</option>
            <?php foreach ($customers as $customer) {
                {echo "<option value='{$customer->getId()}'> {$customer->getName()} </option>";}}?>
        </select>
        <?php endif; ?>
        <input type="submit">
    </form>
    <h2> <?php if ($finalPrice) {
        include 'includes/table.php';
        echo $finalPrice;
    } ?></h2>
    <h2> <?php if ($finalPrice) {echo $finalPrice;} ?></h2>
    <h3> <?php print_r($familyArray); ?></h3>

    <form action="index.php" method="POST">
        <input type="submit" value="Log out" name="logout">
    </form>
</section>
<?php require 'includes/footer.php'?>