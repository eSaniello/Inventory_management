<?php

/**
 * home.php
 *
 * @package default
 */


$page_title = 'Dashboard';
require_once 'includes/load.php';
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}
$recent_products = find_recent_product_added('5');
$all_leases = find_all_leases();
?>
<?php include_once 'layouts/header.php'; ?>

<!--     *************************     -->
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<script>
  function closePanel() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>

<div class="row" id="myDIV">
  <div class="col-md-12">
    <div class="panel">
      <div class="pull-right">
        <a href="#" onclick="closePanel();" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Close"><i class="glyphicon glyphicon-remove"></i></a>
      </div>
      <div class="jumbotron text-center">
        <h3>Welkom!</h3>
        Neem contact op met helpdesk voor aanvullende hulp.
      </div>
    </div>
  </div>
</div>
<!--     *************************     -->
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Uitgeleende producten</span>
          <a href="add_lease.php" class="btn btn-info pull-right">Nieuwe uitleen</a>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <!--     *************************     -->
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Datum </th>
              <th>Naam </th>
              <th>Afdeling</th>
              <th>Product</th>
              <th>Aantal</th>
              <th>Reden</th>
              <th>Status</th>
              <th>Acties</th>
            </tr>
            <!--     *************************     -->
          </thead>
          <tbody>
            <!--     *************************     -->
            <?php foreach ($all_leases as $lease) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo read_date($lease['date']) ?></td>
                <td><?php echo remove_junk(ucwords($lease['fullname'])) ?></td>
                <td class="text-center"><?php echo remove_junk(ucwords($lease['department'])) ?></td>
                <td><?php echo remove_junk(ucwords($lease['name'])) ?></td>
                <td><?php echo remove_junk(ucwords($lease['number'])) ?></td>
                <td><?php echo remove_junk(ucwords($lease['reason'])) ?></td>
                <!--     *************************     -->
                <td class="text-center">
                  <?php if ($lease['status'] === '1') : ?>
                    <span class="label label-success"><?php echo "Ingeleverd"; ?></span>
                  <?php else : ?>
                    <span class="label label-danger"><?php echo "Niet ingeleverd"; ?></span>
                  <?php endif; ?>
                </td>
                <!--     *************************     -->
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_lease.php?id=<?php echo (int)$lease['id'] . "&status=" . (int)$lease['status']; ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Ingeleverd">
                      <i class="glyphicon glyphicon-check"></i>
                    </a>
                    <a href="delete_lease.php?id=<?php echo (int)$lease['id']; ?>" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
                      <i class="glyphicon glyphicon-remove"></i>
                    </a>
                  </div>
                </td>
                <!--     *************************     -->
              </tr>
            <?php endforeach; ?>
            <!--     *************************     -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--     *************************     -->
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recent toegevoegde producten</span>
          <a href="add_product.php" class="btn btn-info pull-right">+</a>
        </strong>
      </div>
      <div class="panel-body">
        <div class="list-group">
          <?php foreach ($recent_products as  $recent_product) : ?>
            <a class="list-group-item clearfix" href="view_product.php?id=<?php echo    (int)$recent_product['id']; ?>">
              <h4 class="list-group-item-heading">
                <?php if ($recent_product['media_id'] === '0') : ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                <?php else : ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt="" />
                <?php endif; ?>
                <?php echo remove_junk(first_character($recent_product['name'])); ?>
                <span class="label label-warning pull-right">
                  $<?php echo (int)$recent_product['buy_price']; ?>
                </span>
              </h4>
              <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['category'])); ?>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?php

//echo "<pre>";
//echo LIB_PATH_INC;
//echo "</pre>";
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";
?>

</div>
</div>
<?php include_once 'layouts/footer.php'; ?>