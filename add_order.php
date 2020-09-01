<?php

/**
 * add_order.php
 *
 * @package default
 */


$page_title = 'All orders';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);


?>

<!--     *************************     -->

<?php
if (isset($_POST['add_order'])) {
    $customer = remove_junk($db->escape($_POST['customer']));
    $product = remove_junk($db->escape($_POST['product']));
    $number = remove_junk($db->escape($_POST['number']));
    $price = remove_junk($db->escape($_POST['price']));
    $paymethod = remove_junk($db->escape($_POST['paymethod']));
    $notes = remove_junk($db->escape($_POST['notes']));
    $current_date    = make_date();
    if (empty($errors)) {
        $sql  = "INSERT INTO orders (customer,product, number, price,paymethod,notes,date)";
        $sql .= " VALUES ('{$customer}','{$product}','{$number}','{$price}','{$paymethod}','{$notes}','{$current_date}')";
        if ($db->query($sql)) {
            $session->msg("s", "Successfully Added order");
            redirect(('orders.php?id=' . $new_order_id), false);
        } else {
            $session->msg("d", "Sorry Failed to insert.");
            redirect('add_order.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_order.php', false);
    }
}
?>

<!--     *************************     -->

<?php include_once 'layouts/header.php'; ?>


<div class="login-page">
    <div class="text-center">
        <h2>Add Order</h2>
    </div>
    <?php echo display_msg($msg); ?>

    <form method="post" action="" class="clearfix">
        <!--     *************************     -->
        <div class="form-group">
        </div>

        <div class="form-group">
            <label for="name" class="control-label">Customer Name</label>
            <input type="text" class="form-control" name="customer" value="" placeholder="Customer">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="product" value="" placeholder="Product">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="number" value="" placeholder="Aantal">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="price" value="" placeholder="Prijs SRD">
        </div>

        <div class="form-group">
            <select class="form-control" name="paymethod">
                <option value="">Select Payment Method</option>
                <option value="Cash">Cash</option>
                <option value="Pinpas">Pinpas</option>
                <option value="Bank Overmaking">Bank overmaking</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="notes" placeholder="Notes">
        </div>

        <!--     *************************     -->
        <div class="form-group clearfix">
            <div class="pull-right">
                <button type="submit" name="add_order" class="btn btn-info">Start Order</button>
            </div>
        </div>
    </form>
</div>

<?php include_once 'layouts/footer.php'; ?>