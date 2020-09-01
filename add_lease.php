<?php

/**
 * add_user.php
 *
 * @package default
 */


$page_title = 'Add Lease';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);
$products = find_all('products');
?>
<?php
if (isset($_POST['add_lease'])) {

    $req_fields = array('name', 'department', 'product', 'number', 'reason');
    validate_fields($req_fields);

    if (empty($errors)) {
        $name   = remove_junk($db->escape($_POST['name']));
        $department   = remove_junk($db->escape($_POST['department']));
        $product   = remove_junk($db->escape($_POST['product']));
        $number = (int)$db->escape($_POST['number']);
        $reason = remove_junk($db->escape($_POST['reason']));

        $query = "INSERT INTO leases (";
        $query .= "fullname,department,product_id,number,reason, status";
        $query .= ") VALUES (";
        $query .= " '{$name}', '{$department}', '{$product}', '{$number}','{$reason}', '0'";
        $query .= ")";
        if ($db->query($query)) {
            //sucess
            $session->msg('s', "Nieuwe uitleen aangemaakt! ");
            redirect('leases.php', false);
        } else {
            //failed
            $session->msg('d', ' Sorry failed to create lease!');
            redirect('add_lease.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_lease.php', false);
    }
}
?>
<?php include_once 'layouts/header.php'; ?>
<?php echo display_msg($msg); ?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Nieuwe uitleen</span>
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