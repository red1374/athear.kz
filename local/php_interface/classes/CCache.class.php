<?php
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
		die();

	/**
	 * Class CCache
	 *
	 * Used for get cached data
	 *
	 */
	class CCache {
        const CACHE_HALF_DAY        = 21600;    // half a day
        const CACHE_TIME            = 360000;   // ~ 4 days
        const CACHE_LONG_TIME       = 604800;   // 7 days

        /** @var $app \CMain */
		private $app                = NULL;

        /** @var $instance CCache */
		private static $instance = NULL;

        private function __construct(\CMain $app) {
            $this->app      = $app;
            $this->curPage  = $app->GetCurPage();
            $this->curDir   = $app->GetCurDir();
		}

		/**
		 * Singletone implementation
		 *
		 * @return CCache
		 */
		public static function Instance() {
			if (!is_object(CCache::$instance))
				CCache::$instance = new CCache($GLOBALS['APPLICATION']);

			return CCache::$instance;
		}

        /**
         * Get cached catalog sections array
         * @param integer $iblock_ID - iblock id
         * @return boolean|array
         */
        public static function getCatalogSections($iblock_ID = 0) {
            $arResult = [];

            if (!$iblock_ID)
                return FALSE;

            $cache = new CPHPCache();
            $cache_id = 'IBLOCK_SECTIONS'.$iblock_ID;
            if ($cache->InitCache(self::CACHE_TIME, $cache_id, "/")){
                $res = $cache->GetVars();
                if (is_array($res["arSections"]) && (count($res["arSections"]) > 0))
                   $arResult = $res["arSections"];
            }

            if (empty($arResult)){
                \Bitrix\Main\Loader::includeModule('iblock');

                $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($iblock_ID);
                $resItems = $entity::getList([
                    'select' => [
                        'ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID', 'DESCRIPTION', 'SORT',
                        'PICTURE', 'UF_*', 'SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
                        'DEPTH_LEVEL'
                    ],
                    'filter' => [
                        'ACTIVE'    => 'Y',
                        'IBLOCK_ID' => $iblock_ID
                    ],

                    'runtime' => [
                        'SECTION_SECTION' => [
                            'data_type' => '\Bitrix\Iblock\SectionTable',
                            'reference' => [
                                '=this.IBLOCK_ID' => 'ref.IBLOCK_ID',
                                '>=this.LEFT_MARGIN' => 'ref.LEFT_MARGIN',
                                '<=this.RIGHT_MARGIN' => 'ref.RIGHT_MARGIN',
                            ],
                            'join_type' => 'inner'
                        ],
                    ],
                    'order' => [
                        'SORT'  => 'ASC'
                    ]
                ]);

                $arUFValues = self::getUFValues();
                while($arItem = $resItems->fetch()){
                    $arItem['SECTION_PAGE_URL'] = CIBlock::ReplaceDetailUrl($arItem['SECTION_PAGE_URL'], $arItem, false, 'S');

                    foreach($arItem AS $code => &$value){
                        // -- Replace ids for user values to XML_ID --------- //
                        if (preg_match('/UF_/msi', $code) && $arUFValues[$code]){
                            if (is_array($value)){
                                foreach($value AS $k => $item_value){
                                    if ($arUFValues[$code][$item_value]){
                                        $value[$k] = $arUFValues[$code][$item_value]['XML_ID'];
                                    }
                                }
                            }else{
                                $value = $arUFValues[$code][$value]['XML_ID'];
                            }
                        }
                    }
                    $arResult[$arItem['ID']]  = $arItem;
                }

                $cache->StartDataCache(self::CACHE_TIME, $cache_id, "/");
                $cache->EndDataCache(array("arSections" => $arResult));
            }

            return $arResult;
        }

        /**
         * Get cached catalog elements array
         * @param integer $iblock_ID - iblock id
         * @return boolean|array
         */
        public static function getCatalogItems($iblock_ID = 0, $arSelect = []) {
            $arResult = [];

            if (!$iblock_ID)
                return FALSE;

            $cache = new CPHPCache();
            $cache_id = 'IBLOCK_ELEMENTS'.$iblock_ID.md5(serialize($arSelect));
            if ($cache->InitCache(self::CACHE_TIME, $cache_id, "/")){
                $res = $cache->GetVars();
                if (is_array($res["arElements"]) && (count($res["arElements"]) > 0))
                   $arResult = $res["arElements"];
            }

            if (empty($arResult)){
                \Bitrix\Main\Loader::includeModule('iblock');

                $entity = \Bitrix\Iblock\ElementTable::getEntity();
                $query  = new \Bitrix\Main\Entity\Query($entity);
                $arBaseSelect = [
                    'ID', 'NAME', 'IBLOCK_ID', 'CODE', 'IBLOCK_SECTION_ID',
                    'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL', 'SORT'
                ];
                if (!empty($arSelect)){
                    $arBaseSelect = array_merge($arBaseSelect, $arSelect);
                }
                $query->setSelect($arBaseSelect)->setFilter([
                    'ACTIVE'    => 'Y',
                    'IBLOCK_ID' => $iblock_ID
                ])->setOrder([
                    'SORT'  => 'ASC'
                ]);
                $resItems = $query->exec();
                while($arItem = $resItems->fetch()){
                    $arItem['DETAIL_PAGE_URL']  = CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'], $arItem, false, 'E');
                    $arResult[$arItem['ID']]    = $arItem;
                }

                $cache->StartDataCache(self::CACHE_TIME, $cache_id, "/");
                $cache->EndDataCache(["arElements" => $arResult]);
            }

            return $arResult;
        }

        /**
         * Get user fields enum values by UF names
         * @return array
         */
        private static function getUFValues(){
            $arResult   = [];
            $arResult= [];

            $res = CUserTypeEntity::GetList([], []);
            while($arItem = $res->fetch()){
                $arPropNames[$arItem['ID']] = $arItem['XML_ID'];
            }

            $arFilter   = [
                //'USER_FIELD_ID' => 42
            ];
            $res = CUserFieldEnum::GetList([], $arFilter);

            while($arItem = $res->fetch()){
                if ($arPropNames[$arItem['USER_FIELD_ID']] && $arItem['USER_FIELD_ID']){
                    $arResult[$arPropNames[$arItem['USER_FIELD_ID']]][$arItem['ID']] = [
                        'ID'    => $arItem['ID'],
                        'VALUE' => $arItem['VALUE'],
                        'XML_ID'=> $arItem['XML_ID']
                    ];
                }
            }
            return $arResult;
        }

        /**
         * Get cached values by code
         * @param string $cache_id  - code for cahed values
         * @return boolean|array
         */
        public static function getByCode($cache_id, $dirname = '/'){
            if (!$cache_id)
                return false;

            $arResult   = [];
            $cache      = new CPHPCache();

            if ($cache->InitCache(self::CACHE_LONG_TIME, $cache_id, $dirname)){
                $res = $cache->GetVars();

                if (is_array($res["arResult"]) && (count($res["arResult"]) > 0))
                   $arResult = $res["arResult"];
            }

            return $arResult;
        }

        /**
         * Start taged cache
         * @global object $CACHE_MANAGER
         * @param string $dir       - cache dir
         * @param string $tag_name  - chache tag
         * @return boolean
         */
        public function startTagedCache($dir, $tag_name){
            global $CACHE_MANAGER;

            if (!$dir || !$tag_name)
                return false;

            $CACHE_MANAGER->StartTagCache($dir);
            $CACHE_MANAGER->RegisterTag($tag_name);
        }

        /**
         * Cleare cache with tag $tag_name
         * @global object $CACHE_MANAGER
         * @param string $tag_name  - cache tag name
         * @return boolean
         */
        public function clearTagedCache($tag_name) {
            global $CACHE_MANAGER;
            if (!$tag_name)
                return false;

            $CACHE_MANAGER->ClearByTag($tag_name);
        }
        /**
         * Save data to cache with tag $cache_id
         * @param array $arResult   - array with adata to save
         * @param string $cache_id  - cache tag name
         * @param string $is_taged  - flag to close taged cache
         * @return boolean
         */
        public static function saveWithCode($arResult, $cache_id, $dirname = '/', $cache_time = 0, $is_taged = false){
            global $CACHE_MANAGER;

            if (!$cache_id || empty($arResult))
                return false;

            $cache_time = $cache_time ? $cache_time : self::CACHE_LONG_TIME;
            $cache  = new CPHPCache();
            $cache->StartDataCache($cache_time, $cache_id, $dirname);

            if ($is_taged){
                $CACHE_MANAGER->EndTagCache();
            }
            $cache->EndDataCache(array("arResult" => $arResult));

            return true;
        }
    }
