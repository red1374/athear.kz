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
    <div class="modal-wrap" id="modalAcceptSubscribe">
        <div class="modal modal__accept">
            <img class="modal__accept-pic" src="<?=SITE_TEMPLATE_PATH ?>/images/check.svg" alt="">
            <h2 class="section-title"><?=GetMessage('CT_MODAL_TITLE')?></h2>
            <p class="modal__text"><?=GetMessage('CT_MODAL_TEXT')?></p>
        </div>
    </div>
<script>
    if (typeof(SC) != 'undefined'){SC.showModal('modalAcceptSubscribe')}</script>
    <?}else{/*?>
    <div class="error_message"><?=join('<br />', $arResult['ERRORS'])?></div>
    <?php */}
        $has_error = !empty($arResult['ERRORS']);
    ?>
    <form class="footer-form__box email_form form__wrapper <?=($has_error ? ' error_input' : '')?>" name="iblock_add"
        action="<?=POST_FORM_ACTION_URI?>" novalidate method="post">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="PROPERTY[BX][0]" value="" />

        <input name="PROPERTY[NAME][0]"
               type="text" placeholder="<?=GetMessage("FIELD_NAME").
                (in_array('NAME', $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"
                value="<?=$arResult['ELEMENT']['NAME']?>">
        <input name="PROPERTY[CODE][0]" type="hidden" value="email">
        <div class="footer-form__btn">
            <button class="btn btn--m btn--red" type="submit" name="iblock_submit"
                    value="Y"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>
        </div>
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