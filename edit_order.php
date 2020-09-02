<?php

/**
 * edit_order.php
 *
 * @package default
 */


$page_title = 'Bestelling wijzigen';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php
//Display all catgories.
$order = find_by_id('orders', (int)$_GET['id']);
if (!$order) {
  $session->msg("d", "Missing order id.");
  redirect('orders.php');
}
?>

<?php
if (isset($_POST['edit_order'])) {
  $customer = remove_junk($db->escape($_POST['customer']));
  $product = remove_junk($db->escape($_POST['product']));
  $number = remove_junk($db->escape($_POST['number']));
  $price = remove_junk($db->escape($_POST['price']));
  $paymethod = remove_junk($db->escape($_POST['paymethod']));
  $notes = remove_junk($db->escape($_POST['notes']));
  $date = remove_junk($db->escape($_POST['date']));
  if ($date == 0) {
    $date    = make_date();
  }

  if (empty($errors)) {
    $sql = "UPDATE orders SET";
    $sql .= " customer='{$customer}', product='{$product}', number='{$number}', price='{$price}', paymethod='{$paymethod}', notes='{$notes}', date='{$date}'";
    $sql .= " WHERE id='{$order['id']}'";

    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg("s", "Successfully updated order");
      redirect('orders.php', false);
    } else {
      $session->msg("d", "Sorry! Failed to Order");
      redirect('orders.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('orders.php', false);
  }
}
?>
<?php include_once 'layouts/header.php'; ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>#<?php echo remove_junk(ucfirst($order['id'])); ?> Bijwerken</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_order.php?id=<?php echo (int)$order['id']; ?>">
          <div class="form-group">
            <input type="text" class="form-control" name="customer" value="<?php echo remove_junk(ucfirst($order['customer'])); ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="product" value="<?php echo remove_junk(ucfirst($order['product'])); ?>">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="number" value="<?php echo remove_junk(ucfirst($order['number'])); ?>">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="price" value="<?php echo remove_junk(ucfirst($order['price'])); ?>">
          </div>

          <div class="form-group">
            <select class="form-control" name="paymethod">
              <option value="">Betalingsmethode selecteren</option>
              <option value="Cash" <?php if ($order['paymethod'] === "Cash") : echo "selected";
                                    endif; ?>>Cash</option>
              <option value="Pinpas" <?php if ($order['paymethod'] === "Pinpas") : echo "selected";
                                      endif; ?>>Pinpas</option>
              <option value="Bank Overmaking" <?php if ($order['paymethod'] === "Bank Overmaking") : echo "selected";
                                              endif; ?>>Bank Overmaking</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="notes" value="<?php echo remove_junk(ucfirst($order['notes'])); ?>" placeholder="Notes">
          </div>

          <div class="form-group">
            <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($order['date']); ?>">
          </div>

          <button type="submit" name="edit_order" class="btn btn-primary">Bestelling wijzigen</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once 'layouts/footer.php'; ?>