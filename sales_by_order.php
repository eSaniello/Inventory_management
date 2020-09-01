<?php
/**
 * sales_by_order.php
 *
 * @package default
 */


$page_title = 'All sales by Order';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(3);
?>

<?php
if (isset($_GET['id'])) {
	$order_id = (int) $_GET['id'];
} else {
	$session->msg("d", "Missing order id.");
}

$sales = find_sales_by_order_id( $order_id );
$order = find_by_id("orders", $order_id);
?>



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
            <span>Order #<?php echo $order_id; ?></span>
<!--     *************************     -->
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 50px;">Customer</th>
                    <th class="text-center" style="width: 50px;">Pay Method</th>
                    <th class="text-center" style="width: 50px;">Notes</th>
                    <th class="text-center" style="width: 50px;">Date</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
<!--     *************************     -->
                <tr>
                    <td class="text-center">
					<a href="add_sale_to_order.php?id=<?php echo (int)$order['id'];?>">
					<?php echo $order['id'];?>
					</a>
					</td>

                    <td class="text-center">
						<?php echo remove_junk(ucfirst($order['customer']));?>
					</td>
                    <td class="text-center">
						<?php echo remove_junk(ucfirst($order['paymethod']));?>
					</td>

                    <td class="text-center">
						<?php echo remove_junk(ucfirst($order['notes']));?>
					</td>

                    <td class="text-center">
						<?php echo remove_junk(ucfirst($order['date']));?>
					</td>

                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_order.php?id=<?php echo (int)$order['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_order.php?id=<?php echo (int)$order['id'];?>" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
<!--     *************************     -->
            </tbody>
          </table>
       </div>
    </div>

<!--     *************************     -->

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Sales</span>
          </strong>
          <div class="pull-right">
            <a href="add_sale_to_order.php?id=<?php echo $order_id; ?>" class="btn btn-primary">Add sale</a>
          </div>
        </div>
        <div class="panel-body">
<!--     *************************     -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
<!--     *************************     -->
           <tbody>

             <?php foreach ($sales as $sale):?>

             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>

             <?php endforeach;?>


<!--     *************************     -->

             <tr>
               <td class="text-center"></td>
               <td class="text-center"></td>
               <td class="text-center"></td>
			<?php
$order_total = 0;
foreach ($sales as $sale) {
	$order_total = $order_total + $sale['price'];
}
?>
               <td class="text-center">$<?php echo number_format($order_total, 2); ?></td>
               <td class="text-center"></td>
               <td class="text-center"></td>


			</tr>


           </tbody>
         </table>
<!--     *************************     -->
        </div>
      </div>
<?php
// print "<pre>";
// print_r($sales);
// print "</pre>\n";
?>


<?php
// print "<pre>";
// print_r($order);
// print "</pre>\n";
?>


    </div>
  </div>
<?php include_once 'layouts/footer.php'; ?>
