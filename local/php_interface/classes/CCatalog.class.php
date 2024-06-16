<?php
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== TRUE)
		throw new BitrixNotFoundException();

    use Bitrix\Sale;

	/**
	 * Class CCustomCatalog
	 *
	 * Used to work with catalog
	 *
	 */
	class CCustomCatalog {
        const CACHE_TIME            = 360000;
        const FILTER_NAME           = 'arCatalogFilter';

        /** @var $instance CCustomCatalog */
		private static $instance = NULL;

        private function __construct() {
		}

		/**
		 * Singletone implementation
		 *
		 * @return CCustomCatalog
		 */
		public static function Instance() {
			if (!is_object(CCustomCatalog::$instance))
				CCustomCatalog::$instance = new CCustomCatalog();

			return CCustomCatalog::$instance;
		}

        /**
         * Count active filter params
         * @return int
         */
        public static function countActiveFilterParameters(){
            if (empty($_GET)){
                return 0;
            }

            $count = 0;
            foreach($_GET AS $key => &$value){
                if (preg_match('/'.self::FILTER_NAME.'_(\d+)_(\d+)/msi', $key)){
                    $count++;
                }
            }

            if ((int)$_GET[self::FILTER_NAME.'_P1_MIN'] > 0 || (int)$_GET[self::FILTER_NAME.'_P1_MAX'] > 0){
                $count++;
            }

            return $count;
        }

        /**
         * Get product data
         * @param array $arAddFilter    - query params array
         * @param array $arAddSelect    - select fields array
         * @return boolean|array
         */
        public static function getProductsData($arAddFilter = [],$arAddSelect = []){
            if (empty($arAddFilter)){
                return false;
            }

            \Bitrix\Main\Loader::IncludeModule("iblock");
            // -- Get products list for given products direction ------------ //
            $arSelect   = [
                'ID', 'IBLOCK_SECTION_ID', 'NAME', 'CODE'
            ];
//            $arFilter   = [
//                'ACTIVE'    => 'Y',
//            ];
            if (!empty($arAddSelect)){
                $arSelect = array_merge($arSelect, $arAddSelect);
            }
//            $arFilter = array_merge($arFilter, $arAddFilter);
            $arFilter = $arAddFilter;

            $entityClass = "\Bitrix\Iblock\Elements\ElementCatalogTable";

            $result = $entityClass::getList([
                'select'=> $arSelect,
                'filter'=> $arFilter
            ]);

            if ($arProducts = $result->fetchAll()){
                // -- Fill in DETAIL_PAGE_URL field ------------------------- //
                foreach($arProducts AS &$arItem){
                    if (isset($arSelect['DETAIL_PAGE_URL'])){
                        $arItem['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'], $arItem, false, 'E');
                    }
                    $arResult[$arItem['ID']] = $arItem;
                }
                return $arResult;
            }
            return false;
        }

        /**
         * Add product to basket
         * @return array
         */
        public static function addToBasket() {
            $product_id = (int)$_POST["id"];
            $qty = (int)$_POST["qty"];

            if (!$product_id){
                return [
                    'status'=> 'error',
                    'msg'   => 'EMPTY_DATA'
                ];
            }
            Bitrix\Main\Loader::includeModule("catalog");

            $fields = [
                'PRODUCT_ID'=> $product_id, // ID товара, обязательно
                'QUANTITY'  => $qty ? $qty : 1, // количество, обязательно
                /*'PROPS' => [
                    ['NAME' => 'Test prop', 'CODE' => 'TEST_PROP', 'VALUE' => 'test value'],
                ],*/

            ];
            $result = Bitrix\Catalog\Product\Basket::addProduct($fields);
            if (!$result->isSuccess()) {
                return [
                    'status'=> 'error',
                    'msg'   => $result->getErrorMessages()
                ];
            }

            return [
                'status'    => 'success',
                'product_id'=> $product_id
            ];
        }

        /**
         * Get current user basket items
         * @return array
         */
        public static function getBasketItems() {
            $arResult   = [];

            $basket     = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
            $basketItems = $basket->getBasketItems();
            if (!empty($basketItems)){
                foreach($basketItems AS &$item){
                    $arResult[$item->getProductId()] = [
                        'PRICE' => $item->getPrice(),
                        'QUANTITY'  => $item->getQuantity(),
                        'PRODUCT_ID'=> $item->getProductId()
                    ];
                }
            }

            return $arResult;
        }

        /**
         * Get catalog menu generated from tags section
         * @return array
         */
        public static function getCatalogMenu() {
            $arResult = [];

            $arResult = CCache::getCatalogSections(CClass::CATALOG_TAGS_IBLOCK_ID);
            if ($arItems = CCache::getCatalogItems(CClass::CATALOG_TAGS_IBLOCK_ID)){
                foreach($arItems AS &$arItem){
                    if (isset($arResult[$arItem['IBLOCK_SECTION_ID']])){
                        $arResult[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = [
                            'NAME'  => $arItem['NAME'],
                            'LINK'  => $arItem['CODE'],
                        ];
                    }
                }
            }

            return $arResult;
        }

        public function getFavorites(){
            $arIDS = trim($_COOKIE['DION_FAVORITE']) ? explode(',', $_COOKIE['DION_FAVORITE']) : [];

            return $arIDS;
        }

        public static function getSaleGoodsIDs() {
            $arResult = [];
            $cache = new CPHPCache();
            $cache_id = 'IBLOCK_SALE_GOODS';
            if ($cache->InitCache(CCache::CACHE_TIME, $cache_id, "/sale_ids/")){
                $res = $cache->GetVars();
                if (is_array($res["arIDs"]) && (count($res["arIDs"]) > 0))
                   $arResult = $res["arIDs"];
            }

            if (empty($arResult)){
                Bitrix\Main\Loader::includeModule("iblock");
                Bitrix\Main\Loader::includeModule("catalog");

                //все пользователи
                $saleGroups = [2];
                $prices     = [1];

                $arFParams = [
                    'select' => ['ID'],
                    'filter' => ['ACTIVE' => 'Y']
                ];
                $res = \Bitrix\Iblock\Elements\ElementCatalogTable::getList($arFParams);
                while($arElement = $res->Fetch()){
                    $arDiscounts = CCatalogDiscount::GetDiscountByProduct(
                       $arElement['ID'],
                       $saleGroups,
                       "N",
                       $prices,
                       's1'
                    );

                    if (is_array($arDiscounts) && count($arDiscounts) > 0){
                        $arResult[] = $arElement['ID'];
                    }
                }

                $cache->StartDataCache(CCache::CACHE_TIME, $cache_id, "/");
                $cache->EndDataCache(["arIDs" => $arResult]);
            }

            return $arResult;
        }

// -- Catalog tags methods -------------------------------------------------- //
        public static function checkForTags() {
            // -- Get tag from url ------------------------------------------ //
            $arURLParams = self::getParamsFromURL();
            if (!$arURLParams){
                return false;
            }

            // -- Get section id by unique section code --------------------- //
//            $arSection = CClass::getSectionByCode($arURLParams['SECTION'], CClass::CATALOG_IBLOCK_ID);
//            if (empty($arSection)){
//                return false;
//            }

            // -- Get tag page data --------------------------------------- //
            $arTagData = self::getTagData($arURLParams['TAG'], NULL, [
                'SECTION',
                'PRODUCT_PROPS.ITEM',
                'FILTER',
                'PRODUCTS.ELEMENT'
            ]);
            if (empty($arTagData)){
                return false;
            }

            // -- Update url params ----------------------------------------- //
            self::setRequestParams($arURLParams, $arTagData);

            // -- Set complex catalog component filter params --------------- //
            if ($arTagData['PROPS']['PRODUCT_PROPS']){
                self::setComponentFilterParams($arTagData['PROPS']['PRODUCT_PROPS']);
            }

            if ($arTagData['PROPS']['PRODUCTS']){
                self::setComponentFilterValues('ID', $arTagData['PROPS']['PRODUCTS']);
            }
        }

        /**
         * Get params from query string
         * @global object $APPLICATION  - CMain object
         * @return boolean|array
         */
        private static function getParamsFromURL(){
            global $APPLICATION;

            if (isset($_GET['TAG'])){
                $arParts = self::getURLParts($_SERVER['REQUEST_URI']);
                return [
                    'TAG'   => $_GET['TAG'],
                    'SECTION' => $arParts[count($arParts) - 1],
                    'URL'   => '/'.join('/', $arParts).'/'
                ];
            }
            $arParts = self::getURLParts($APPLICATION->GetCurDir());

            if (count($arParts) < 2){
                return false;
            }

            return [
                'TAG'   => $arParts[count($arParts) - 1],
                'SECTION' => $arParts[count($arParts) - 2],
                'URL'   => '/'.join('/', array_slice($arParts, 0, count($arParts) - 1)).'/'
            ];
        }

        private static function getURLParts($url) {
            if (!$url){
                return [];
            }

            $url = strpos($url, '?') ? substr($url, 0, strpos($url, '?')) : $url;
            return explode('/', trim($url, '/'));
        }

        /**
         * Getting tag information
         * @param string $tag_name      - catalog section tag name
         * @param string $section_id    - section code
         * @param array $arProps        - props to select
         * @param array $arSelect       - select fields arrray
         * @return boolean|array
         */

        public static function getTagData($tag_name, $section_id = 0, $arProps = [], $arSelect = []){
            if (empty($tag_name)){
                return false;
            }

            $arTag  = [];
            $cache  = new CPHPCache();
            $cache_id = 'CATALOG_TAG_'.strtoupper($tag_name)."_".$section_id."_".count($arProps);
            if ($cache->InitCache(CCache::CACHE_TIME, $cache_id, "/catalog_tags/")){
                $res = $cache->GetVars();
                if (is_array($res["arTag"]) && (count($res["arTag"]) > 0))
                   $arTag = $res["arTag"];
            }

            if (empty($arTag)){
                $arFilter = [
                    'ACTIVE' => 'Y', 'CODE' => $tag_name,
                ];
                if ((int)$section_id){
                    $arFilter[] = ['SECTION.VALUE' => $section_id];
                }
                $arSelect = !empty($arSelect) ? $arSelect : [
                    'ID', 'NAME', 'CODE'];

                \Bitrix\Main\Loader::IncludeModule("iblock");
                $arFParams = [
                    'select' => !empty($arProps) ? array_merge($arSelect, $arProps) : $arSelect,
                    'filter' => $arFilter
                ];

                $res = \Bitrix\Iblock\Elements\ElementCtagsTable::getList($arFParams);
                if ($obItem = $res->fetchObject()){
                    $arItem['FIELDS']   = self::getFields($obItem, $arSelect);
                    $arItem['PROPS']    = self::getProperties($obItem, $arProps);

                    $cache->StartDataCache(CCache::CACHE_TIME, $cache_id, "/catalog_tags/");
                    $cache->EndDataCache(["arTag" => $arItem]);
                    return $arItem;
                }
            }else{
                return $arTag;
            }

            return false;
        }

        /**
         * Get object fields by code
         * @param object $obItem    - element object
         * @param array $arFields   - fields codes array
         * @return boolean|array
         */
        private static function getFields($obItem = null, $arFields = []) {
            if (!$obItem || empty($arFields)){
                return false;
            }

            $arResult = [];
            foreach($arFields AS &$code){
                $arResult[$code] = $obItem->get($code);
            }

            return $arResult;
        }

        private static function getProperties($obItem = null, $arProps = []) {
            if (!$obItem || empty($arProps)){
                return false;
            }

            $arResult = [];
            $arCProps = self::getCamelCaseProps($arProps);
            foreach($arCProps AS $key => &$prop){
                $code = "get".$prop['VALUE'];
                if ($obItem->$code()){
                    try{
                        $arResult[$key] = $obItem->$code()->getValue();
                    }catch (Exception $e){
                        $get_code   = 'getItem';
                        $get_value  = 'getValue';
                        if ($prop['TYPE']){
                            $get_code = 'get'.ucfirst(strtolower($prop['TYPE']));
                            if ($prop['TYPE'] == 'ELEMENT'){
                                $get_value = 'getName';
                            }
                        }
                        foreach($obItem->$code()->getAll() AS &$value){
                            $arResult[$key][] = [
                                'VALUE'     => $value->$get_code()->getId(),
                                'XML_ID'    => $value->$get_code()->getXmlId(),
                                'TEXT'      => $value->$get_code()->$get_value(),
                            ];
                        }
                    }
                }
            }

            return $arResult;
        }

        /**
        * Get camel case props
        * @param array $arProps    - props array
        * @return boolean|array
        */
        private static function getCamelCaseProps($arProps){
            if (empty($arProps)){
                return false;
            }

            $arResult   = [];
            $arTmp      = [];
            foreach($arProps AS &$prop){
                $type = '';
                if (preg_match('/\./s', $prop)){
                    $type = substr($prop, strpos($prop, '.') + 1);
                    $prop = str_replace(['.ITEM', '.ELEMENT'], '', $prop);
                }
                $arTmp = explode('_', $prop);
                foreach($arTmp AS &$item){
                    $item = ucfirst(strtolower($item));
                }
                $arResult[$prop]= [
                    'VALUE' => join('', $arTmp),
                    'TYPE'  => $type,
                ];
            }

            return $arResult;
        }

        /**
         * Prepare request params to setup a new one
         * @param array $arURLParams    - new URL params
         * @param array $arTAGData      - tag data
         * @return boolean|array
         */
        private static function setRequestParams($arURLParams = [], $arTAGData = []){
            if (empty($arURLParams) || empty($arTAGData)){
                return false;
            }
            $filter_with_get_params =  preg_match('/=/msi', $arTAGData['PROPS']['FILTER']);

            // -- Clear get parameters form tag data ------------------------ //
            $request_uri = str_replace("/{$arURLParams['TAG']}/", "/", $_SERVER['REQUEST_URI']);
            if ($pos = strpos($request_uri, '?')){
                $request_uri =  substr($request_uri, 0, $pos);
            }
            $request_query_string = preg_replace('/TAG='.$arURLParams['TAG'].'/msi', '', $_SERVER['QUERY_STRING']);

            if ($arTAGData['PROPS']['FILTER']){
                if ($filter_with_get_params){
                    $request_query_string   = str_replace($arTAGData['PROPS']['FILTER'], '', $request_query_string);
                }else{
                    $request_uri .= (!preg_match('/filter/msi', $arTAGData['PROPS']['FILTER']) ? 'filter/' : '');
                    $request_uri .= $arTAGData['PROPS']['FILTER'];
                }
            }
            $request_query_string   = trim(preg_replace('/&+/msi', '&', $request_query_string), '&');

            // -- Add tag data to query string ------------------------------ //
            $request_query_string .= ($request_query_string ? '&' : '').'TAG='.$arURLParams['TAG'];
            if ($arTAGData['PROPS']['FILTER'] && $filter_with_get_params){
                $request_query_string   .= ($request_query_string ? '&': '').$arTAGData['PROPS']['FILTER'];
            }

            $request_query_string   = str_replace(['&?', '?&', '&amp;?', '?&amp;'], '&', $request_query_string);
            $request_uri .= (preg_match('/\?/msi', $request_uri) ? '&': '?').$request_query_string;

            CClass::setRequestParams([
                'REQUEST_URI'   => str_replace('//', '/', $request_uri),
                'QUERY_STRING'  => $request_query_string
            ]);
        }

        private static function setComponentFilterParams($arParams) {
            if (empty($arParams)){
                return false;
            }

            $arrFilter = &$GLOBALS[self::FILTER_NAME];
            $arProps = [];
            foreach($arParams AS $key => &$arValue){
                $arProps["PROPERTY_{$arValue['XML_ID']}_VALUE"] = 'да';
            }

            if (count($arProps) > 1){
                $arrFilter[] = array_merge(["LOGIC" => "OR"], $arProps);
            }else{
                $arrFilter = !empty($arrFilter) ? array_merge($arrFilter, $arProps) : $arProps;
            }
        }

        private static function setComponentFilterValues(string $key = '', array $arParams = []): void {
            if (empty($arParams) || !$key){
                return ;
            }

            $arrFilter = &$GLOBALS[self::FILTER_NAME];
            $arProps = [];
            foreach($arParams AS &$arValue){
                $arrFilter[$key][] = isset($arValue['VALUE']) ? $arValue['VALUE'] : $arValue;
            }
            CClass::Dump($arrFilter);
        }
   }
