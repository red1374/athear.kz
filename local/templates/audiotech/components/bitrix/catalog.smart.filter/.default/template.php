<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$clearFilterPath = preg_replace('/(filter.+)/', '', $arResult['SEF_DEL_FILTER_URL']);

/** @var $arResult array */

$isShowFilter = false;
$isActiveFilter = false;
foreach ($arResult['ITEMS'] AS &$arItem) {
    if (!empty($arItem['VALUES']) && $arItem['ID'] != 1) $isShowFilter = true;
    foreach ($arItem['VALUES'] AS &$value) {
        if ($value['CHECKED'] == 1) $isActiveFilter = true;
    }
}?>
<form id="form-filter" class="catalog__filter filter">
    <?php if ($isShowFilter) { ?>
        <div class="close-filter">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                      fill="#131313"/>
            </svg>
        </div>
        <div class="filter__title">Фильтры</div>
        <? foreach ($arResult['ITEMS'] AS &$arItem) {
            if ($arItem['DISPLAY_TYPE'] == 'F') {
                include 'check.php';
            } else if ($arItem['DISPLAY_TYPE'] == 'K') {
                include 'radio.php';
            }
        }?>
        <button class="btn btn--red btn--m filter-btn" style="display: none;">
            Применить фильтр
        </button>
        <a href="<?php echo $clearFilterPath; ?>" class="btn btn--grey btn--m btn--icn btn--close clear-filter"
           style="display: <?php echo $isActiveFilter ? 'flex' : 'none'; ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                      fill="#131313"/>
            </svg>
            Очистить фильтр
        </a>
    <?php } ?>
</form>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        window.filter = new window.SmartFilter("<?php echo $APPLICATION->GetCurPageParam(); ?>");
    });
</script>