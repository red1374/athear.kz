<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


$dateCreate = CIBlockFormatProperties::DateFormat(
    'j M Y',
    MakeTimeStamp(
        $arResult["TIMESTAMP_X"],
        CSite::GetDateFormat()
    )
);
?>
<section class="news-page">
    <div class="_container">
        <div class="news-page__head">
            <h1 class="title-page news-page__title"> <span class="title-page__text"><?php echo $arResult["NAME"]; ?></span></h1>
            <div class="news-page__date"><?php echo $dateCreate; ?></div>
        </div>
        <div class="__container-2cols">
            <div class="news-page__col news-page__content">
                <div class="news-page__block">
                    <div class="news-page__media"><img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="<?php echo $arResult["NAME"]; ?>"></div>
                </div>
                <div class="news-page__block">
                    <div class="__container-s">
                        <?php echo html_entity_decode($arResult["DETAIL_TEXT"]); ?>
                    </div>
                </div>
                <?php if ($arResult['CATALOG_ITEMS']) { ?>
                    <section class="news-page__block news-page__block--slider">
                        <h2 class="section-title"> <span>Аналоговые слуховые аппараты</span><a href="/catalog/" class="btn btn--grey btn--m">Смотреть все</a></h2>
                        <div class="swiper swiper-three-news pr30_m">
                            <div class="swiper-wrapper">
                                <?php foreach ($arResult['CATALOG_ITEMS'] as $arItem) { ?>
                                    <div class="swiper-slide">
                                        <div class="card">
                                            <a class="card__pic" href="/catalog/<?php echo $arItem['CODE']; ?>/"><img src="<?php echo $arItem['PREVIEW_PICTURE'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/images/no-photo.png'; ?>" alt="<?php echo $arItem['NAME']; ?>"></a>
                                            <a class="card__name" href="/catalog/<?php echo $arItem['CODE']; ?>/"><?php echo $arItem['NAME']; ?></a>
                                            <div class="card__footer">
                                                <div class="card__price card__price--actual"><?php echo $arItem['PRICE']; ?> ₽</div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                <?php } ?>
<!--                <div class="__container-s">-->
<!--                    <div class="news-page__block">-->
<!--                        <p>Vestibulum augue enim, scelerisque ac gravida ut, sodales non lectus. Nunc non pretium eros. Duis ligula nisi, venenatis in dignissim et, pellentesque in enim. Mauris facilisis, eros a condimentum vehicula, ex eros tincidunt massa, at mattis turpis nibh in erat. Donec vehicula eros quis imperdiet pharetra. Suspendisse vehicula eros ac lacus molestie, id molestie lacus tincidunt. Fusce non arcu tempus odio convallis posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc non enim sed lacus tincidunt euismod. Quisque consequat massa urna, sed tincidunt urna faucibus sit amet.</p>-->
<!--                        <div class="quote">-->
<!--                            <p>Donec vehicula eros quis imperdiet pharetra. Suspendisse vehicula eros ac lacus molestie, id molestie lacus tincidunt. Fusce non arcu tempus odio convallis posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc non enim sed lacus tincidunt euismod. </p>-->
<!--                            <div class="quote__head">-->
<!--                                <div class="quote__pic"> <img src="img/pic-q.jpg" alt=""></div>-->
<!--                                <div class="quote__title"><span class="quote__name">Jane Cooper</span><span class="quote__subname">Medical Assistant</span></div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <p>Vestibulum augue enim, scelerisque ac gravida ut, sodales non lectus. Nunc non pretium eros. Duis ligula nisi, venenatis in dignissim et, pellentesque in enim. Mauris facilisis, eros a condimentum vehicula, ex eros tincidunt massa, at mattis turpis nibh in erat. Donec vehicula eros quis imperdiet pharetra. Suspendisse vehicula eros ac lacus molestie, id molestie lacus tincidunt. Fusce non arcu tempus odio convallis posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc non enim sed lacus tincidunt euismod. Quisque consequat massa urna, sed tincidunt urna faucibus sit amet.</p>-->
<!--                    </div>-->
<!--                    <div class="news__video">-->
<!--                        <div class="play-video"> <img src="img/video-back2.jpg" alt="">-->
<!--                            <button class="btn-play"></button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="video-wrap">-->
<!--                        <iframe id="video" width="820" height="440" src="https://www.youtube.com/embed/LvQossUx7ss?si=pH9KasmmTG0Q50Ew&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                        <button class="video-wrap__close stop-video"></button>-->
<!--                    </div>-->
<!--                    <div class="news-page__block">-->
<!--                        <h3>Nulla vel odio ut dui tincidunt egestas. Duis sodales diam ligula, in commodo odio auctor non.</h3>-->
<!--                        <ul>-->
<!--                            <li> <span>Ut libero tortor, viverra non massa at, posuere sagittis magna.</span></li>-->
<!--                            <li> <span>Phasellus ullamcorper, lorem eget imperdiet cursus, ex quam fringilla urna, non mollis augue nunc vitae sem. Donec venenatis et velit sit amet placerat.</span></li>-->
<!--                            <li> <span>Ut tortor tellus, porttitor ac libero vitae, lacinia molestie purus. Praesent a imperdiet ante. Nulla vel odio ut dui tincidunt egestas. Duis sodales diam ligula, in commodo odio auctor non.</span></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="news-page__block">-->
<!--                        <h3>Cras non quam lacus. Ut id venenatis justo. Phasellus ullamcorper, lorem eget imperdiet cursus, ex quam fringilla urna, non mollis augue nunc vitae sem. Donec venenatis et velit sit amet placerat.</h3>-->
<!--                        <div class="columns">-->
<!--                            <p>Cras non quam lacus. Ut id venenatis justo. Phasellus ullamcorper, lorem eget imperdiet cursus, ex quam fringilla urna, non mollis augue nunc vitae sem. Donec venenatis et velit sit amet placerat. Aliquam mollis nunc a vestibulum finibus. Integer id nulla sed turpis pellentesque dapibus. Ut libero tortor, viverra non massa at, posuere sagittis magna. Ut tortor tellus, porttitor ac libero vitae, lacinia molestie purus. Praesent a imperdiet ante. Nulla vel odio ut dui tincidunt egestas. Duis sodales diam ligula, in commodo odio auctor non.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="news-page__block">-->
<!--                        <h3>Quisque consequat massa urna, sed tincidunt urna faucibus sit amet.</h3>-->
<!--                        <ol>-->
<!--                            <li> <span>01</span><span>Ut libero tortor, viverra non massa at, posuere sagittis magna.</span></li>-->
<!--                            <li> <span>02</span><span>Phasellus ullamcorper, lorem eget imperdiet cursus, ex quam fringilla urna, non mollis augue nunc vitae sem. Donec venenatis et velit sit amet placerat.</span></li>-->
<!--                            <li> <span>03</span><span>Ut tortor tellus, porttitor ac libero vitae, lacinia molestie purus. Praesent a imperdiet ante. Nulla vel odio ut dui tincidunt egestas. Duis sodales diam ligula, in commodo odio auctor non.</span></li>-->
<!--                        </ol>-->
<!--                        <p>Eget nunc lobortis mattis aliquam faucibus purus in. Etiam sit amet nisl purus in mollis nunc sed. Porta nibh venenatis cras sed. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. Adipiscing elit ut aliquam purus sit amet. Fermentum dui faucibus in ornare quam. Arcu dui vivamus arcu felis. Tincidunt tortor aliquam nulla facilisi cras. Nunc id cursus metus aliquam eleifend mi in nulla. Semper auctor neque vitae tempus quam pellentesque nec nam. Etiam sit amet nisl purus in mollis nunc. Consectetur libero id faucibus nisl tincidunt eget nullam non nisi. Ullamcorper eget nulla facilisi etiam dignissim diam quis. Enim diam vulputate ut pharetra sit amet aliquam. Volutpat sed cras ornare arcu dui vivamus arcu felis. Nisl nunc mi ipsum faucibus vitae aliquet. Suspendisse ultrices gravida dictum fusce ut.</p>-->
<!--                        <p>In hac habitasse platea dictumst quisque sagittis purus. In mollis nunc sed id semper risus. Elementum eu facilisis sed odio morbi. Dolor sit amet consectetur adipiscing. Dolor sed viverra ipsum nunc aliquet bibendum enim. A diam maecenas sed enim ut sem viverra. Tempor orci eu lobortis elementum nibh tellus. Ac placerat vestibulum lectus mauris ultrices eros in cursus turpis. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit. Diam quam nulla porttitor massa id neque aliquam. Aliquam malesuada bibendum arcu vitae elementum curabitur. Vitae sapien pellentesque habitant morbi tristique senectus et.</p>-->
<!--                    </div>-->
<!--                    <div class="share">-->
<!--                        <h4>Поделиться</h4>-->
<!--                        <div class="share__social"> <a class="share__item" href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7778 7.43382H13.556C13.2934 7.43382 13 7.77931 13 8.24147V9.84587H15.7778V12.1325H13V19H10.3777V12.1328H8V9.84618H10.3777V8.5C10.3777 6.57002 11.7172 5 13.556 5H15.7778V7.43382Z" fill="#DB1F26"/></svg><span>Facebook</span></a><a class="share__item" href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.503 7.72223C20.643 8.11159 20.1867 9.00591 19.1342 10.4052C18.9882 10.5999 18.7905 10.8584 18.541 11.1809C18.2977 11.4911 18.1304 11.7102 18.0391 11.8379C17.9479 11.9657 17.8551 12.1162 17.7608 12.2896C17.6665 12.463 17.63 12.5908 17.6513 12.6729C17.6726 12.755 17.7121 12.86 17.7699 12.9877C17.8277 13.1155 17.9266 13.2463 18.0665 13.3801C18.2064 13.514 18.3798 13.6752 18.5866 13.8638C18.611 13.876 18.6262 13.8881 18.6323 13.9003C19.4901 14.6973 20.0711 15.3695 20.3753 15.9171C20.3935 15.9475 20.4133 15.9855 20.4346 16.0312C20.4559 16.0768 20.4772 16.1574 20.4985 16.273C20.5198 16.3886 20.5182 16.492 20.4939 16.5833C20.4696 16.6745 20.3935 16.7582 20.2658 16.8342C20.138 16.9103 19.9585 16.9483 19.7274 16.9483L17.3912 16.9848C17.2452 17.0152 17.0748 17 16.8801 16.9392C16.6855 16.8783 16.5273 16.8114 16.4056 16.7384L16.2231 16.6289C16.0406 16.5011 15.8277 16.3064 15.5843 16.0448C15.341 15.7832 15.1326 15.5475 14.9592 15.3376C14.7858 15.1277 14.6003 14.9513 14.4025 14.8083C14.2048 14.6653 14.0329 14.6182 13.8869 14.6669C13.8687 14.673 13.8443 14.6836 13.8139 14.6988C13.7835 14.714 13.7318 14.7581 13.6588 14.8311C13.5858 14.9041 13.5204 14.9939 13.4626 15.1003C13.4048 15.2068 13.3531 15.365 13.3074 15.5749C13.2618 15.7848 13.242 16.0205 13.2481 16.2821C13.2481 16.3734 13.2375 16.457 13.2162 16.5331C13.1949 16.6091 13.1721 16.6654 13.1477 16.7019L13.1112 16.7475C13.0017 16.8631 12.8405 16.93 12.6276 16.9483H11.5781C11.1462 16.9726 10.7021 16.9224 10.2458 16.7977C9.7895 16.673 9.38949 16.5118 9.04576 16.3141C8.70202 16.1163 8.38871 15.9156 8.10581 15.7118C7.82292 15.508 7.60846 15.333 7.46245 15.187L7.23431 14.968C7.17347 14.9072 7.08982 14.8159 6.98336 14.6942C6.87689 14.5726 6.65939 14.2958 6.33087 13.8638C6.00235 13.4319 5.67991 12.9725 5.36355 12.4858C5.04719 11.9991 4.67456 11.3573 4.24565 10.5603C3.81675 9.76334 3.41978 8.93595 3.05475 8.07813C3.01825 7.98079 3 7.89866 3 7.83174C3 7.76482 3.00913 7.71615 3.02738 7.68573L3.06388 7.63098C3.15514 7.51538 3.32852 7.45759 3.58404 7.45759L6.08448 7.43934C6.15748 7.4515 6.22745 7.47128 6.29437 7.49865C6.36129 7.52603 6.40996 7.55189 6.44038 7.57622L6.48601 7.6036C6.58335 7.67052 6.65635 7.76786 6.70502 7.89562C6.8267 8.19981 6.96663 8.51464 7.1248 8.84013C7.28298 9.16561 7.4077 9.41352 7.49896 9.58387L7.64497 9.84851C7.8214 10.2135 7.99174 10.5299 8.156 10.7976C8.32027 11.0653 8.4678 11.2736 8.5986 11.4227C8.7294 11.5717 8.85564 11.6889 8.97732 11.774C9.09899 11.8592 9.20242 11.9018 9.28759 11.9018C9.37276 11.9018 9.45489 11.8866 9.53398 11.8562C9.54615 11.8501 9.56136 11.8349 9.57961 11.8105C9.59786 11.7862 9.63436 11.7193 9.68912 11.6098C9.74387 11.5003 9.78494 11.3573 9.81231 11.1809C9.83969 11.0044 9.86859 10.758 9.89901 10.4417C9.92943 10.1253 9.92943 9.74509 9.89901 9.30097C9.88684 9.05762 9.85946 8.83556 9.81688 8.6348C9.77429 8.43403 9.7317 8.29411 9.68912 8.21502L9.63436 8.10551C9.48227 7.89866 9.22371 7.76786 8.85868 7.71311C8.77959 7.70094 8.7948 7.62793 8.90431 7.49409C9.00165 7.3785 9.11724 7.28724 9.25109 7.22032C9.57353 7.06214 10.3005 6.98914 11.4321 7.0013C11.931 7.00739 12.3416 7.04693 12.6641 7.11994C12.7858 7.15036 12.8877 7.19142 12.9698 7.24313C13.0519 7.29485 13.1143 7.36785 13.1569 7.46215C13.1995 7.55645 13.2314 7.65379 13.2527 7.75417C13.274 7.85455 13.2846 7.99296 13.2846 8.16939C13.2846 8.34582 13.2816 8.51312 13.2755 8.6713C13.2694 8.82948 13.2618 9.04393 13.2527 9.31466C13.2436 9.58539 13.239 9.83635 13.239 10.0675C13.239 10.1345 13.236 10.2622 13.2299 10.4508C13.2238 10.6394 13.2223 10.7854 13.2253 10.8888C13.2284 10.9923 13.239 11.1155 13.2573 11.2584C13.2755 11.4014 13.3105 11.52 13.3622 11.6143C13.4139 11.7086 13.4824 11.7832 13.5675 11.8379C13.6162 11.8501 13.6679 11.8622 13.7227 11.8744C13.7774 11.8866 13.8565 11.8531 13.9599 11.774C14.0634 11.6949 14.1789 11.59 14.3067 11.4592C14.4345 11.3284 14.5926 11.1246 14.7812 10.8478C14.9698 10.571 15.1767 10.244 15.4018 9.86677C15.7668 9.23405 16.0923 8.54963 16.3782 7.81349C16.4026 7.75265 16.433 7.69942 16.4695 7.65379C16.506 7.60816 16.5395 7.57622 16.5699 7.55797L16.6064 7.53059L16.652 7.50778L16.7706 7.4804L16.9532 7.47584L19.5813 7.45759C19.8186 7.42717 20.0133 7.43477 20.1654 7.4804C20.3175 7.52603 20.4118 7.57622 20.4483 7.63098L20.503 7.72223Z" fill="#DB1F26"/></svg><span>Вконтакте</span></a><a class="share__item" href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.8512 8.408C5.51681 7.08259 6.5379 5.96841 7.80035 5.18998C9.06279 4.41154 10.5169 3.99953 12 4C14.156 4 15.9672 4.7928 17.352 6.084L15.0584 8.3784C14.2288 7.5856 13.1744 7.1816 12 7.1816C9.916 7.1816 8.152 8.5896 7.524 10.48C7.364 10.96 7.2728 11.472 7.2728 12C7.2728 12.528 7.364 13.04 7.524 13.52C8.1528 15.4112 9.916 16.8184 12 16.8184C13.076 16.8184 13.992 16.5344 14.7088 16.0544C15.1243 15.7808 15.4801 15.4258 15.7546 15.0108C16.029 14.5958 16.2165 14.1295 16.3056 13.64H12V10.5456H19.5344C19.6288 11.0688 19.68 11.6144 19.68 12.1816C19.68 14.6184 18.808 16.6696 17.2944 18.0616C15.9712 19.284 14.16 20 12 20C10.9493 20.0004 9.90883 19.7938 8.93804 19.3919C7.96724 18.99 7.08516 18.4007 6.34221 17.6578C5.59926 16.9148 5.01 16.0328 4.60811 15.062C4.20622 14.0912 3.99958 13.0507 4 12C4 10.7088 4.3088 9.488 4.8512 8.408Z" fill="#DB1F26"/></svg><span>Google</span></a><a class="share__item" href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.227 6.65729C19.5931 6.93837 18.9119 7.12834 18.197 7.2138C18.9268 6.7764 19.4871 6.08375 19.751 5.25847C19.0572 5.67016 18.2982 5.96022 17.5067 6.11612C16.862 5.42926 15.9435 5 14.9269 5C12.975 5 11.3925 6.58246 11.3925 8.53422C11.3925 8.81126 11.4238 9.08097 11.484 9.33971C8.54668 9.19228 5.94245 7.78525 4.19923 5.64695C3.89506 6.16894 3.72077 6.77613 3.72077 7.42375C3.72077 8.64996 4.34478 9.73169 5.29307 10.3655C4.73181 10.3479 4.18291 10.1964 3.69217 9.92341C3.69197 9.93822 3.69197 9.95302 3.69197 9.96789C3.69197 11.6803 4.91024 13.1088 6.52702 13.4335C6.00657 13.575 5.46065 13.5957 4.93097 13.494C5.38069 14.8982 6.68596 15.9199 8.23249 15.9485C7.0229 16.8964 5.49892 17.4615 3.84311 17.4615C3.55779 17.4615 3.27651 17.4447 3 17.4121C4.56409 18.4149 6.42184 19 8.41774 19C14.9187 19 18.4736 13.6145 18.4736 8.9441C18.4736 8.79081 18.4702 8.63839 18.4633 8.48684C19.1553 7.98665 19.7525 7.3671 20.227 6.65729Z" fill="#DB1F26"/></svg><span>Twitter</span></a></div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <form class="news-page__col email_form">
                <input type="hidden" name="formName" value="Подписаться на рассылку">
                <div class="aside-block">
                    <h2 class="aside-block__title">Подписаться на рассылку</h2>
                    <div class="input__overlay">
                        <input class="input-default" type="email" placeholder="Электронная почта">
                    </div>
                    <p class="aside-block__agree">Подписываясь, вы даете согласие на <a href="">обработку персональных данных</a></p>
                    <button class="btn btn--red btn--l btn--icn" type="submit">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>Подписаться</span></button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $APPLICATION->IncludeComponent(
    'coderoom:news.slider',
    '.default',
    [
        'IS_BLOG' => 'Y',
        'TITLE' => 'Похожие статьи',
        'SHOW_LINK' => 'N',
        'ELEMENT_ID' => $arResult['ID'],
    ]
); ?>
<form class="aside-block aside-block--mobile email_form">
    <input type="hidden" name="formName" value="Подписаться на рассылку">
    <h2 class="aside-block__title">Подписаться на рассылку</h2>
    <div class="input__overlay">
        <input class="input-default" type="email" placeholder="Электронная почта">
    </div>
    <p class="aside-block__agree">Подписываясь, вы даете согласие на <a href="">обработку персональных данных</a></p>
    <button class="btn btn--red btn--l btn--icn" type="submit">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>Подписаться</span></button>
</form>