<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Hello</h4>

    <form action="./index.php" method="post">
    <select name="product">
        <option>Product...</option>
        <?php foreach ($products as $product) {
            {echo "<option value='{$product->getProductId()}'> {$product->getProductName()} </option>";}}?>
    </select>


        <select name="customer">
            <option>Customer...</option>
            <?php foreach ($customers as $customer) {
                {echo "<option value='{$customer->getId()}'> {$customer->getName()} </option>";}}?>
        </select>
        <input type="submit">
    </form>

    <h2> <?php if ($finalPrice) {echo $finalPrice;} ?></h2>
</section>
<?php require 'includes/footer.php'?>