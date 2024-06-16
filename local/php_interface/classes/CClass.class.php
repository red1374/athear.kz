<?php
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== TRUE)
		throw new BitrixNotFoundException();

    use Bitrix\Main\Context,
        Bitrix\Main\HttpContext,
        Bitrix\Main\HttpApplication;
	/**
	 * Class CClass
	 *
	 * Contains most commonly used site-wide methods
	 *
	 */
	class CClass {
        const CACHE_TIME            = 360000;

        public $curPage             = NULL;     // Current page URL
        public $curDir              = NULL;     // Current section URL

        const HEADER_LANG_FILE_PATH = '/local/templates/audiotech/header.php';

        /** @var $app \CMain */
		private $app                = NULL;

        /** @var $instance CClass */
		private static $instance = NULL;

        private function __construct(\CMain $app) {
            $this->app      = $app;
            $this->curPage  = $app->GetCurPage();
            $this->curDir   = $app->GetCurDir();
		}

		/**
		 * Singletone implementation
		 *
		 * @return CClass
		 */
		public static function Instance() {
			if (!is_object(CClass::$instance))
				CClass::$instance = new CClass($GLOBALS['APPLICATION']);

			return CClass::$instance;
		}

        /**
		 * Check for site-root
		 *
		 * @return bool
		 */
		public function isRoot(){
			return ( ($this->app->GetCurPage() === SITE_DIR || $this->app->GetCurPage() === SITE_DIR.'index.php') &&
                    !defined("ERROR_404") );
		}

        public function getBufferesH1(){
            global $APPLICATION;

            $title = $APPLICATION->GetPageProperty('h1');

            if (!$title)
                $title = $APPLICATION->GetDirProperty('h1');

            return $title ? $title : $APPLICATION->GetTitle();
        }

        public static function getBufferesTitle(){
            global $APPLICATION;

            $title = $APPLICATION->GetPageProperty('new_title');

            if (!$title)
                $title = $APPLICATION->GetDirProperty('new_title');

            return $title ? $title : $APPLICATION->GetTitle();
        }

        /**
         * Replace a part of item name with given string
         * @param string $name
         * @param array $arReplace
         * @return string
         */
        public static function fixItemName($name = '', $arReplace = []):string {
            if (empty($arReplace) || !$name){
                return "";
            }

            return str_replace($arReplace['SEARCH'], $arReplace['REPLACE'], $name);
        }

        /**
         * Reset server parameter for ajax request
         */
        public function resetAjaxParams(){
            /* -- convert POST params to GET ---------------------------------------- */
            if (!empty($_POST))
                foreach($_POST AS $key => &$value)
                    if (!in_array($key, ['data', 'href', 'params']))
                        $_GET[$key] = $value;

            if (isset($_POST['params'])){
                parse_str(trim(str_replace('?', '', $_POST['params'])), $arURLParams);
                $_SERVER['QUERY_STRING'] = $_POST['params'];
                foreach($arURLParams AS $key => &$value)
                    $_GET[$key] = $value;
            }
            if (isset($_POST['href']))
                $_SERVER['REQUEST_URI'] = $_POST['href'];
            $_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'] = '/bitrix/urlrewrite.php';
            $_SERVER['REAL_FILE_PATH'] = $_POST['real_path'].'index.php';

            if (isset($_POST['path'])){
                $_SERVER['SCRIPT_URL']      = $_POST['path'];
                $_SERVER['SCRIPT_FILENAME'] = str_replace('/ajax.php', '/bitrix/urlrewrite.php', $_SERVER['SCRIPT_FILENAME']);
                $_SERVER['SCRIPT_URI']      = str_replace('/ajax.php', $_POST['path'], $_SERVER['SCRIPT_URL']); //$_POST['path']
            }


            /* -- Get section ID param ---------------------------------------------- */
            if (preg_match('/\/section-(.*?)\//msi', $_REQUEST['path'], $res)){
                $_REQUEST['SECTION_ID'] = (int)$res[1];
            }
            if (preg_match('/\/rubric-(.*?)\//msi', $_REQUEST['path'], $res)){
                $_REQUEST['RUBRIC_ID'] = (int)$res[1];
            }

            if (isset($_POST['href']) && preg_match('/\/aktsii\//',$_POST['href'])){
                $GLOBALS['arrFilter'] = array('PROPERTY_SPECIALOFFER_VALUE' => 'да');
            }

            $_GET['PAGEN_2'] = $_POST['PAGEN_2'];
            if (isset($_POST['params']) && $_POST['params']){
                $_POST['params'] = str_replace('?', '', $_POST['params']);
                $arParams = explode('&', $_POST['params']);
                foreach($arParams AS $param){
                    $arTmp = explode('=', $param);
                    $_GET[$arTmp[0]] = $_REQUEST[$arTmp[0]] = urldecode($arTmp[1]);
                }
            }
        }

        /**
         * Get section path
         * @param integer $section_id   - section id
         * @param array $arSections     - catalog sections array
         * @return boolean|array
         */
        public static function getSectionsPath($section_id, $arSections){
            if (empty($arSections) || !$section_id)
                return false;

            if (!$arSections[$section_id]['IBLOCK_SECTION_ID'])
                return [$arSections[$section_id]];

            return array_merge([$arSections[$section_id]], self::getSectionsPath($arSections[$section_id]['IBLOCK_SECTION_ID'], $arSections));
        }

        /**
         * Reset Request params
         * @global object $APPLICATION  - CMain class object
         * @param array $arParams   - new request params
         * @return boolean
         */
        public static function setRequestParams($arParams = []) {
            global $APPLICATION;

            if (empty($arParams)){
                return false;
            }

            $application = \Bitrix\Main\Application::getInstance();
            $context = $application->getContext();
            $request = $context->getRequest();
            $Response = $context->getResponse();
            $Server = $context->getServer();
            $server_get = $Server->toArray();
            $server_get["REQUEST_URI"] = $arParams['REQUEST_URI'];
            $_SERVER['QUERY_STRING'] = $arParams['QUERY_STRING'];
            $_SERVER['REQUEST_URI'] = $arParams['REQUEST_URI'];
            if ($_SERVER['QUERY_STRING']){
                $_SERVER["SCRIPT_URI"] = substr($arParams['REQUEST_URI'], 0, strpos($arParams['REQUEST_URI'], '?'));
            }

            $Server->set($server_get);
            $context->initialize(new Bitrix\Main\HttpRequest($Server, array(), array(), array(), $_COOKIE), $Response, $Server);

            $APPLICATION->reinitPath();

            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

            $uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
            parse_str($uri->getQuery(), $arUrlParams);
            $_GET = $arUrlParams;
        }

        /**
         * Send Curl request
         * @param srting $url   - URL string
         * @param string $json  - json request object
         * @return boolean
         */
        public static function curl($url, $json, $port = 80){
            $error  = FALSE;
            $info   = "";

            if ($tuCurl = curl_init()){
                $userAgent  = "Mozilla/5.0 (compatible; YandexMetrika/2.0; +http://yandex.com/bots mtmon01g.yandex.ru)";

                $header[0] = "Accept: text/html,application/xhtml+xml,application/xml;";
                $header[0] .= "q=0.9,image/webp,*/*;q=0.8";
                $header[] = "Cache-Control: max-age=0";
                $header[] = "Connection: keep-alive";
                $header[] = "Keep-Alive: 300";
                $header[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4";

                curl_setopt($tuCurl, CURLOPT_PORT, $port);

                if (!empty($json)){
                    curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $json);
                }

                if ($port == 443)
                    curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($tuCurl, CURLOPT_ENCODING, 'gzip, deflate, sdch');
                curl_setopt($tuCurl, CURLOPT_URL, $url);
                curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
                curl_setopt($tuCurl, CURLOPT_HEADER, 0);
                curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);

                curl_setopt($tuCurl, CURLOPT_USERAGENT, $userAgent);
                /*$strCookie = 'SessionID=' . $_COOKIE['PHPSESSID'] . '; path=/';
                curl_setopt($tuCurl, CURLOPT_COOKIE, $strCookie);*/

                $tuData = curl_exec($tuCurl);

                if (!curl_errno($tuCurl))
                    $info = curl_getinfo($tuCurl);
                else
                    $error = 'Curl error: ' . curl_error($tuCurl);
                curl_close($tuCurl);

                return [
                    "error" => ($error ? TRUE : FALSE),
                    "data"  => $tuData,
                    "info"  => $info
                ];
            }

            return [
                "error" => TRUE,
                "msg"   => "CURL not installed"
            ];
        }

        public static function uniqueMultidimArray($array, $key) {
            $temp_array = [];
            $key_array  = [];

            foreach($array AS &$arValue) {
                if (!in_array($arValue[$key], $key_array)) {
                    $key_array[]    = $arValue[$key];
                    $temp_array[]   = $arValue;
                }
            }
            return $temp_array;
        }

        public static function sortArrayByValue(&$array, $key = 'NAME'){
            if (empty($array) || !$key)
                return false;

            return array_multisort(array_column($array, $key), SORT_ASC, $array);
        }

        /**
        * Create CSV file
        * @param array $arRows         - data to record
        * @param string $file          - file path
        * @param string $col_delimiter - cols delimiter
        * @param string $row_delimiter - rows delimiter
        * @return boolean|string
        */
       public static function createCSV($arRows, $file = null, $col_delimiter = ';', $row_delimiter = "\r\n"){
            if (!is_array($arRows) || !$file)
                return FALSE;

            $dir = dirname($file);
            if (!file_exists($dir)){
                mkdir($dir);
                chmod($dir, 0755);
            }

            $f      = fopen($file, "w+");
            $CSV_str= '';
            $done   = '';

            foreach($arRows AS &$row){
                $cols = [];

                foreach($row AS &$col_val)
                    $cols[] = $col_val;//mb_convert_encoding($col_val, "cp1251", "UTF-8");

                fputcsv($f, $cols, $col_delimiter);

                //$CSV_str .= implode($col_delimiter, $cols).$row_delimiter;
            }

            $CSV_str = rtrim($CSV_str, $row_delimiter);

            fclose($f);
            if ($file){
                //$CSV_str = iconv("UTF-8", "cp1251",  $CSV_str);

                //$done = file_put_contents($file, $CSV_str);

                return $done;
            }

            return $CSV_str;
        }

        public static function GetNewPassword(){
            $password_min_length = 8;

            $password_chars = array(
                "abcdefghijklnmopqrstuvwxyz",
                "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
                "0123456789"
            );

            return randString($password_min_length, $password_chars);
        }


        /**
         * Correct string cutting
         *
         * @param string $string Target string
         * @param int    $maxlen Maximal length
         *
         * @return string
         */
        public static function cutString($string, $maxlen) {
            $len    = (mb_strlen($string) > $maxlen) ? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
            $cutStr = mb_substr($string, 0, $len);

            return (mb_strlen($string) > $maxlen) ? $cutStr . '...' : $cutStr;
        }

        public static function mb_lcfirst(string $str = ''): string {
            if (!$str){
                return $str;
            }

            $fc = mb_strtolower(mb_substr($str, 0, 1));
            return $fc . mb_substr($str, 1);
        }

        /**
         * Handle json object
         * @param array/string $json
         * @param integer $encode
         */
        public static function clearValues($arValues){
            if (empty($arValues))
                return false;

            foreach($arValues AS &$value)
                if (!is_array($value))
                    $value = trim($value);
                else
                    $value = self::clearValues($value);

            return $arValues;
        }

        public static function clearParam($value){
            return trim(strip_tags($value));
        }

        public static function getNumbers($str){
            return preg_replace('/(\D)/msi', '', $str);
        }

        public static function getPhoneString($phone) {
            if (!$phone){
                return false;
            }
            $phone  = self::getNumbers($phone);
            $pref   = '+';
            if (substr($phone, 0, 1) == '8'){
                $pref .= "7";
                $phone = substr($phone, 1);
            }

            return $pref.$phone;
        }

        public static function json($json, $encode = 0){
            if ($encode)
                if (!is_array($json))
                    echo json_encode(array('data' => iconv('windows-1251','UTF-8', $json)));
                else
                    echo json_encode(array(iconv('windows-1251','UTF-8', $json)));
            else
                if(!is_array($json))
                    echo json_encode(array('data' => $json));
                else
                    echo json_encode($json);
        }

        /**
         * Путукфеу JSON object responce
         * @param string $text - text to cnvert
         * @return json - json object
         */
        public static function MakeJSON($text, $debug = ''){
            $data = [
                'status'    => '2',
                'msg'       => 'Внутреняя ошибка сервера!'
            ];
            $data['debug']  = $debug;
            if (strlen($text) > 5){
                $data['status'] = 0;
                $data['msg']    = $text;
            }
            echo self::json($data);
        }

        /**
		 * Sends object as JSON-response
		 */
		public function RenderJSON($data) {
			header('Cache-Control: no-cache, must-revalidate');
			header('Content-type: text/plain; charset=utf-8');

			$this->app->RestartBuffer();
			die(json_encode($data));
		}

        public function IsMobile() {
            $user_agent=strtolower(getenv('HTTP_USER_AGENT'));
            $accept=strtolower(getenv('HTTP_ACCEPT'));

            if ((strpos($accept,'text/vnd.wap.wml')!==false) ||
                (strpos($accept,'application/vnd.wap.xhtml+xml')!==false)) {
                return 1; // Мобильный браузер обнаружен по HTTP-заголовкам
            }

            if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
                    return 2; // Мобильный браузер обнаружен по установкам сервера
            }

            if (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|'.
                'wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|'.
                'lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|'.
                'mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|'.
                'm881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|'.
                'r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|'.
                'i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|'.
                'htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|'.
                'sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|'.
                'p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|'.
                '_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|'.
                's800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|'.
                'd736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |'.
                'sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|'.
                'up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|'.
                'pocket|kindle|mobile|psp|treo)/', $user_agent)) {
                return 3; // Мобильный браузер обнаружен по сигнатуре User Agent
            }

            if (in_array(substr($user_agent,0,4),
        	    Array("1207", "3gso", "4thp", "501i", "502i", "503i", "504i", "505i", "506i",
                    "6310", "6590", "770s", "802s", "a wa", "abac", "acer", "acoo", "acs-",
                    "aiko", "airn", "alav", "alca", "alco", "amoi", "anex", "anny", "anyw",
                    "aptu", "arch", "argo", "aste", "asus", "attw", "au-m", "audi", "aur ",
                    "aus ", "avan", "beck", "bell", "benq", "bilb", "bird", "blac", "blaz",
                    "brew", "brvw", "bumb", "bw-n", "bw-u", "c55/", "capi", "ccwa", "cdm-",
                    "cell", "chtm", "cldc", "cmd-", "cond", "craw", "dait", "dall", "dang",
                    "dbte", "dc-s", "devi", "dica", "dmob", "doco", "dopo", "ds-d", "ds12",
                    "el49", "elai", "eml2", "emul", "eric", "erk0", "esl8", "ez40", "ez60",
                    "ez70", "ezos", "ezwa", "ezze", "fake", "fetc", "fly-", "fly_", "g-mo",
                    "g1 u", "g560", "gene", "gf-5", "go.w", "good", "grad", "grun", "haie",
                    "hcit", "hd-m", "hd-p", "hd-t", "hei-", "hiba", "hipt", "hita", "hp i",
                    "hpip", "hs-c", "htc ", "htc-", "htc_", "htca", "htcg", "htcp", "htcs",
                    "htct", "http", "huaw", "hutc", "i-20", "i-go", "i-ma", "i230", "iac",
                    "iac-", "iac/", "ibro", "idea", "ig01", "ikom", "im1k", "inno", "ipaq",
                    "iris", "jata", "java", "jbro", "jemu", "jigs", "kddi", "keji", "kgt",
                    "kgt/", "klon", "kpt ", "kwc-", "kyoc", "kyok", "leno", "lexi", "lg g",
                    "lg-a", "lg-b", "lg-c", "lg-d", "lg-f", "lg-g", "lg-k", "lg-l", "lg-m",
                    "lg-o", "lg-p", "lg-s", "lg-t", "lg-u", "lg-w", "lg/k", "lg/l", "lg/u",
                    "lg50", "lg54", "lge-", "lge/", "libw", "lynx", "m-cr", "m1-w", "m3ga",
                    "m50/", "mate", "maui", "maxo", "mc01", "mc21", "mcca", "medi", "merc",
                    "meri", "midp", "mio8", "mioa", "mits", "mmef", "mo01", "mo02", "mobi",
                    "mode", "modo", "mot ", "mot-", "moto", "motv", "mozz", "mt50", "mtp1",
                    "mtv ", "mwbp", "mywa", "n100", "n101", "n102", "n202", "n203", "n300",
                    "n302", "n500", "n502", "n505", "n700", "n701", "n710", "nec-", "nem-",
                    "neon", "netf", "newg", "newt", "nok6", "noki", "nzph", "o2 x", "o2-x",
                    "o2im", "opti", "opwv", "oran", "owg1", "p800", "palm", "pana", "pand",
                    "pant", "pdxg", "pg-1", "pg-2", "pg-3", "pg-6", "pg-8", "pg-c", "pg13",
                    "phil", "pire", "play", "pluc", "pn-2", "pock", "port", "pose", "prox",
                    "psio", "pt-g", "qa-a", "qc-2", "qc-3", "qc-5", "qc-7", "qc07", "qc12",
                    "qc21", "qc32", "qc60", "qci-", "qtek", "qwap", "r380", "r600", "raks",
                    "rim9", "rove", "rozo", "s55/", "sage", "sama", "samm", "sams", "sany",
                    "sava", "sc01", "sch-", "scoo", "scp-", "sdk/", "se47", "sec-", "sec0",
                    "sec1", "semc", "send", "seri", "sgh-", "shar", "sie-", "siem", "sk-0",
                    "sl45", "slid", "smal", "smar", "smb3", "smit", "smt5", "soft", "sony",
                    "sp01", "sph-", "spv ", "spv-", "sy01", "symb", "t-mo", "t218", "t250",
                    "t600", "t610", "t618", "tagt", "talk", "tcl-", "tdg-", "teli", "telm",
                    "tim-", "topl", "tosh", "treo", "ts70", "tsm-", "tsm3", "tsm5", "tx-9",
                    "up.b", "upg1", "upsi", "utst", "v400", "v750", "veri", "virg", "vite",
                    "vk-v", "vk40", "vk50", "vk52", "vk53", "vm40", "voda", "vulc", "vx52",
                    "vx53", "vx60", "vx61", "vx70", "vx80", "vx81", "vx83", "vx85", "vx98",
                    "w3c ", "w3c-", "wap-", "wapa", "wapi", "wapj", "wapm", "wapp", "wapr",
                    "waps", "wapt", "wapu", "wapv", "wapy", "webc", "whit", "wig ", "winc",
                    "winw", "wmlb", "wonu", "x700", "xda-", "xda2", "xdag", "yas-", "your",
                    "zeto", "zte-"))) {
                return 4; // Мобильный браузер обнаружен по сигнатуре User Agent
            }

            return false; // Мобильный браузер не обнаружен
        }

        /**
         * Redirects url
         * @param type $redirects
         * @return boolean
         */
        function checkRedirect($redirects){
            if (empty($redirects)) return false;
            if ($redirects[$_SERVER['REQUEST_URI']])
                LocalRedirect("http://".$_SERVER['HTTP_HOST'].$redirects[$_SERVER['REQUEST_URI']], false, '301 Moved permanently');
        }

        public static function Dump($array, $type = 0, $name = 'dump'){
            if (!$type)
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/'.$name.'.txt', print_r($array, true));
            else{
                $f = fopen($_SERVER['DOCUMENT_ROOT'].'/'.$name.'_file.txt', 'a+');
                fwrite($f, date('d.m.Y H:i:s').print_r($array, true));
                fclose($f);
            }
        }
    }

	class BitrixNotFoundException extends \RuntimeException {
		public function __construct() {
			$this->message = 'Can not find Bitrix core';
		}
	}
