                <ul class="category">
                    <!-- New & Best -->
                    <li class="<?=($fn->st1 == 0 ? "cur" : null)?>" id="cate"><a href="<?=($fn->st1 == 0 && $fn->st2==0 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=0&st2=0&st3=" . $fn->st3)?>"><?=($fn->GetCategory(0, 0)['name'])?></a></li>
                    <!-- Expendables -->
                    <li class="<?=($fn->st1 == 1 ? "cur" : null)?>" id="cate_1"><a href="<?=($fn->st1 == 1 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 1)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 1 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 1)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 1 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 1 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 3)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 1 && $fn->st2 == 4 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=4&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 4)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 1 && $fn->st2 == 5 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=1&st2=5&st3=" . $fn->st3)?>"><?=($fn->GetCategory(1, 5)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Avatar -->
                    <li class="<?=($fn->st1 == 2 ? "cur" : null)?>" id="cate_2"><a href="<?=($fn->st1 == 2 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=2&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(2, 1)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 2 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=2&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(2, 1)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 2 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=2&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(2, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 2 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=2&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(2, 3)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 2 && $fn->st2 == 4 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=2&st2=4&st3=" . $fn->st3)?>"><?=($fn->GetCategory(2, 4)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Pet -->
                    <li class="<?=($fn->st1 == 3 ? "cur" : null)?>" id="cate_3"><a href="<?=($fn->st1 == 3 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=3&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(3, 2)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 3 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=3&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(3, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 3 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=3&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(3, 3)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 3 && $fn->st2 == 5 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=3&st2=5&st3=" . $fn->st3)?>"><?=($fn->GetCategory(3, 5)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Fellow -->
                    <li class="<?=($fn->st1 == 6 ? "cur" : null)?>" id="cate_6"><a href="<?=($fn->st1 == 6 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=6&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(6, 1)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 6 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=6&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(6, 1)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 6 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=6&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(6, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 6 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=6&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(6, 3)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Premium -->
                    <li class="<?=($fn->st1 == 4 ? "cur" : null)?>" id="cate_4"><a href="<?=($fn->st1 == 4 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=4&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(4, 1)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 4 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=4&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(4, 1)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 4 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=4&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(4, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 4 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=4&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(4, 3)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Alchemy -->
                    <li class="<?=($fn->st1 == 5 ? "cur" : null)?>" id="cate_5"><a href="<?=($fn->st1 == 5 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=5&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(5, 1)['name'])?></a>
                        <div class="lower">
                            <div class="pointer"></div>
                            <ul>
                                <li><a href="<?=($fn->st1 == 5 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=5&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(5, 1)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 5 && $fn->st2 == 2 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=5&st2=2&st3=" . $fn->st3)?>"><?=($fn->GetCategory(5, 2)['sub_name'])?></a></li>
                                <li><a href="<?=($fn->st1 == 5 && $fn->st2 == 3 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=5&st2=3&st3=" . $fn->st3)?>"><?=($fn->GetCategory(5, 3)['sub_name'])?></a></li>
                            </ul>
                        </div>
                    </li>
<?php if ($fn->st0 == 3): ?>
                    <!-- SUPPORTER -->
                    <li class="<?=($fn->st1 == 7 ? "cur" : null)?>" id="cate_7"><a href="<?=($fn->st1 == 7 && $fn->st2 == 1 ? "#" : ITEMBUYGAME . "?st0=" . $fn->st0 . "&st1=7&st2=1&st3=" . $fn->st3)?>"><?=($fn->GetCategory(7, 1)['name'])?></a></li>
<?php endif; ?>
                </ul>
