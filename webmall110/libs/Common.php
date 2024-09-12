<?php

require_once ("Database.php");
require_once ("Session.php");

class Common extends Database
{
    private ?Session $session = null;
    private ?Database $database = null;

    public ?array $newitems = null;
    public ?array $bestitems = null;
    public ?array $mallitems = null;
    public ?array $ico = null;

    public ?int $st0 = null;
    public ?int $st1 = null;
    public ?int $st2 = null;
    public ?int $st3 = null;

    public ?array $silkinfo = null;

    public ?string $loc = null;

    public function __construct()
    {
        $this->database = new Database();

        if (!is_dir(CACHE_DIR))
            mkdir(CACHE_DIR);
    }

    public function NavLinkBuilder($st0 = null, $st1 = null, $st2 = null, $st3 = null, $page = null)
    {
        $_params = [];

        if (!is_null($st0) || !is_null($this->st0)) {
            $_params['st0'] = !is_null($st0) ? $st0 : $this->st0;
        }

        if (!is_null($st1) || !is_null($this->st1)) {
            $_params['st1'] = !is_null($st1) ? $st1 : $this->st1;
        }

        if (!is_null($st2) || !is_null($this->st2)) {
            $_params['st2'] = !is_null($st2) ? $st2 : $this->st2;
        }

        if (!is_null($st3) || !is_null($this->st3)) {
            $_params['st3'] = !is_null($st3) ? $st3 : $this->st3;
        }

        if (!is_null($page)) {
            $_params['page'] = $page;
        }
        
        $queryString = http_build_query($_params);
        return ITEMBUYGAME . '?' . $queryString;
    }

    public function Initialize($jid, $key, $loc)
    {
        $this->session = Session::getInstance();

        $this->session->setSessionId(strtolower($key));

        if ($this->session->startSession())
        {
            $this->session->jid = $jid;
            $this->session->key = strtolower($key);
            $this->session->loc = $loc;
            return true;
        }

        return false;
    }

    public function ResumeSession()
    {
        $this->session = Session::getInstance();
        
        if (!$this->session->resumeSession())
        {
            $this->session->destroy();
            return false;
        }

        if (!isset($this->session->auth) || !$this->session->auth)
        {
            if (!$this->CertifyKey())
            {
                $this->session->destroy();
                return false;
            }

            $this->session->shard_id    = 323;
            $this->session->pjid        = $this->GetPortalJID();
            $this->session->auth        = true;
        }
        
        $this->loc = $this->session->loc;

        return $this->session->auth;
    }
    
    public function GetSilk()
    {
        $_jid = $this->session->jid;

        $_query = [
            "EXEC dbo.WEB_GETSILK :jid",
            [":jid" => $_jid]
        ];

        $_result = $this->database->Exec($_query);

        if (!$_result)
            return;
        
        $this->session->silkinfo =
        [
            'premium'       => $_result[0]['PremiumSilk'],
            'usagemonth'    => $_result[0]['UsageMonth'],
            'usage3months'  => $_result[0]['Usage3Months'],
            'silk'          => $_result[0]['Silk']
        ];

        $this->silkinfo = $this->session->silkinfo;
    }

    public function CertifyKey()
    {
        $_jid = $this->session->jid;

        $_certifykey = $this->database->Get("WEB_ITEM_CERTIFYKEY",
            [
                'CertifyKey',
                'reg_date',
                'CharLevel'
            ],[
                'UserJID' => $_jid,
                'ORDER' => ['reg_date' => 'DESC'],
                'LIMIT' => 1
            ]
        );

        if (!$_certifykey)
            return false;

        $_sesskey = strtolower(hash('md5', $_jid . $_certifykey['CertifyKey'] . SALTKEY));

        if ($_sesskey != $this->session->key) //temp
        {
            $this->session->charlvl = $_certifykey['CharLevel'];
            $this->session->timestamp = $_certifykey['reg_date'];
            return true;
        }

        self::WriteLog("JID (" . $_jid . "), cannot certify site session (" . $this->session->key . ") with server session (" . $_sesskey . ")", __FUNCTION__);

        return false;
    }

    public function GetPortalJID()
    {
        $_jid = $this->session->jid;

        $_getpjid = $this->database->Get("TB_User",
            ['PortalJID'],
            ['JID' => $_jid]
        );

        return (!$_getpjid ? 0 : $_getpjid['PortalJID']);
    }

    public function BuildErrorUrl($errorid = null)
    {
        return (SSL ? "https://" : "http://") . DOMAIN . "/error" . EXT . "?msg=" . (!is_null($errorid) ? $errorid : "noparam");
    }

    public function GetCategory($cat, $sub_cat)
    {
        //new and best
        if ($cat == 0 && $sub_cat == 0) return ['name' => 'New & Best', 'sub_name' => ['New', 'Best']];
        //expendables tab
        if ($cat == 1 && $sub_cat == 1) return ['name' => 'Expendables', 'sub_name' => 'Special'];
        if ($cat == 1 && $sub_cat == 2) return ['name' => 'Expendables', 'sub_name' => 'Scroll'];
        if ($cat == 1 && $sub_cat == 3) return ['name' => 'Expendables', 'sub_name' => 'Potion'];
        if ($cat == 1 && $sub_cat == 4) return ['name' => 'Expendables', 'sub_name' => 'Community'];
        if ($cat == 1 && $sub_cat == 5) return ['name' => 'Expendables', 'sub_name' => 'Others'];
        //avatar tab
        if ($cat == 2 && $sub_cat == 1) return ['name' => 'Avatar', 'sub_name' => 'Stall'];
        if ($cat == 2 && $sub_cat == 2) return ['name' => 'Avatar', 'sub_name' => 'Hat'];
        if ($cat == 2 && $sub_cat == 3) return ['name' => 'Avatar', 'sub_name' => 'Dress'];
        if ($cat == 2 && $sub_cat == 4) return ['name' => 'Avatar', 'sub_name' => 'Attach'];
        //pet tab
        if ($cat == 3 && $sub_cat == 2) return ['name' => 'Pet', 'sub_name' => 'Ability Pet'];
        if ($cat == 3 && $sub_cat == 3) return ['name' => 'Pet', 'sub_name' => 'Vehicle'];
        if ($cat == 3 && $sub_cat == 5) return ['name' => 'Pet', 'sub_name' => 'Pet Items'];
        //premium tab
        if ($cat == 4 && $sub_cat == 1) return ['name' => 'Premium', 'sub_name' => 'Premium'];
        if ($cat == 4 && $sub_cat == 2) return ['name' => 'Premium', 'sub_name' => 'Gear'];
        if ($cat == 4 && $sub_cat == 3) return ['name' => 'Premium', 'sub_name' => 'Others'];
        //alchemy tab
        if ($cat == 5 && $sub_cat == 1) return ['name' => 'Alchemy', 'sub_name' => 'Astral'];
        if ($cat == 5 && $sub_cat == 2) return ['name' => 'Alchemy', 'sub_name' => 'Immortal'];
        if ($cat == 5 && $sub_cat == 3) return ['name' => 'Alchemy', 'sub_name' => 'Others'];
        //fellow tab
        if ($cat == 6 && $sub_cat == 1) return ['name' => 'Fellow', 'sub_name' => 'Growth'];
        if ($cat == 6 && $sub_cat == 2) return ['name' => 'Fellow', 'sub_name' => 'Equipment'];
        if ($cat == 6 && $sub_cat == 3) return ['name' => 'Fellow', 'sub_name' => 'Others'];
        //vip tab
        if ($cat == 7 && $sub_cat == 1) return ['name' => '<font color="yellow"><b>SUPPORTER</b></font>', 'sub_name' => 'VIP'];
    }

    public function NewBestItems($type, $count)
    {
        switch ($type) {
            case "new":
                $_data = $this->VW_WEB_MALL_LIST([
                    'is_new'    => 1,
                    'service'   => 1,
                    'silk_type' => $this->st0,
                    'ORDER'     => ['reg_date' => 'DESC'],
                    'LIMIT'     => $count
                ]);
                $this->newitems = $_data[1];
                break;
            case "best":
                $_data = $this->VW_WEB_MALL_LIST([
                    'is_best'   => 1,
                    'service'   => 1,
                    'silk_type' => $this->st0,
                    'ORDER'     => ['reg_date' => 'DESC'],
                    'LIMIT'     => $count]
                );
                $this->bestitems = $_data[1];
                break;
            default:
                return false;
        }

        return $_data[0];
    }

    public function AddToCart($pid)
    {
        $_jid = $this->session->jid;

        $_exists = $this->database->Exists('WEB_ITEM_RESERVED', ['userjid'=>$_jid, 'package_id'=>$pid]);

        if ($_exists)
            return -1;

        $_count = $this->database->Count('WEB_ITEM_RESERVED', ['userjid'=>$_jid]);

        if ($_count === FALSE || $_count >= 20)
            return -2;
        
        $_item = $this->GetItemByPID($pid);

        if ($_item === FALSE || $_item['vip_level'] > $this->session->charlvl)
            return -3;

        $_insert = $this->database->Insert('WEB_ITEM_RESERVED', ['userjid'=>$_jid, 'package_id'=>$pid]);

        if ($_insert === FALSE)
            return -997;

        return 0;
    }

    public function GetMallItems($min, $max)
    {
        $_data = $this->VW_WEB_MALL_LIST([
            'silk_type' => $this->st0,
            'ref_no'    => $this->st1,
            'sub_no'    => $this->st2,
            'active'    => 1,
            'ORDER'     => 'item_order',
            'LIMIT'     => [$min, $max]
        ]);

        $this->mallitems = $_data[1];
        return $_data[0];
    }

    public function GetItemByPID($pid)
    {
        $_data = $this->VW_WEB_MALL_LIST(['package_id'=> $pid]);
        return ($_data[0] == FALSE ? null : $_data[1][0]);
    }

    public function VW_WEB_MALL_LIST($array, $loc = 'us')
    {
        $_filename = hash('md5', serialize($array));

        $_cached = $this->CacheDataSet($_filename);

        if ($_cached)
            return [true, $_cached];

        $_data = $this->database->Select('VW_WEB_MALL_LIST', [
            'service',
            'package_code',
            'name_code',
            'silk_type',
            'silk_price',
            'silk_price_grow',
            'silk_price_item',
            'discount_rate',
            'discount_rate_grow',
            'discount_rate_item',
            'origin_server',
            'grow_server',
            'item_server',
            'vip_level',
            'month_limit',
            'package_id',
            'package_name',
            $loc . '_explain',
            $loc . '_use_method',
            $loc . '_use_restriction',
            'shop_order',
            'sub_order',
            'shop_name_' . $loc,
            'sub_name_' . $loc,
            'ref_no',
            'sub_no',
            'item_order',
            'is_list',
            'active',
            'item_quantity',
            'reg_date'
        ], $array);

        if (!$_data)
            return [false, null];

        if (sizeof($_data) == 0)
            return [false, null];

        return [true, $this->CacheDataSet($_filename, $_data)];
    }

    public function CacheDataSet($filename, $set = null)
    {
        $_cachefile = CACHE_DIR . $filename;

        if (!file_exists($_cachefile) && is_null($set))
            return false;

        if (file_exists($_cachefile) && is_null($set)) {
            $_cachedata = unserialize(file_get_contents($_cachefile));

            if ($_cachedata['lifetime'] < time())
                return false;

            return $_cachedata['data'];
        }

        $_data = ['lifetime' => time() + CACHE_MAX_AGE, 'data' => $set];
        file_put_contents($_cachefile, serialize($_data), LOCK_EX);

        return $_data['data'];
    }

    public function CacheDataSetCount()
    {
        $_array = [
            'silk_type' => $this->st0,
            'ref_no'    => $this->st1,
            'sub_no'    => $this->st2,
            'active'    => 1
        ];

        $_cachefile = CACHE_DIR . hash('md5', serialize($_array) . $this->st3);

        if (!file_exists($_cachefile)) {
            $_data = ['count' => $this->database->Count('VW_WEB_MALL_LIST', $_array)];
            file_put_contents($_cachefile, serialize($_data), LOCK_EX);
            return $_data['count'];
        }

        return unserialize(file_get_contents($_cachefile))['count'] ?? 0;
    }

    public static function WriteLog($logmsg, $fname = null, $file = "error.log")
    {
        $logdir = ABSPATH . "logs/";
        if (!is_dir($logdir)) mkdir($logdir);
        error_log(date('[Y-m-d H:i:s]: ') . (!is_null($fname) ? "[" . $fname . "] " : null) . $logmsg . PHP_EOL, 3, $logdir . $file);
    }
}
