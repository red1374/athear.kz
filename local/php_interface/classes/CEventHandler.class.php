<?php
class CEventHandler{
    public static function Redirect404() {
        global $APPLICATION, $USER;

        if (!defined('ADMIN_SECTION') && defined("ERROR_404")) {
            /** @var $APPLICATION \CMain */
            //$APPLICATION->RestartBuffer();
            //require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_DIR.'404/index.php') && $APPLICATION->GetCurDir() !== SITE_DIR.'404/'){
                require $_SERVER['DOCUMENT_ROOT'] . SITE_DIR.'404.php';//Localredirect(SITE_DIR.'404/', "404 Not Found");
            }else{
                include_once $_SERVER['DOCUMENT_ROOT'] . SITE_DIR.'404.php';
            }

            //require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
        }
    }

    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields){
    }

    public static function onBeforeUserAddHandler(array &$arFields){
        if (defined('ADMIN_SECTION'))
            return true;

        if (!isset($arFields['LOGIN']) || $arFields['LOGIN'] == 'NEW_LOGIN' || !$arFields['LOGIN']){
            $arFields['LOGIN'] = $arFields['EMAIL'];
        }
    }

    public static function onAfterUserAddHandler(array &$arFields){
        if (intval($arFields["ID"]) > 0){
            $toSend = Array();
            $toSend["PASSWORD"] = $arFields["CONFIRM_PASSWORD"];
            $toSend["EMAIL"]    = $arFields["EMAIL"];
            $toSend["LOGIN"]    = $arFields["LOGIN"];
            // -- Add parameter for new user from autoregistration ---------- //

            $toSend["NAME"]     = ($arFields["NAME"] ? $arFields["NAME"] : $arFields["LAST_NAME"]);

            $res = CEvent::Send("NEW_USER_ADDED", "s1", $toSend);
        }
    }

    public static function onBeforeUserRegister(&$arFields){
        global $APPLICATION;

        if ((!isset($_POST["form_checkbox_AGREEMENT"]) || intval($_POST["form_checkbox_AGREEMENT"]) != 20)
                && $APPLICATION->GetCurDir() != "/bitrix/components/bitrix/sale.order.ajax/"){
            $APPLICATION->ThrowException("FALSE_AGREEMENT");
            return false;
        }
    }

    public static function onBeforeOrderAdd(&$arFields){
        global $APPLICATION;

        $hasException       = false;

        /*if (!$arFields['ORDER_PROP'][41] || !$arFields['ORDER_PROP'][43]){
            $APPLICATION->ThrowException("Укажите <strong>Желаемый месяц и день получения</strong>!");
            $hasException= TRUE;
        }*/

        if ($hasException)
            return FALSE;
    }

    public static function saleOrderBeforeSaved(Bitrix\Sale\Order $order){
        //$order = $event->getParameter("ENTITY");

        // -- Trim order properties ----------------------------------------- //
        $propertyCollection = $order->getPropertyCollection();
        foreach($propertyCollection AS &$propertyItem)
            $propertyItem->setField("VALUE", trim($propertyItem->getValue()));
    }

    public static function saleOrderSaved(Bitrix\Main\Event $event){
    }

    private static function onSaleOrderAdd(Bitrix\Main\Event $event){
        $order  = $event->getParameter("ENTITY");
        $propertyCollection = $order->getPropertyCollection();

        /*if (){
            $order->setField('USER_DESCRIPTION', $comment);
            $order->save();
        }
        COrder::getByPropertyCode($propertyCollection, 'RECEIVE_MONTH'))
         * $arPropData = $preorderPropValue->getProperty();
         *          */
    }


    public static function onBeforeIBlockElementAdd(&$arFields){
        global $APPLICATION, $USER;

        if (!defined('ADMIN_SECTION')){
            $hasException   = FALSE;

            if ((
                !filter_var($arFields["NAME"], FILTER_VALIDATE_EMAIL) && $arFields['IBLOCK_ID'] == IB_SUBSCRIBE_FORM_ID) || (
                !filter_var($arFields["CODE"], FILTER_VALIDATE_EMAIL) && in_array($arFields['IBLOCK_ID'], [
                    IB_QUESTION_FORM_ID,
                ])
            )){
                $APPLICATION->ThrowException("'Некорректный формат E-mail'");
                $hasException= TRUE;
            }

//            if (!isset($_POST['agreement']) && in_array($arFields['IBLOCK_ID'], [
//                    CClass::FEEDBACK_FORM_IBLOCK_ID,
//                    CClass::PARTNERS_FORM_IBLOCK_ID,
//                    CClass::REVIEWS_IBLOCK_ID,
//                ])){
//                $APPLICATION->ThrowException("FALSE_AGREEMENT");
//                $hasException= TRUE;
//            }
            if ( (!isset($_POST['PROPERTY']['BX'][0]) || $_POST['PROPERTY']['BX'][0]) && in_array($arFields['IBLOCK_ID'], [
                    IB_SUBSCRIBE_FORM_ID,
                    IB_QUESTION_FORM_ID,
                ])){
                $APPLICATION->ThrowException("BOT!");
                $hasException= TRUE;
            }

            if (IB_SUBSCRIBE_FORM_ID == $arFields['IBLOCK_ID']){
                CModule::includeModule('iblock');
                $res = \Bitrix\Iblock\Elements\ElementSubscribeTable::getList([
                    'select'    => ['ID'],
                    'filter'    => ['CODE' => $arFields["NAME"]],
                ]);
                if ($res->fetch()){
                    $APPLICATION->ThrowException("'Некорректный формат E-mail'");
                    $hasException= TRUE;
                }else{
                    $arFields["CODE"] = $arFields["NAME"];
                    $arFields["PROPERTY_VALUES"][80] = $_SERVER['REMOTE_ADDR'];
                }
            }
            if (IB_QUESTION_FORM_ID == $arFields['IBLOCK_ID']){
                $arFields["PROPERTY_VALUES"][81] = $_SERVER['REMOTE_ADDR'];
            }
//            if (CClass::REVIEWS_IBLOCK_ID == $arFields['IBLOCK_ID']){
//                $arFields["PROPERTY_VALUES"][148] = $USER->getId();
//                $arFields["PROPERTY_VALUES"][199] = $_SERVER['REMOTE_ADDR'];
//                $arFields["ACTIVE"] = 'N';
//            }

            if ($hasException)
                return FALSE;
        }else{
            if (IB_CATALOG_ID == $arFields['IBLOCK_ID']){
                self::fixItemName($arFields);
            }
        }

        return TRUE;
    }

    public static function fixItemName(&$arFields){
        $value = is_array($arFields["PROPERTY_VALUES"][82]) ?
                $arFields["PROPERTY_VALUES"][82]['n0']['VALUE'] : $arFields["PROPERTY_VALUES"][82];

        if (!$value && !empty($arFields["PROPERTY_VALUES"])){
            $arFields["PROPERTY_VALUES"][82] = CClass::fixItemName($arFields['NAME'], [
                'SEARCH'    => ['СА ', 'заушный ', 'сверхмощный ', 'мощный ', 'ReSound ', '(', ')'],
                'REPLACE'   => ['Слуховой аппарат ', '', '', '', '', '', ''],
            ]);
        }
    }

    public static function onAfterIBlockElementAdd(&$arFields){
        //if ($_REQUEST['mode'] == 'import' && $_REQUEST['filename']){
            self::updateMultiValueFields($arFields);
        //}

        $arMail     = [];
        $eventName  = "";

        switch($arFields['IBLOCK_ID']){
        case IB_QUESTION_FORM_ID:
            $arMail = [
                'NAME'      => $arFields['NAME'],
                'EMAIL_FROM'=> $arFields['CODE'],
                'PHONE'     => $arFields['PROPERTY_VALUES'][54],
                'TEXT'      => $arFields['PROPERTY_VALUES'][56],
            ];

            $eventName  = "QUESTION_FORM";
            break;

         case IB_SUBSCRIBE_FORM_ID:
            $arMail = [
                'EMAIL' => $arFields['CODE'],
            ];

            $eventName  = "SUBSCRIBE_FORM";
            break;
        }

        if ($eventName && !empty($arMail) && !defined('ADMIN_SECTION')){
            CEvent::Send($eventName, SITE_ID, $arMail, "Y");
        }
    }

    public static function onBeforeIBlockElementUpdate(&$arFields){
        if (IB_CATALOG_ID == $arFields['IBLOCK_ID']){
            self::fixItemName($arFields);
        }
    }

    public static function onAfterIBlockElementUpdate(&$arFields) {
        //if ($_REQUEST['mode'] == 'import' && $_REQUEST['filename']){
            self::updateMultiValueFields($arFields);
        //}
    }

    public static function onBeforeEventSend(&$arFields, &$arTemplate){
        IncludeTemplateLangFile($_SERVER['DOCUMENT_ROOT'].CClass::HEADER_LANG_FILE_PATH);

        switch ($arTemplate["EVENT_NAME"]):
            case "SALE_NEW_ORDER":
                $arFields["INFORMATION"]= "";

                CModule::IncludeModule("sale");
                $order      = Bitrix\Sale\Order::load($arFields["ORDER_ID"]);
                $delivery_price = $order->getField('DELIVERY_PRICE');
                $price      = $order->getField('PRICE');

                /*if (!$delivery_price){
                    $arFields["INFORMATION"] .= "<p>".GetMessage('HDR_DELIVERY_PRICE_LABEL').": ";
                    $arFields["INFORMATION"] .= "<strong style='color:#ff5a00;'>".GetMessage('HDR_DELIVERY_PRICE_TEXT')."</strong></p>";
                }*/
                break;
        endswitch;
    }

    public static function onEpilog(){
        self::Redirect404();
    }

    private static function updateMultiValueFields(&$arFields){
        //            $_SERVER['DOCUMENT_ROOT'].self::PATH_TO_UPLOAD_DIR.$file_name;
//            if (!file_exists($file_path)){
//            file_put_contents($filename, $data)
//        }
    }

    public static function OnEndBufferContent(&$content) {
        global $APPLICATION;
        $set404 = !(preg_match('/\/catalog\/(.*?)\//si', $APPLICATION->getCurDir()) ||
                preg_match('/\/search\//si', $APPLICATION->getCurDir()) ||
                preg_match('/\/blog\//si', $APPLICATION->getCurDir()) ||
                preg_match('/\/news\//si', $APPLICATION->getCurDir())) && (
                isset($_REQUEST['PAGEN_1']) || isset($_REQUEST['PAGEN_2']));

        if ($set404){
            @define("ERROR_404", "Y");
            define('SKIP_URLREWRITE', 'Y');
        }
        if (defined("ERROR_404")){
            ob_end_clean();
            ob_start();

            include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR.'404.php';
            $content_404 = ob_get_contents();
            ob_end_clean();
            $content = preg_replace('/<main>(.*?)<\/main>/msi', $content_404, $content);
        }

        if ($APPLICATION->GetCurDir() == '/personal/order/'){
            $content = str_replace('/bitrix/components/bitrix/sale.location.selector.search/templates/.default/style.css', '', $content);
        }

        $content = str_replace([
            '<!-- dev2fun module opengraph -->',
            '<!-- /dev2fun module opengraph -->',
        ], '', $content);

        $content = self::compressContent($content);
    }

    private static function compressContent($content){
        global $APPLICATION;

        $url = $APPLICATION->GetCurPage();
        if (strpos($url, 'cron_events.php') || strpos($url, 'compresscontent.php') ||
                preg_match('/\/local\//s', $url) || preg_match('/\/bitrix\//s', $url) || strpos($url, '/init.php') ||
            defined('ADMIN_SECTION') || defined("ERROR_404") || strpos($url, 'get_webp_image.php')
        ){
            return $content;
        }
        $replace = [
            //remove tabs before and after HTML tags
            '/\>[^\S ]+/s' => '>',
            '/[^\S ]+\</s' => '<',
            //shorten multiple whitespace sequences; keep new-line characters because they matter in JS!!!
            '/([\t ])+/s' => ' ',
            '/[ ]{2,}/s' => ' ',
            //remove leading and trailing spaces
            '/^([\t ])+/m' => '',
            '/([\t ])+$/m' => '',
            // remove JS line comments (simple only); do NOT remove lines containing URL (e.g. 'src="http://server.com/"')!!!
            '~//[a-zA-Z0-9 ]+$~m' => '',
            //remove empty lines (sequence of line-end and white-space characters)
            '/[\r\n]+([\t ]?[\r\n]+)+/s' => "\n",
            //remove empty lines (between HTML tags); cannot remove just any line-end characters because in inline JS they can matter!
            //нельзя включать в композитном режиме - для динамических областей создаются пустые divы
            //'/\>[\r\n\t ]+\</s' => '><',
            //remove "empty" lines containing only JS's block end character; join with next line (e.g. "}\n}\n</script>" --> "}}</script>"
            '/}[\r\n\t ]+/s' => '}',
            '/}[\r\n\t ]+,[\r\n\t ]+/s' => '},',
            '/> </s' => '><',
            //три нижние ломают карты и по всей видимости json
            //remove new-line after JS's function or condition start; join with next line
            //'/\)[\r\n\t ]?{[\r\n\t ]+/s'  => '){',
            //'/,[\r\n\t ]?{[\r\n\t ]+/s'  => ',{',
            //remove new-line after JS's line end (only most obvious and safe cases)
            //'/\),[\r\n\t ]+/s'  => '),',
            //remove quotes from HTML attributes that does not contain spaces; keep quotes around URLs!
            //'~([\r\n\t ])?([a-zA-Z0-9]+)="([a-zA-Z0-9_/\\-]+)"([\r\n\t ])?~s' => '$1$2=$3$4', //$1 and $4 insert first white-space character found before/after attribute
        ];
        return preg_replace(array_keys($replace), array_values($replace), $content);
    }
}
