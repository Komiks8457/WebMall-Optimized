<?php if ($fn->st1 == 0 && $fn->st2 == 0 && $fn->NewBestItems('new', 3)): ?>
                            <h3><div><?=($fn->GetCategory(0, 0)['sub_name'][0])?></div></h3>
                            <ul class="list">
<?php foreach ($fn->newitems as $_item) : ?>
                                <li class="<?= ($fn->st0 == 0 ? "silk" : "prem") ?>" style="padding-bottom: 5px;">
                                    <div class="intro">
                                        <a rel="#item-<?= $_item['package_id'] ?>" class="pic"><img src="assets/itemlist_pac/<?= $_item['package_code'] ?>.jpg" alt="" /></a>
                                        <span class="name"><?= $_item['package_name'] ?></span>
                                        <span class="tag"><img src="assets/images/item_new_icon.png" alt="NEW" /></span>
                                        <div id="item-<?= $_item['package_id'] ?>" class="spec">
                                            <p class="spec-name"><strong><?= $_item['package_name'] ?></strong></p>
                                            <ul>
                                                <li class="first"><strong>Description</strong><br /><?= $_item[$fn->loc . '_explain'] ?></li>
                                                <li><strong>How to use</strong><br /><?= $_item[$fn->loc . '_use_method'] ?></li>
                                                <li><strong>Restriction</strong><br /><?= $_item[$fn->loc . '_use_restriction'] ?></li>
<?php if ($_item['item_quantity'] > 1): ?>
                                                <li><strong>Quantity</strong><br /><?= $_item['item_quantity'] ?></li>
<?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price">
                                        <span class="type"><img src="assets/images/<?= $_silkicon[$_item['silk_type']] ?>" alt="" /></span>
                                        <strong class="val">
                                            <strong class="current"><?= $_item['silk_price'] ?>&nbsp;Silk</strong>
                                        </strong>
                                    </div>
                                    <div class="action">
                                        <span class="setter">
                                            <span class="btn-ga" id="item_<?= $_item['package_id'] ?>">
                                                <button type="button" onclick="itemBuy(this, '<?= ITEMBUYGAME ?>', <?= $_item['package_id'] ?>, 1)" >Purchase</button>
                                            </span>
                                        </span>
                                        <span class="pre-sel">
                                            <button type="button" onclick="addReserved(this, '<?= $_item['package_id'] ?>')"><img src="assets/images/btn_presel.png" alt="" /></button>
                                        </span>
                                    </div>
                                </li>
<?php endforeach; ?>
                            </ul>
<?php endif; if ($fn->st1 == 0 && $fn->st2 == 0 && $fn->NewBestItems('best', 3)): ?>
                            <div style="margin-top:15px;"></div>
                            <h3><div><?=($fn->GetCategory(0, 0)['sub_name'][1])?></div></h3>
                            <ul class="list">
<?php foreach ($fn->bestitems as $_item) : ?>
                                <li class="<?= ($fn->st0 == 0 ? "silk" : "prem") ?>" style="padding-bottom: 5px;">
                                    <div class="intro">
                                        <a rel="#item-<?= $_item['package_id'] ?>" class="pic"><img src="assets/itemlist_pac/<?= $_item['package_code'] ?>.jpg" alt="" /></a>
                                        <span class="name"><?= $_item['package_name'] ?></span>
                                        <span class="tag"><img src="assets/images/item_best_icon.png" alt="BEST" /></span>
                                        <div id="item-<?= $_item['package_id'] ?>" class="spec">
                                            <p class="spec-name"><strong><?= $_item['package_name'] ?></strong></p>
                                            <ul>
                                                <li class="first"><strong>Description</strong><br /><?= $_item[$fn->loc . '_explain'] ?></li>
                                                <li><strong>How to use</strong><br /><?= $_item[$fn->loc . '_use_method'] ?></li>
                                                <li><strong>Restriction</strong><br /><?= $_item[$fn->loc . '_use_restriction'] ?></li>
<?php if ($_item['item_quantity'] > 1): ?>
                                                <li><strong>Quantity</strong><br /><?= $_item['item_quantity'] ?></li>
<?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price">
                                        <span class="type"><img src="assets/images/<?= $_silkicon[$_item['silk_type']] ?>" alt="" /></span>
                                        <strong class="val">
                                            <strong class="current"><?= $_item['silk_price'] ?>&nbsp;Silk</strong>
                                        </strong>
                                    </div>
                                    <div class="action">
                                        <span class="setter">
                                            <span class="btn-ga" id="item_<?= $_item['package_id'] ?>">
                                                <button type="button" onclick="itemBuy(this, '<?= ITEMBUYGAME ?>', <?= $_item['package_id'] ?>, 1)">Purchase</button>
                                            </span>
                                        </span>
                                        <span class="pre-sel">
                                            <button type="button" onclick="addReserved(this, '<?= $_item['package_id'] ?>')"><img src="assets/images/btn_presel.png" alt="" /></button>
                                        </span>
                                    </div>
                                </li>
<?php endforeach; ?>
                            </ul>
<?php endif; if ($fn->st1 > 0 && $fn->st2 > 0 && $fn->GetMallItems($_xpt, $_xps)): ?>
                            <h3><div><?=($fn->GetCategory($fn->st1, $fn->st2)['sub_name'])?></div></h3>
                            <ul class="list">
<?php foreach ($fn->mallitems as $_item) : ?>
                                <li class="<?= ($fn->st0 == 0 ? "silk" : "prem") ?>" style="padding-bottom: 5px;">
                                    <div class="intro">
                                        <a rel="#item-<?= $_item['package_id'] ?>" class="pic"><img src="assets/itemlist_pac/<?= $_item['package_code'] ?>.jpg" alt="" /></a>
                                        <span class="name"><?= $_item['package_name'] ?></span>
<?php if ($_item['discount_rate'] > 0): ?>
                                        <span class="tag"><img src="assets/images/item_sale_icon.png" alt="SALE" /></span>
<?php endif; ?>
                                        <div id="item-<?= $_item['package_id'] ?>" class="spec">
                                            <p class="spec-name"><strong><?= $_item['package_name'] ?></strong></p>
                                            <ul>
                                                <li class="first"><strong>Description</strong><br /><?= $_item[$fn->loc . '_explain'] ?></li>
                                                <li><strong>How to use</strong><br /><?= $_item[$fn->loc . '_use_method'] ?></li>
                                                <li><strong>Restriction</strong><br /><?= $_item[$fn->loc . '_use_restriction'] ?></li>
<?php if ($_item['item_quantity'] > 1): ?>
                                                <li><strong>Quantity</strong><br /><?= $_item['item_quantity'] ?></li>
<?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price">
                                        <span class="type"><img src="assets/images/<?= $_silkicon[$_item['silk_type']] ?>" alt="" /></span>
                                        <strong class="val">
                                            <strong class="current"><?= $_item['silk_price'] ?>&nbsp;Silk</strong>
                                        </strong>
                                    </div>
                                    <div class="action">
                                        <span class="setter">
                                            <span class="btn-ga" id="item_<?= $_item['package_id'] ?>">
                                                <button type="button" onclick="itemBuy(this, '<?= ITEMBUYGAME ?>', <?= $_item['package_id'] ?>, 1)">Purchase</button>
                                            </span>
                                        </span>
                                        <span class="pre-sel">
                                            <button type="button" onclick="addReserved(this, '<?= $_item['package_id'] ?>')"><img src="assets/images/btn_presel.png" /></button>
                                        </span>
                                    </div>
                                </li>
<?php endforeach; ?>
                            </ul>
<?php endif; ?>
