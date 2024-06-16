<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<form id="<?=$arParams['CONTAINER_ID']?>" class="header-top__item header-top__item-search" action="<?=$arResult["FORM_ACTION"] ?>">
    <input id="<?=$arParams['INPUT_ID']?>" type="text" placeholder="Поиск" name="q" value="">
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M5.66668 1.66667C4.60581 1.66667 3.5884 2.08809 2.83825 2.83824C2.0881 3.58838 1.66668 4.6058 1.66668 5.66667C1.66668 6.19195 1.77014 6.7121 1.97116 7.1974C2.17218 7.6827 2.46682 8.12366 2.83825 8.49509C3.20968 8.86653 3.65064 9.16117 4.13594 9.36219C4.62125 9.5632 5.14139 9.66667 5.66668 9.66667C6.19197 9.66667 6.71211 9.5632 7.19741 9.36219C7.68271 9.16117 8.12367 8.86653 8.4951 8.49509C8.86654 8.12366 9.16118 7.6827 9.3622 7.1974C9.56321 6.7121 9.66668 6.19195 9.66668 5.66667C9.66668 4.6058 9.24525 3.58838 8.4951 2.83824C7.74496 2.08809 6.72754 1.66667 5.66668 1.66667ZM1.89544 1.89543C2.89563 0.895236 4.25219 0.333333 5.66668 0.333333C7.08116 0.333333 8.43772 0.895236 9.43791 1.89543C10.4381 2.89562 11 4.25218 11 5.66667C11 6.36705 10.8621 7.06057 10.594 7.70765C10.4115 8.14837 10.171 8.56166 9.87974 8.93692L13.4714 12.5286C13.7318 12.7889 13.7318 13.2111 13.4714 13.4714C13.2111 13.7318 12.789 13.7318 12.5286 13.4714L8.93693 9.87973C8.56167 10.171 8.14838 10.4115 7.70766 10.594C7.06059 10.8621 6.36706 11 5.66668 11C4.96629 11 4.27277 10.8621 3.6257 10.594C2.97863 10.326 2.39069 9.93315 1.89544 9.4379C1.4002 8.94266 1.00734 8.35472 0.739319 7.70765C0.471294 7.06058 0.333344 6.36705 0.333344 5.66667C0.333344 4.25218 0.895247 2.89562 1.89544 1.89543Z"
              fill="white"/>
    </svg>
</form>
<?/*
<script>
    BX.ready(function () {
        new JCTitleSearch({
            'AJAX_PAGE': '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?=$arParams['CONTAINER_ID']?>',
            'INPUT_ID': '<?=$arParams['INPUT_ID']?>',
            'MIN_QUERY_LEN': 1
        });
    });
</script>*/?>
