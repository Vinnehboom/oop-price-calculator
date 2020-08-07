<table>
    <tr>
        <th>Product</th>
        <th colspan="2">Initial Price</th>
        <th>New Price</th>
    </tr>
    <tr>
        <td><?php echo $productName ?></td>
        <td colspan="2"><?php echo $productPrice ?></td>
        <td>N/A</td>
    </tr>
    <tr>
        <th>Customer</th>
        <th>Fixed Discount</th>
        <th>Variable Discount</th>
        <td></td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['currentUser']->getName() ?></td>
        <td><?php echo $_SESSION['currentUser']->getFixedDisc() ?></td>
        <td><?php echo $_SESSION['currentUser']->getVariableDisc() . "%" ?></td>
        <td>
            <?php if($_SESSION['currentUser']->getFixedDisc()){
                echo $productPrice - $_SESSION['currentUser']->getFixedDisc();
            } ?></td>
    </tr>
    <tr>
        <th>Customer's group(s)</th>
        <th>Fixed Discount</th>
        <th>Variable Discount</th>
        <td></td>
    </tr>
    <?php
    foreach ($groupnames as $index => $value) {
    echo "<tr>";
    echo '<td>' . $value . '</td>';
    echo '<td>' . $fixedDiscounts[$index] . '</td>';
    echo '<td>' . $variableDiscounts[$index] . '%</td>';
    echo '<td></td>';
    echo '<tr>';
    }
    ?>
    <tr>
        <th>Group Discount Result</th>
        <th>Fixed (total)</th>
        <th>Variable (highest)</th>
        <td></td>
    </tr>
    <tr>
        <td>//</td>
        <td><?php echo $bestDiscounts['fixed'] ?></td>
        <td><?php echo $bestDiscounts['variable'] . "% of PRICE - customer fixed" ?></td>
        <td></td>
    </tr>
</table>