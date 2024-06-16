<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
    $this->setFrameMode(false);

    $component_id = md5(serialize($arParams));
    $is_success = FALSE;
    if (empty($arResult['ERRORS']) && $arResult['MESSAGE']){
        $is_success = TRUE;?>
    <div class="modal-wrap" id="modalAcceptSubscribeAside">
        <div class="modal modal__accept">
            <img class="modal__accept-pic" src="<?=SITE_TEMPLATE_PATH ?>/images/check.svg" alt="">
            <h2 class="section-title"><?=GetMessage('CT_MODAL_TITLE')?></h2>
            <p class="modal__text"><?=GetMessage('CT_MODAL_TEXT')?></p>
        </div>
    </div>
<script>
    if (typeof(SC) != 'undefined'){
        SC.showModal('modalAcceptSubscribeAside');
    }</script>
    <?}else{/*?>
    <div class="error_message"><?=join('<br />', $arResult['ERRORS'])?></div>
    <?php */}
        $has_error = !empty($arResult['ERRORS']);
    ?>
    <form class="form__wrapper" name="iblock_add"
        action="<?=POST_FORM_ACTION_URI?>" novalidate method="post">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="PROPERTY[BX][0]" value="" />
        <h2 class="aside-block__title"><?=GetMessage('CT_SUBSCRIBE_TITLE')?></h2>
        <div class="input__overlay">
            <input class="input-default<?=($has_error ? ' error_input' : '')?>" name="PROPERTY[NAME][0]"
                   type="text" placeholder="<?=GetMessage("FIELD_NAME").
                    (in_array('NAME', $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"
                    value="<?=$arResult['ELEMENT']['NAME']?>">
        </div>
        <input name="PROPERTY[CODE][0]" type="hidden" value="email">
        <p class="aside-block__agree"><?=GetMessage('HDR_AGREEMENT_LINK')?></p>
        <button class="btn btn--red btn--l btn--icn" type="submit" name="iblock_submit"
                value="Y">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                <path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z"
                          stroke="white" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
            </svg>
            <span><?=GetMessage("IBLOCK_FORM_SUBMIT")?></span>
        </button>
    </form>
    <?php
        /*$isCheked   = TRUE;
        if (!isset($_POST['agreement']) && isset($_POST['iblock_submit']))
            $isCheked   = FALSE;
        $has_error = isset($arResult['ERROR']['AGREEMENT']);
    ?>
    <div class="clearfix"></div>
    <div class="form_checkbox<?=($has_error ? ' error_input' : '')?>">
        <label class="label_checkbox">
            <input type="checkbox" class="checkbox-custom js-agree"
                   value="Y" name="agreement"<?=($isCheked ? ' checked="checked"' : "")?> />
            <?=GetMessage('USER_AGREEMENT',["#LINK#" => SITE_DIR.'private-policy/'])?>
        </label>
    </div>

                <?php if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
                <div class="form_i">
                    <label><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></label>
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    <input type="text" name="captcha_word" maxlength="50" value="" />
                </div>
                <?php endif?>
*/?>
    <?php /*if ($is_success):?>
    <div class="mf-ok-text"><?=GetMessage('FORM_SUCCESS_MESSAGE')?></div>
    <?/*<script>
        BX.ready(function(){
            BX.message({FORM_SUCCESS_TITLE:'<?=GetMessage("FORM_SUCCESS_TITLE")?>'});
            BX.message({FORM_SUCCESS_MESSAGE:'<?=GetMessage("FORM_SUCCESS_MESSAGE", ['#ID#' => $arResult['RESULT_ID']])?>'});
            Form.showSuccessPopup();
        });
    </script>*//*?>
    <?php endif;*/?>
    <script>
        var _form_script = BX.create(
            'script',
            {
                'attrs' : {
                    'src'   : '<?=$templateFolder.'/form_script.js?V=2'?>',
                    'id'    : 'form_<?=$component_id?>'
                }
            }
        );

        if (!BX('form_<?=$component_id?>')){
            BX.insertAfter(_form_script, document.querySelector('body'));
        }
    </script>