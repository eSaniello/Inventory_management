<?php

/**
 * add_sale.php
 *
 * @package default
 */


$page_title = 'Add Sale';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(3);

$order_id = last_id('orders');
$o_id = $order_id['id'];

?>
<?php

if (isset($_POST['add_sale'])) {
  $req_fields = array('s_id', 'quantity', 'price', 'total', 'date', 'supplier');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_id      = $db->escape((int)$_POST['s_id']);
    $s_qty     = $db->escape((int)$_POST['quantity']);

    $product = find_by_id("products", $p_id);
    if ((int)$product['quantity'] < $s_qty) {
      $session->msg('d', ' Insufficient Quantity for Sale!');
      redirect('add_sale.php', false);
    }
    $s_total   = $db->escape($_POST['total']);
    $date      = $db->escape($_POST['date']);
    $supplier      = $db->escape($_POST['supplier']);
    $s_date    = make_date();

    $sql  = "INSERT INTO sales (";
    $sql .= " product_id,order_id,qty,price,supplier,date";
    $sql .= ") VALUES (";
    $sql .= "'{$p_id}','{$o_id}','{$s_qty}','{$s_total}','{$supplier}','{$s_date}'";
    $sql .= ")";

    if ($db->query($sql)) {
      decrease_product_qty($s_qty, $p_id);
      $session->msg('s', "Sale added. ");
      redirect('add_sale.php', false);
    } else {
      $session->msg('d', ' Sorry failed to add!');
      redirect('add_sale.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_sale.php', false);
  }
}

?>
<?php include_once 'layouts/header.php'; ?>

<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Nieuwe bestelling</span>
      </strong>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <form method="post" action="add_lease.php">
          <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" class="form-control" name="name" placeholder="Naam">
          </div>
          <div class="form-group">
            <label for="department">Afdeling</label>
            <input type="text" class="form-control" name="department" placeholder="Afdeling">
          </div>
          <div class="form-group">
            <label for="product">Product</label>
            <select class="form-control" name="product">
              <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product['id']; ?>"><?php echo ucwords($product['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="number">Aantal</label>
            <input type="number" class="form-control" name="number" placeholder="Aantal">
          </div>
          <div class="form-group">
            <label for="reason">Reden</label>
            <input type="text" class="form-control" name="reason" placeholder="Reden">
          </div>
          <div class="form-group clearfix">
            <button type="submit" name="add_lease" class="btn btn-primary">Nieuwe Uitleen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once 'layouts/footer.php'; ?>