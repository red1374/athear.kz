<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("H1", "Слуховые аппараты");
$APPLICATION->SetTitle("Слуховой аппарат купить в Казахстане, цена на слуховые аппараты для слабослышащих");
$APPLICATION->SetPageProperty("description","Интернет-магазин лучших слуховых аппаратов и проверенных аксессуаров. В Центре слуха Audiotech продаются слуховые аппараты от ведущих производителей в Казахстане. Широкий выбор моделей устройств для слабослышащих по доступным ценам.");
?><?$APPLICATION->IncludeComponent(
	"coderoom:main.slider",
	".default",
[]
);?> <?$APPLICATION->IncludeComponent(
	"coderoom:main.solution",
	".default",
[]
);?> <section class="human-block human-block--mode human-block--doc1">
<div class="human-block__container">
	<div class="_container">
		<div class="human-block__wrap">
			<h2 class="section-title human-block__title"><?php $APPLICATION->IncludeFile("/include/human-title.php", [], ["MODE" => "html"]); ?></h2>
			<div class="human-block__descr">
				<?php $APPLICATION->IncludeFile("/include/human-descr.php", [], ["MODE" => "html"]); ?>
			</div>
 <a class="btn btn--red btn--icn btn--l" href="#" data-target="modal-reg">
			Записаться на приём</a>
		</div>
	</div>
</div>
 </section>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"popular",
	Array(
        "SHOW_H1" => "Y",
        "TITLE" => $APPLICATION->GetPageProperty('H1'),
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "popular",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:68\",\"DATA\":{\"logic\":\"Equal\",\"value\":33}},{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":15}}]}",
		"DETAIL_URL" => "/product/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(0=>"BREND",1=>"TIP_KORPUSA",2=>"STEPEN_POTERI_SLUKHA",3=>"MOSHCHNOST",4=>"CML2_MANUFACTURER",5=>"TIP_BATAREYKI",6=>"OSOBENNOSTI",7=>"BLUETOOTH",8=>"AKUSTICHESKIE_SITUATSII",),
		"LABEL_PROP_MOBILE" => array(0=>"BREND",1=>"TIP_KORPUSA",2=>"STEPEN_POTERI_SLUKHA",3=>"MOSHCHNOST",4=>"CML2_MANUFACTURER",5=>"TIP_BATAREYKI",6=>"OSOBENNOSTI",7=>"BLUETOOTH",8=>"AKUSTICHESKIE_SITUATSII",),
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"MESS_NOT_AVAILABLE_SERVICE" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "8",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(0=>"Розничная цена",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?> <?php //$APPLICATION->IncludeComponent(
//    'coderoom:main.brands',
//    '.default',
//    []
//); ?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"accessories",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "accessories",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":2}},{\"CLASS_ID\":\"CondIBProp:1:68\",\"DATA\":{\"logic\":\"Equal\",\"value\":33}}]}",
		"DETAIL_URL" => "/product/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(0=>"BREND",1=>"TIP_KORPUSA",2=>"STEPEN_POTERI_SLUKHA",3=>"MOSHCHNOST",4=>"CML2_MANUFACTURER",5=>"TIP_BATAREYKI",6=>"OSOBENNOSTI",7=>"BLUETOOTH",8=>"AKUSTICHESKIE_SITUATSII",),
		"LABEL_PROP_MOBILE" => array(0=>"BREND",1=>"TIP_KORPUSA",2=>"STEPEN_POTERI_SLUKHA",3=>"MOSHCHNOST",4=>"CML2_MANUFACTURER",5=>"TIP_BATAREYKI",6=>"OSOBENNOSTI",7=>"BLUETOOTH",8=>"AKUSTICHESKIE_SITUATSII",),
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"MESS_NOT_AVAILABLE_SERVICE" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "8",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(0=>"Розничная цена",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"1",2=>"",),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?> <section class="find-centers">
<div class="_container">
	<div class="find-centers__wrap">
		<div class="find-centers__box">
			 <?php $APPLICATION->IncludeFile("/include/centers-1.php", [], ["MODE" => "html"]); ?> <?php $APPLICATION->IncludeFile("/include/centers-2.php", [], ["MODE" => "html"]); ?> <?php $APPLICATION->IncludeFile("/include/centers-3.php", [], ["MODE" => "html"]); ?> <?php $APPLICATION->IncludeFile("/include/centers-4.php", [], ["MODE" => "html"]); ?>
		</div>
		<div class="find-centers__box">
			<h2 class="section-title find-centers__title"><?php $APPLICATION->IncludeFile("/include/centers-title.php", [], ["MODE" => "html"]); ?></h2>
			<p class="find-centers__text">
				<?php $APPLICATION->IncludeFile("/include/centers-descr.php", [], ["MODE" => "html"]); ?>
			</p>
 <a href="/centers/" class="btn btn--red btn--l btn--icn">
			Найти центр </a>
		</div>
	</div>
</div>
 </section>
<?$APPLICATION->IncludeComponent(
	"coderoom:main.offers",
	".default",
[],
false
);?>
<?$APPLICATION->IncludeComponent(
	"coderoom:news.slider",
	".default",
	Array(
		"ELEMENT_ID" => null,
		"IS_BLOG" => "Y",
		"SHOW_LINK" => "Y",
		"TITLE" => "Блог"
	)
);?><?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>