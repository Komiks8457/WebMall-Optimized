<script type="text/javascript">
    function Purchase_all(formid) {
        $(formid + ' .details td.chk :checkbox').attr('checked', true);

        //	if (checkCnt == 0)
        if ($(formid + ' .details td.chk :checkbox').size() == 0) {
            modalAlert('Please select the item to purchase');
            return false;
        } else $(formid).submit();
    }

    function checkForm(formid) {
        var cboxCnt = $(formid + " :checkbox").length
        var iboxCnt = $(formid + " :text").length
        var checkCnt = 0

        for (i = 0; i <= cboxCnt - 1; i++) {
            if ($(formid + " :checkbox")[i].checked == true) {
                checkCnt = checkCnt + 1
            }
        }

        if (checkCnt == 0) {
            modalAlert('Please select the item to purchase');
            return false;
        }

        $(formid).submit();
    }

    function onsubmitform(formid)
    {
        $('.btn-ga.btn-ga-purchase').addClass('disabled');
        $('.btn-ga.btn-ga-confirm').addClass('disabled');
        return true;
    }

    function ItemAmountChange(qty) {
        var totalprice = 0;
<?php foreach ($_itempid as $_index => $_pid):
    $_item = $fn->GetItemByPID($_pid);
    if ($_item['discount_rate'] > 0) {
        $_bcmul = bcmul($_item['silk_price'], $_item['discount_rate']);
        $_price = bcsub($_item['silk_price'], bcdiv($_bcmul, '100'));
    } else $_price = $_item['silk_price'];
?>
        totalprice += parseInt($('#qty_<?= $_item['package_id'] ?>').val() * <?= $_price ?>);
<?php endforeach; ?>
        $('#totalprice').html(Intl.NumberFormat('en-US').format(totalprice));
    }

    //숫자외의 문자 입력 금지
    $(document).ready(function() {
        $('.val input').css('ime-mode', 'disabled');

        $('.val').keypress(function(e) {
            //alert(event.which);
            if (e.which && (e.which > 47 && e.which < 58 || e.which == 8)) {
                //alert('숫자임!');
            } else {
                //alert('숫자아님!');
                e.preventDefault();
            }
        });

        // Check all of each category
        $('.details th.chk :checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).parents('.details').find('td.chk :checkbox').attr('checked', true);
            } else {
                $(this).parents('.details').find('td.chk :checkbox').attr('checked', false);
            }
        });

        $('#premium').html("<?= number_format($fn->silkinfo['premium']) ?>");
        $('#usagemonth').html("<?= $fn->NumberFormatTh($fn->silkinfo['usagemonth']) ?>");
        $('#usage3months').html("<?= $fn->NumberFormatTh($fn->silkinfo['usage3months']) ?>");
        $('#silk').html("<?= number_format($fn->silkinfo['silk']) ?>");
    });
</script>