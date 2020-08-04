<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Hello</h4>

    <form action="" method="post">
    <select>
        <?php foreach ($products as $product) {
            {echo "<option value='{$product->getProductId()}'> {$product->getProductName()} </option>";}}?>
    </select>


        <select>
            <?php foreach ($customers as $customer) {
                {echo "<option value='{$customer->getId()}'> {$customer->getName()} </option>";}}?>
        </select>
        <input type="submit">
    </form>
</section>
<?php require 'includes/footer.php'?>;