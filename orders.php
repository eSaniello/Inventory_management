<?php

/**
 * orders.php
 *
 * @package default
 */


$page_title = 'All orders';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);

$all_orders = find_all('orders')
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
        <span>All Orders</span>
        <!--     *************************     -->
      </strong>
      <div class="pull-right">
        <a href="add_order.php" class="btn btn-primary">Add Order</a>
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center" style="width: 50px;">Leverancier</th>
            <th class="text-center" style="width: 50px;">Product</th>
            <th class="text-center" style="width: 50px;">Aantal</th>
            <th class="text-center" style="width: 50px;">Prijs</th>
            <th class="text-center" style="width: 50px;">Pay Method</th>
            <th class="text-center" style="width: 50px;">Notes</th>
            <th class="text-center" style="width: 50px;">Date</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!--     *************************     -->
          <?php foreach ($all_orders as $order) : ?>
            <tr>
              <td class="text-center">
                <a href="sales_by_order.php?id=<?php echo (int)$order['id']; ?>">
                  <?php echo $order['id']; ?>
                </a>
              </td>

              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['customer'])); ?>
              </td>
              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['product'])); ?>
              </td>
              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['number'])); ?>
              </td>
              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['price'])); ?>
              </td>
              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['paymethod'])); ?>
              </td>

              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['notes'])); ?>
              </td>

              <td class="text-center">
                <?php echo remove_junk(ucfirst($order['date'])); ?>
              </td>

              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_order.php?id=<?php echo (int)$order['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_order.php?id=<?php echo (int)$order['id']; ?>" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </div>
              </td>

            </tr>
          <?php endforeach; ?>
          <!--     *************************     -->
        </tbody>
      </table>
    </div>
  </div>

  <?php
  /**
   * print "<pre>";
   * print_r($all_orders);
   * print "</pre>\n";
   *
   */
  ?>


</div>
</div>
</div>
<?php include_once 'layouts/footer.php'; ?>