<?php
$code = $_GET['code'];
$shopId = $_GET['shop_id'];

echo "Shop ID  = " . $shopId;
echo "<br> Code  = " . $code;

?>

<style>
    li {
        margin-bottom: 15px;
    }
</style>

<ul>
    <li>
        <a href="<?php echo 'get_shop_info.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get shop info</a>
    </li>
    <li>
        <a href="<?php echo 'get_category.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get category</a>
    </li>
    <li>
        <a href="<?php echo 'get_attributes.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get attributes</a>
    </li>
    <li>
        <a href="<?php echo 'get_channel_list.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get channel list</a>
    </li>
    <li>
        <a href="<?php echo 'update_channel.php?shop_id=' . $shopId . '&code=' . $code; ?>">Update channel</a>
    </li>
    <li>
        <a href="<?php echo 'register_brand.php?shop_id=' . $shopId . '&code=' . $code; ?>">Register brand</a>
    </li>
    <li>
        <a href="<?php echo 'get_brand_list.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get brand list</a>
    </li>
    <li>
        <a href="<?php echo 'add_item.php?shop_id=' . $shopId . '&code=' . $code; ?>">Add item</a>
    </li>
    <li>
        <a href="<?php echo 'get_item.php?shop_id=' . $shopId . '&code=' . $code; ?>">Get item</a>
    </li>
</ul>
