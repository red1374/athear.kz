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
    <div class="modal-wrap" id="modalAcceptFAQ">
        <div class="modal modal__accept">
            <img class="modal__accept-pic" src="<?=SITE_TEMPLATE_PATH ?>/images/check.svg" alt="">
            <h2 class="section-title"><?=GetMessage('CT_MODAL_Q_TITLE')?></h2>
            <p class="modal__text"><?=GetMessage('CT_MODAL_Q_TEXT')?></p>
        </div>
    </div>
<script>
    if (typeof(SC) != 'undefined'){SC.showModal('modalAcceptFAQ')}</script>
    <?}else{/*?>
    <div class="error_message"><?=join('<br />', $arResult['ERRORS'])?></div>
    <?php */}
    ?>
    <h2 class="aside-block__title"><?=GetMessage('CT_Q_TITLE')?></h2>
    <form class="aside-block__forms aside-block__forms--mode questions-form
          form__wrapper" name="q_iblock_add"
        action="<?=POST_FORM_ACTION_URI?>" novalidate method="post">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="PROPERTY[BX][0]" value="" />
        <?
            $has_error = isset($arResult['ERROR'][$arParams["CUSTOM_TITLE_NAME"]]);
        ?>
        <input name="PROPERTY[NAME][0]" class="input-default<?=($has_error ? ' error_input' : '')?>"
               type="text" placeholder="<?=GetMessage("FIELD_NAME").
                (in_array('NAME', $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"
                value="<?=$arResult['ELEMENT']['NAME']?>">
        <?
            $p_code     = 54;
            $has_error  = $arResult['ERROR'][$arResult['PROPERTY_LIST_FULL'][$p_code]['NAME']];
        ?>
        <input name="PROPERTY[<?=$p_code?>][0]" class="input-default<?=($has_error ? ' error_input' : '')?>"
            type="tel" placeholder="<?=GetMessage('FIELD_PHONE').
            (in_array($p_code, $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"
            value="<?=$arResult['ELEMENT_PROPERTIES'][$p_code][0]['VALUE']?>">
        <? 
            $has_error = isset($arResult['ERROR'][$arParams["CUSTOM_TITLE_CODE"]]);
        ?>
        <input name="PROPERTY[CODE][0]" class="input-default<?=($has_error ? ' error_input' : '')?>"
               type="text" placeholder="<?=GetMessage("FIELD_EMAIL").
                (in_array('EMAIL', $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"
                value="<?=$arResult['ELEMENT']['CODE']?>">
        <?
            $p_code     = 56;
            $has_error  = $arResult['ERROR'][$arResult['PROPERTY_LIST_FULL'][$p_code]['NAME']];
        ?>
        <textarea class="input-default<?=($has_error ? ' error_input' : '')?>" name="PROPERTY[<?=$p_code?>][0]"
            placeholder="<?=GetMessage('FIELD_TEXT').
            (in_array($p_code, $arResult['PROPERTY_REQUIRED']) ? ' *' : '')?>"><?=$arResult['ELEMENT_PROPERTIES'][$p_code][0]['VALUE']?></textarea>

        <p class="aside-block__agree"><?=GetMessage('HDR_AGREEMENT_LINK')?></p>
        <button class="btn btn--red btn--l btn--icn" type="submit"
            name="iblock_submit" value="Y">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.5 8L11.39 13.26C11.7187 13.4793 12.1049 13.5963 12.5 13.5963C12.8951 13.5963 13.2813 13.4793 13.61 13.26L21.5 8M5.5 19H19.5C20.0304 19 20.5391 18.7893 20.9142 18.4142C21.2893 18.0391 21.5 17.5304 21.5 17V7C21.5 6.46957 21.2893 5.96086 20.9142 5.58579C20.5391 5.21071 20.0304 5 19.5 5H5.5C4.96957 5 4.46086 5.21071 4.08579 5.58579C3.71071 5.96086 3.5 6.46957 3.5 7V17C3.5 17.5304 3.71071 18.0391 4.08579 18.4142C4.46086 18.7893 4.96957 19 5.5 19Z"
                      stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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