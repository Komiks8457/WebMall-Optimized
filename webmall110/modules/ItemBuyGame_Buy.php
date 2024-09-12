<?php

$_buy = $_GET['buy'] ?? 0;
$_pid = $_GET['pid'] ?? 0;

if ($_buy == 0 && $_pid == 0) {
    header("Location: " . $fn->BuildErrorUrl(5));
    exit();
}

$_totalrp = 0;
$_itempid = $_POST['itempid'] ?? [];
$_itemqty = $_POST['itemqty'] ?? [];

$_purchase = $_POST['purchase'] ?? false;
$_confirm = $_POST['confirm'] ?? false;

if (str_contains($_pid, '|')) {
    foreach (explode("|", $_pid) as $_index => $_pidx) {
        $_itempid[$_index] = $_pidx;
        $_itemqty[$_index] = $_GET['qty'] ?? 1;
    }
} else {
    $_itempid[] = $_pid;
    $_itemqty[] = $_GET['qty'] ?? 1;
}
?>
                        <h2>
                            <div>Purchasing</div>
                        </h2>
                        <form action="<?= ITEMBUYGAME ?>?st3=6" method="post" id="buymenu" onsubmit="return true;">
                            <input type="hidden" value="buy" value=2 />
                            <div class="details">
                                <table width="528">
                                    <col width="*" />
                                    <col width="100" />
                                    <col width="80" />
                                    <col width="60" />
                                    <col width="90" />
                                    <tr>
                                        <th>Product Name</th>
                                        <th>User ID</th>
                                        <th>Server</th>
                                        <th>Quantity</th>
                                        <th class="price">Price</th>
                                    </tr>
<?php
foreach ($_itempid as $_index => $_pid):

    if ($_pid == 0)
        continue;

    $_item = $fn->GetItemByPID($_pid);

    if ($_item == -1)
        break;

    if ($_item['discount_rate']) {
        $_bcmul = bcmul($_item['silk_price'], $_item['discount_rate']);
        $_price = bcsub($_item['silk_price'], bcdiv($_bcmul, '100'));
        $_totalrp += ($_itemqty[$_index] * $_price);
    } else {
        $_totalrp += ($_itemqty[$_index] * $_item['silk_price']);
    }

    $_silks_icon[$_index] = $_item['silk_type'];
?>
                                        <tr>
                                            <td class="item <?= ($_item['silk_type'] == 0 ? "silk" : "prem") ?>">
                                                <span class="pic"><img src="assets/itemlist_pac/<?= $_item['package_code'] ?>.jpg" alt="" /></span>
                                                <span class="name"><?= $_item['package_name'] ?></span>
                                                <?php if ($_item['discount_rate'] > 0): ?>
                                                    <span class="tag"><img src="assets/images/item_sale_icon.png" alt="SALE" /></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="userid">IDDDD</td>
                                            <td class="server">
                                                <span class="val">THOTH</span>
                                            </td>
                                            <td class="qty">
<?php if (!$_purchase): ?>
                                                    <div class="val">
                                                        <input type="text" name="itemqty[]" id="qty_<?= $_item['package_id'] ?>" size="5" maxlength="2" value="1" readonly />
                                                    </div>
<?php else: ?>
                                                    <span class="val"><?= $_itemqty[$_index] ?></span>
<?php endif; ?>
                                            </td>
                                            <td class="price">
                                                <span class="val">
                                                    <strong class="current">
                                                        <span id="curprice"><?= number_format($_item['discount_rate'] > 0 ? $_price : $_item['silk_price']) ?></span>&nbsp;<img src="assets/images/<?= $_silkicon[$_item['silk_type']] ?>" alt="Silk" />
                                                    </strong>
                                                </span>
                                            </td>
                                            <input type="hidden" name="itempid[]" value="<?= $_item['package_id'] ?>" />
                                            <input type="hidden" name="itemqty[]" value="<?= $_itemqty[$_index] ?>" />
                                        </tr>
<?php endforeach; ?>
                                    <tr class="total">
                                        <th colspan="3"><strong>Total</strong></th>
                                        <td colspan="2" class="price">
                                            <span class="setter">
                                                <span class="val">
                                                    <span id="totalprice"><?= number_format($_totalrp) ?></span>&nbsp;<img src="assets/images/<?= $_silkicon[$_item['silk_type']] ?>" alt="Silk" />
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="ga">
                                <span class="btn-ga btn-ga-cancel">
                                    <button type="button" onclick="history.back()">Back</button>
                                </span>
                                <span class="btn-ga btn-ga-purchase">
                                    <button type="button" name="submit" value="purchase">Purchase</button>
                                </span>
								<span class="btn-ga btn-ga-history">
                                    <button type="button" onclick="gotoLocation(this, '<?=ITEMBUYGAME?>?st3=4')">History</button>
                                </span>
                            </div>
                            <div class="detail-view" id="detailimg">
                                <div class="cont">
                                    <img onerror="$('#detailimg').hide()" src="assets/itemlist_pac/<?= $_item['package_code'] ?>_detail.jpg" alt="" />
                                </div>
                            </div>
                            <div style="height:1px"></div>
                        </form>