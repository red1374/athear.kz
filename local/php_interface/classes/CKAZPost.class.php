<?php
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== TRUE)
		throw new BitrixNotFoundException();

	/**
	 * Class CKAZPost
	 *
	 * Used to work with post.kz service
	 *
	 */
	class CKAZPost {
        const CACHE_TIME            = 360000;

        const API_URL               = 'https://gateway.prod.kazpost.org/mail-app/api/public/find_dep';

        private $PVZ_IBLOCK_ID      = 0;

        private $arStat             = [];
        private $currentCity        = '';

        public function __construct($PVZ_IBLOCK_ID = 0) {
            $this->PVZ_IBLOCK_ID = $PVZ_IBLOCK_ID;
		}

        public function syncPostDeps() {
            $this->getPostDeps();

            return true;
        }

        /**
         * Getting KAZ Post departments
         * @return bool
         */
        private function getPostDeps(): bool {
            $arData     = [];
            if ($arCities   = $this->getKAZPostCitites()){
                foreach($arCities AS &$arCity){
                    if ($arData = $this->getPostDepsByCity($arCity['NAME'])){
                        $this->currentCity = $arCity['NAME'];
                        $this->processPostDeps($arData);
                    }
                }
            }

            return true;
        }

        /**
         * Getting KAZ Post cities with departments
         * @return array
         */
        private function getKAZPostCitites():array {
            return \Bitrix\Iblock\Elements\ElementCitiesTable::getList([
                'select'    => ['ID', 'NAME'],
                'filter'    => ['ACTIVE' => 'Y'],
            ])->fetchAll();
        }

        /**
         * Getting post departments by city name
         * @param string $cityName
         * @return array
         */
        private function getPostDepsByCity(string $cityName = ''):array {
            if (!$cityName){
                return false;
            }

            return $this->curl(self::API_URL, ['address' => $cityName], 443);
        }

        /**
         * Save or update information about KAZ Post departments
         * @param array $arData
         * @return bool
         */
        private function processPostDeps(array $arData = []): bool {
            if (empty($arData)){
                return false;
            }

            $arPVZ      = $this->getPVZLlist();
            $arPVZIDs   = array_map(fn($arItem): string => $arItem['CODE'], $arPVZ);

            $this->arStat[$this->currentCity] = [
                'TOTAL' => count($arData),
                'ADDED' => 0,
            ];
            foreach($arData AS &$arItem){
                if (!in_array($arItem->{'fp_id'}, $arPVZIDs)){
                    if ($arItem->{'type'} == 'dep'){
                        $this->addNewPVZ($this->prepareItem($arItem));
                    }
                }else{
                    // ToDo: Update existing PVZ
                }
            }

            return true;
        }

        /**
         * Getting stores PVZ items list
         * @return array
         */
        private function getPVZLlist(): array {
            return \Bitrix\Iblock\Elements\ElementPickUpTable::getList([
                'select' => ['ID', 'CODE'],
            ])->fetchAll();
        }

        /**
         * Adding new PVZ item
         * @param array $arItem - item data
         * @return integer
         */
        private function addNewPVZ($arItem):int {
            CModule::includeModule('iblock');

            $element = new CIblockElement();
            $arItem['IBLOCK_ID']    = $this->PVZ_IBLOCK_ID;
            $elementID = $element->add($arItem);

            if ($elementID){
                $this->arStat[$this->currentCity]['ADDED']++;
            }
            return $elementID;
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
                $userAgent  = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 YaBrowser/24.4.0.0 Safari/537.36";

                $header[] = "Accept: application/json, text/plain, */*";
                $header[] = "Referer: https://qazpost.kz/";
                $header[] = "Origin: https://qazpost.kz/";
                $header[] = "Accept-Language: ru,en;q=0.9";
                $header[] = 'Sec-Ch-Ua: "Chromium";v="122", "Not(A:Brand";v="24", "YaBrowser";v="24.4", "Yowser";v="2.5';
                $header[] = 'Sec-Ch-Ua-Platform: "Windows"';
                $header[] = 'Sec-Ch-Ua-Mobile: ?0';
                $header[] = 'Sec-Fetch-Dest: empty';
                $header[] = 'Sec-Fetch-Mode: cors';
                $header[] = 'Sec-Fetch-Site: cross-site';

                curl_setopt($tuCurl, CURLOPT_PORT, $port);

                if (!empty($json)){
                    $jsonStr = json_encode($json);
                    curl_setopt($tuCurl, CURLOPT_POST, true);
                    curl_setopt($tuCurl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                    curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($json));
                    $header[] = "Content-Length: ".strlen($jsonStr);
                }

                if ($port == 443){
                    curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
                }

                //curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($tuCurl, CURLOPT_ENCODING, 'gzip, deflate, br');
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

                return json_decode($tuData);

//                return [
//                    "error" => ($error ? TRUE : FALSE),
//                    "data"  => json_decode($tuData),
//                    "info"  => $info
//                ];
            }

            return [
                "error" => TRUE,
                "msg"   => "CURL not installed"
            ];
        }

        /**
         * Prepare data to be added/update item
         * @param stdObject $obItem
         * @return array
         */
        private function prepareItem(stdClass $obItem = null) {
            if (!$obItem){
                return null;
            }

            return [
                'NAME'  => self::clearObjectValue($obItem->{'name'}),
                'CODE'  => self::clearObjectValue($obItem->{'fp_id'}),
                'PREVIEW_TEXT'   => self::clearObjectValue($obItem->{'address'}),
                'DETAIL_TEXT'  => self::clearObjectValue($obItem->{'schedule'}),
                'PROPERTY_VALUES' => [
                    'INDEX'     => self::clearObjectValue($obItem->{'index'}),
                    'INDEX_NEW' => self::clearObjectValue($obItem->{'new_index'}),
                    'PHONE'     => self::clearObjectValue($obItem->{'phone'}),
                    'COORDS'    => join(',', [
                        self::clearObjectValue($obItem->{'latitude'}),
                        self::clearObjectValue($obItem->{'longitude'})
                    ]),
                ],
            ];
        }

        public static function clearObjectValue($value) {
            return str_replace('null', '', $value);
        }

        public function getStat() {
            if (!empty($this->arStat)){
                return $this->arStat;
            }

            return [];
        }
    }
