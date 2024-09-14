<?php

if (!$fn->ResumeSession()) {
    header("Location: " . $fn->BuildErrorUrl(3));
    exit();
}

$fn->st0 = $_GET['st0'] ?? 3; //SilkType: 3 = Premium Silk, 0 = Silk
$fn->st1 = $_GET['st1'] ?? 0; //Category: 
$fn->st2 = $_GET['st2'] ?? 0; //Sub-Category:
$fn->st3 = $_GET['st3'] ?? 1; //TopNav: 1 = Premium, 2 = Silk, 3 = Reserve, 4 = History

$_xpp = null; //Style switch

$_silkicon = [
    0 => "silk.png",
    3 => "silk_premium.png",
    5 => "silk_prem.png"
];

switch ($fn->st3) {
    case 0:
    case 1:
    case 2:
        $_xpp = "mall-list";
        break;
    case 3:
        $_xpp = "buyitem reserved";
        break;
    case 4:
        $_xpp = "buyitem history";
        break;
    case 5:
    case 6:
        $_xpp = "buyitem";
        break;
    case 80:
        $_xpp = "buyitem-guide";
        break;
    case 7:
        $_xpp = "mall-list item-edit";
        break;
    case 69:
        $_xpp = "mall-list item-search";
        break;
    default:
        $_xpp = "mall-list";
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?= TITLE ?></title>
    <meta http-equiv="Page-Enter" content="blendTrans(Duration=1.5)">
    <meta http-equiv="Page-Exit" content="blendTrans(Duration=1.5)">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Keywords" content="<?= KEYWORD ?>">
    <meta name="Description" content="<?= DESC ?>">
    <link type="text/css" href="assets/css/webmall_game.css?ver=<?= rand(1111, 9999) ?>" rel="stylesheet" media="all" />
    <script type="text/javascript" src="assets/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.pngFix.js?v=567567"></script>
    <script type="text/javascript" src="assets/js/jquery.sexy-combo.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.cluetip.js"></script>
    <script type="text/javascript" src="assets/js/jquery.scroll.js"></script>
    <script type="text/javascript" src="assets/js/ingame_shell.js?v=567567"></script>
    <script type="text/javascript" src="assets/js/_common.js?v=657567"></script>
</head>
<body class="mig" ondragstart="return false" onselectstart="return false">
    <div id="wrap" class="<?= $_xpp ?>">
        <div id="header">
            <h1><span style="color: darkorange;">Item Mall</span></h1>
            <ul id="gnb">
                <li class="prem<?= ($fn->st3 == 1 ? " current" : null) ?>"><a href="<?= ($fn->st3 == 1 ? "#" : ITEMBUYGAME . "?st3=1&st0=3") ?>"><span class="prem_icon<?= ($fn->st3 == 1 ? null : " inactive") ?>">&nbsp;Premium Mall</span></a></li>
                <li class="silk<?= ($fn->st3 == 2 ? " current" : null) ?>"><a href="<?= ($fn->st3 == 2 ? "#" : ITEMBUYGAME . "?st3=2&st0=0") ?>"><span class="silk_icon<?= ($fn->st3 == 2 ? null : " inactive") ?>">&nbsp;Silk Mall</span></a></li>
                <li class="rsrv<?= ($fn->st3 == 3 ? " current" : null) ?>"><a href="<?= ($fn->st3 == 3 ? "#" : ITEMBUYGAME . "?st3=3") ?>"><span class="rsrv_icon<?= ($fn->st3 == 3 ? null : " inactive") ?>">&nbsp;Reserve</span></a></li>
                <li class="hist<?= ($fn->st3 == 4 ? " current" : null) ?>"><a href="<?= ($fn->st3 == 4 ? "#" : ITEMBUYGAME . "?st3=4") ?>"><span class="hist_icon<?= ($fn->st3 == 4 ? null : " inactive") ?>">&nbsp;History</span></a></li>
            </ul>
        </div>
        <div id="developer">
            <div id="lead">
                <div class="pod silkowned">
                    <div class="run">
                        <h2>Silk Owned</h2>
                        <dl class="status">
                            <dt>Premium Silk :</dt>
                            <dd><span id="silk_prem"><?= ($fn->silkinfo['premium'] ?? 0) ?>&nbsp;<img src="assets/images/silk_premium.png" alt="" /></dd>
                            <dt> -Month Usage : </dt>
                            <dd><span id="latestmonth"><?= ($fn->silkinfo['usagemonth'] ?? 0) ?>&nbsp;<img src="assets/images/silk_premium.png" alt="" /></dd>
                            <dt> -3Month Usage : </dt>
                            <dd><span id="past3months"><?= ($fn->silkinfo['usage3months'] ?? 0) ?>&nbsp;<img src="assets/images/silk_premium.png" alt="" /></dd>
                            <dt>Silk :</dt>
                            <dd><span id="silk"><?= ($fn->silkinfo['silk'] ?? 0) ?>&nbsp;<img src="assets/images/silk.png" alt="" /></dd>
                        </dl>
                    </div>
                </div>
                <form id="searchForm" name="searchForm" method="post" onsubmit="return checkSearchForm()">
                    <div class="search">
                        <h2>Search</h2>
                        <span class="keyword">
                            <input type="hidden" name="st3" value="69" />
                            <input type="text" id="searchWord" name="search" size="10" value="" />
                        </span>
                        <span class="btn"><button type="submit">Search</button></span>
                    </div>
                </form>
            </div>
            <div id="fol" class="setter">
                <div id="content">
<?php
if ($fn->st3 == 1 || $fn->st3 == 2)
    require('ItemBuyGame_Category.php');
?>
                    <div id="screen">
                        <div class="opener mold"></div>
                        <div class="cropped">
<?php
if ($fn->st1 > 0 && $fn->st2 > 0)
{
    $_prv = 0; // Paginator Prev
    $_nxt = 0; // Paginator Next
    $_xps = 12; //Max items per page
    $_xpn = $_GET['page'] ?? 1; //Pager
    $_xpc = $fn->CacheDataSetCount(); //Total items of category or sub-category
    //$_xpt = index for fetching items 

    $_pagination = $_xpc > $_xps ? true : false;

    if ($_xpc > $_xps)
        $_xpc = ceil($_xpc / $_xps);

    $_xpt = $_xpn > 1 ? ($_xpn * $_xps) - $_xps : 0;

    $_prv = $_xpn > 1 ? $_xpn - 1 : $_xpn;
    $_nxt = $_xpn < $_xpc ? $_xpn + 1 : $_xpn;
}
switch ($fn->st3) {
    case 0:
    case 1:
    case 2:
        require('ItemBuyGame_List.php');
        break;
    case 3:
        require('ItemBuyGame_Reserve.php');
        break;
    case 4:
        require('ItemBuyGame_History.php');
        break;
    case 6:
        require('ItemBuyGame_Buy.php');
        break;
    case 69:
        require('ItemBuyGame_SearchResult.php');
        break;
    default:
        require('ItemBuyGame_List.php');
        break;
}
?>
                        </div>
                        <div class="closer mold"></div>
                    </div>
<?php if ($_pagination): ?>
                    <div class="pagex">
                        <div id="paginate">
                            <img src="assets/images/arrow_left.png" title="Prev" style="vertical-align:middle;cursor:pointer;margin-right:1px;" onclick="gotoLocation(this, '<?= $fn->PageLinkBuilder($_prv) ?>')" />
<?php for ($i = 1; $i <= $_xpc; $i++): if ($_xpn == $i): ?>
                            <span class="pager" style="margin:0 0.5px;" title="Page <?= $i ?>">[<?= $i ?>]</span>
<?php else:?>
                            <a href="<?= $fn->PageLinkBuilder($i) ?>" style="margin:0 0.5px;" title="Page <?= $i ?>"><?= $i ?></a>
<?php endif; endfor; ?>
                            <img src="assets/images/arrow_right.png" title="Next" style="vertical-align:middle;cursor:pointer;margin-left:1px;" onclick="gotoLocation(this, '<?= $fn->PageLinkBuilder($_nxt) ?>')" />
                        </div>
                    </div>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modalAlert">
        <div class="window">
            <div class="title"><span class="val"></span></div>
            <div class="content"><p class="val"></p></div>
            <div class="footer">
                <button type="button" class="button" id="ok">OK</button>
                <button type="button" class="button" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
</body>
<?php if ($fn->st3 == 6) include('ItemBuyGame_Helper.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function () {
            $.ajax({
                url: "heartbeat.html",
                method: "GET",
                cache: false,
                async: true,
                data: { ping : 1 },
                success: function(response) {
                    if (response.pong < 0)
                        gotoLocation(null, response.message);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (response.pong < 0)
                        gotoLocation(null, response.message);
                }
            });
        }, 5000);
    });
</script>
</html>