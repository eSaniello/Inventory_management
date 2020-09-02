<?php

/**
 * add_product.php
 *
 * @package default
 */


$page_title = 'Product toevoegen';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(2);

$all_categories = find_all('categories');
$all_photo = find_all('media');

?>


<?php
if (isset($_POST['add_product'])) {
  $req_fields = array('product-title', 'product-category', 'product-quantity', 'cost-price');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_desc  = remove_junk($db->escape($_POST['product-desc']));
    $p_loc  = remove_junk($db->escape($_POST['product-location']));
    $p_cat   = remove_junk($db->escape($_POST['product-category']));
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy   = remove_junk($db->escape($_POST['cost-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $date    = make_date();
    $query  = "INSERT INTO products (";
    $query .= " name,description,location,quantity,buy_price,category_id,media_id,date";
    $query .= ") VALUES (";
    $query .= " '{$p_name}', '{$p_desc}', '{$p_loc}', '{$p_qty}', '{$p_buy}', '{$p_cat}', '{$media_id}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if ($db->query($query)) {

      $product = last_id("products");
      $product_id = $product['id'];
      if ($product_id == 0) {
        $session->msg('d', ' Sorry failed to added!');
        redirect('add_product.php', false);
      }

      $quantity = $p_qty;
      $cost = $p_buy;
      $comments = "initial stock";

      $sql  = "INSERT INTO stock (product_id,quantity,comments,date)";
      $sql .= " VALUES ('{$product_id}','{$quantity}','{$comments}','{$date}')";
      $result = $db->query($sql);
      if ($result && $db->affected_rows() === 1) {
        $session->msg('s', "Product added ");
        redirect('products.php', false);
      }
    } else {
      $session->msg('d', ' Sorry failed to added!');
      redirect('add_product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}

?>


<?php include_once 'layouts/header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<!--     *************************     -->
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <!--     *************************     -->
          <span>Nieuwe product toevoegen</span>
          <!--     *************************     -->
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <!--     *************************     -->
          <form method="post" action="add_product.php" class="clearfix">
            <!--     *************************     -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title" placeholder="Product Titel">
              </div>
            </div>


            <!--     *************************     -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-desc" placeholder="Product omschrijving">
              </div>
            </div>

            <!--     *************************     -->

            <!--     *************************     -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-location" placeholder="Product Locatie">
              </div>
            </div>

            <!--     *************************     -->

            <div class="form-group">
              <div class="row">

                <!--     *************************     -->
                <div class="col-md-6">
                  <select class="form-control" name="product-category">
                    <option value="">Product categorie selecteren</option>


                    <?php foreach ($all_categories as $cat) : ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>

                    <?php endforeach; ?>
                  </select>
                </div>
                <!--     *************************     -->

                <div class="col-md-6">
                  <select class="form-control" name="product-photo">
                    <option value="">Product foto selecteren</option>

                    <?php foreach ($all_photo as $photo) : ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>

                    <?php endforeach; ?>
                  </select>

                </div>
              </div>
            </div>

            <!--     *************************     -->

            <div class="form-group">
              <div class="row">
                <!--     *************************     -->
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </span>
                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Aantal">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-usd"></i>
                    </span>
                    <input type="number" min="0" step="any" class="form-control" name="cost-price" placeholder="Prijs">
                  </div>
                </div>
                <!--     *************************     -->

              </div>
            </div>
            <!--     *************************     -->
            <div class="pull-right">
              <button type="submit" name="add_product" class="btn btn-danger">product toevoegen</button>
            </div>

            <!--     *************************     -->
          </form>

        </div>
      </div>
    </div>
    <?php
    ?>

  </div>
</div>

<?php include_once 'layouts/footer.php'; ?>