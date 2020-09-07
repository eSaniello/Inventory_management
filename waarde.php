<?php

/**
 * waarde.php
 *
 * @package default
 */


$page_title = 'Voorraadwaarde';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);

$all_stock = find_all('stock');
$all_products = find_all('products');

?>

<!--     *************************     -->


<?php include_once 'layouts/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <!--     *************************     -->
                <span>Voorraadwaarde</span>
                <!--     *************************     -->
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Aantal</th>
                        <th class="text-center">Prijs per item</th>
                        <th class="text-center">Waarde</th>
                    </tr>
                </thead>
                <tbody>
                    <!--     *************************     -->
                    <?php
                    $totaleWaarde = 0;

                    foreach ($all_stock as $stock) : ?>
                        <tr>
                            <td class="text-center">
                                <a href="view_product.php?id=<?php echo (int)$stock['product_id']; ?>">
                                    <?php
                                    foreach ($all_products as $product) {
                                        if ($stock['product_id'] == $product['id']) {
                                            echo $product['name'];
                                        }
                                    }
                                    ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?php echo remove_junk(ucfirst($stock['quantity'])); ?>
                            </td>
                            <td class="text-center">
                                <?php
                                foreach ($all_products as $product) {
                                    if ($stock['product_id'] == $product['id']) {
                                        echo "SRD " . $product['buy_price'];
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                foreach ($all_products as $product) {
                                    if ($stock['product_id'] == $product['id']) {
                                        $total = $product['buy_price'] * $stock['quantity'];
                                        $totaleWaarde += $total;
                                        echo "SRD " . $total;
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!--     *************************     -->
                </tbody>
            </table>
            <b>TOTALE VOORRAAD WAARDE: SRD <?php echo $totaleWaarde; ?></b>
        </div>
    </div>

    <?php
    /**
     * print "<pre>";
     * print_r($all_stock);
     * print "</pre>\n";
     *
     */
    ?>


</div>
</div>
</div>
<?php include_once 'layouts/footer.php'; ?>