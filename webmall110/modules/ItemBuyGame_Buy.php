<?php

use Safe\Exceptions\ExecException;

$_buy = $_GET['buy'] ?? 0;
$_pid = $_GET['pid'] ?? 0;
$_itempid = $_POST['itempid'] ?? [];
$_itemqty = $_POST['itemqty'] ?? [];
$_totalrp = 0; //total silk price
$_pstatus = 0; //purchase status
$_invoice = 0;

$_submit = $_POST['submit'] ?? false;

if (!$_submit) {
    if (str_contains($_pid, '|')) {
        foreach (explode("|", $_pid) as $_index => $_pidx) {
            $_itempid[$_index] = $_pidx;
            $_itemqty[$_index] = 1;
        }
    } else {
        $_itempid[] = $_pid;
        $_itemqty[] = 1;
    }
}
?>
                        <h2>
                            <div>Purchasing</div>
                        </h2>
                        <form id="buyitem" action="<?= ITEMBUYGAME ?>?st3=6" method="post" onsubmit="onsubmitform(this)">
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

    if (!$_item) {
        header("Location: " . $fn->BuildErrorUrl(5));
        exit();
    }

    if ($_item['discount_rate']) {
        $_bcmul = bcmul($_item['silk_price'], $_item['discount_rate']);
        $_price = bcsub($_item['silk_price'], bcdiv($_bcmul, '100'));
        $_totalrp += ($_itemqty[$_index] * $_price);
    } else {
        $_totalrp += ($_itemqty[$_index] * $_item['silk_price']);
    }

    $_silks_icon[$_index] = $_item['silk_type'];

    if ($_submit === 'purchase')
    {
        switch($_item['silk_type'])
        {
            case 0: //Silk Mall
                if ($_totalrp > $fn->silkinfo['silk'] + $fn->silkinfo['premium']) {
                    //not enough silk
                    $_pstatus = 1;
                }
                break;
            case 3: //Premium Mall
                if ($_totalrp > $fn->silkinfo['premium']) {
                    //not enough premium silk
                    $_pstatus = 2;
                }
                break;
            default: //goto error when silk_type is not in 0 or 3
                header("Location: " . $fn->BuildErrorUrl(6));
                exit();
        }
    }

    if ($_submit === 'confirm')
    {
        try
        {
            if ($_invoice === 0) {
                // Generate once per transaction
                $_invoice = 'JCASH' . date('YmdHis');
            }
    
            for($i = 1; $i <= $_itemqty[$_index]; $i++)
            {
                $_cp_invoice = $fn->RandomNumbers().sprintf('%03d', $i);

                if (!$fn->BuyNewItem($_pid, $_invoice, $_cp_invoice)) {
                    Common::WriteLog("FAILED TO BUY ITEM", __FILE__ . " at line " . __LINE__);
                }
            }
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FILE__ . " at line " . __LINE__);
            exit();
        }
    }
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
<?php if (!$_submit): ?>
                                            <div class="val">
                                                <input type="text" name="itemqty[]" id="qty_<?= $_item['package_id'] ?>" size="5" maxlength="2" value="1" onfocus="this.blur()" readonly />
                                            </div>
<?php elseif ($_submit === 'purchase' || $_submit === 'confirm'): ?>
                                            <span class="qty"><?= $_itemqty[$_index] ?></span>
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
<?php if ($_submit === 'purchase' || $_submit === 'confirm'): ?>
                                        <input type="hidden" name="itemqty[]" value="<?=$_itemqty[$_index]?>" />
<?php endif; ?>
                                    </tr>
<?php endforeach; ?>
                                    <tr class="total">
                                        <th colspan="3"><strong>Total</strong></th>
                                        <td colspan="2" class="price">
                                            <span class="setter">
                                                <span class="val">
                                                    <span id="totalprice"><?= number_format($_totalrp) ?></span>&nbsp;<img src="assets/images/<?=((in_array('0', $_silks_icon) && in_array('3', $_silks_icon)) ? $_silkicon[5] : $_silkicon[$_silks_icon[0]])?>" alt="" />
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
<?php if ($_submit === 'purchase' && $_pstatus > 0): ?>
                            <div class="msg msg-nesilk">
<?php if ($_pstatus == 1): ?>
                                <p class="remainging">Your current balance is insufficient for this purchase of <strong><?= number_format($_totalrp) ?></strong>&nbsp;<img src="assets/images/silk.png" alt="" /></p>
<?php else: ?>
                                <p class="remainging">Your current balance is insufficient for this purchase of <strong><?= number_format($_totalrp) ?></strong>&nbsp;<img src="assets/images/silk_premium.png" alt="" /></p>
<?php endif; ?>
                                <p>Click the [Silk Charge] button on the top right corner to buy more credits.</p>
                            </div>
<?php elseif ($_submit === 'purchase' && $_pstatus === 0): ?>
                            <p class="msg msg-result">
                                <strong>Please view purchase information.</strong><br>
                                <strong style="color:#fff200;">Limited-time items can only be used until their expiration date. Check the date.</strong>
                            </p>
<?php elseif ($_submit === 'confirm'): ?>
                            <div class="receiving">
                                <h3 class="tit">Item Successfully Purchased</h3>
                                <ul>
                                    <li>1. Start the game and enter the server you chose when you bought the item.</li>
                                    <li>2. Enter the game with the character that will receive the item.</li>
                                    <li>3. If you right-click on the icon above in the game, the purchased item list will appear. When you click [get] from the list, the selected item will be moved to the inventory.</li>
                                <ul>
                                <div class="steps"><img src="assets/images/content_rpitems_img.png" alt="" /></div> 
                            </div>
<?php endif; ?>
                            <div class="ga">
                                <span class="btn-ga btn-ga-cancel">
<?php if ($_submit === 'confirm'): ?>
                                    <button type="button" onclick="gotoLocation(this, '<?=ITEMBUYGAME?>')">Return</button>
<?php else: ?>
                                    <button type="button" onclick="history.back()">Back</button>
<?php endif; ?>
                                </span>
<?php if (!$_submit): ?>
                                <span class="btn-ga btn-ga-purchase">
                                    <button type="submit" name="submit" value="purchase" id="btn-purchase">Purchase</button>
                                </span>
<?php elseif ($_submit === 'purchase' && $_pstatus === 0): ?>
                                <span class="btn-ga btn-ga-confirm">
                                    <button type="submit" name="submit" value="confirm" id="btn-confirm">Confirm</button>
                                </span>
<?php elseif ($_submit === 'confirm'): ?>
                                <span class="btn-ga btn-ga-history">
                                    <button type="button" id="btn-history">History</button>
                                </span>
<?php endif; ?>
								<!--span class="btn-ga btn-ga-history">
                                    <button type="button" onclick="gotoLocation(this, '<?=ITEMBUYGAME?>?st3=4')">History</button>
                                </span-->
                            </div>
<?php if (!$_submit && count($_itempid) == 1): ?>
                            <div class="detail-view" id="detailimg">
                                <div class="cont">
                                    <img onerror="$('#detailimg').hide()" src="assets/itemlist_pac/<?= $_item['package_code'] ?>_detail.jpg" alt="" />
                                </div>
                            </div>
                            <div style="height:1px"></div>
<?php endif; ?>
                        </form>
