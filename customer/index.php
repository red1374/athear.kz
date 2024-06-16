<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Покупателям');
?>

<section class="buyers">
    <div class="_container">
        <h1 class="title-page"><?php $APPLICATION->ShowTitle(false); ?></h1>
        <div class="buyers__wrap remove">
            <a class="item" href="/customer/payments/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.5 10.5H21.5H3.5ZM7.5 15.5H8.5H7.5ZM12.5 15.5H13.5H12.5ZM6.5 19.5H18.5C19.2956 19.5 20.0587 19.1839 20.6213 18.6213C21.1839 18.0587 21.5 17.2956 21.5 16.5V8.5C21.5 7.70435 21.1839 6.94129 20.6213 6.37868C20.0587 5.81607 19.2956 5.5 18.5 5.5H6.5C5.70435 5.5 4.94129 5.81607 4.37868 6.37868C3.81607 6.94129 3.5 7.70435 3.5 8.5V16.5C3.5 17.2956 3.81607 18.0587 4.37868 18.6213C4.94129 19.1839 5.70435 19.5 6.5 19.5Z"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Покупка и оплата</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-1.php", [], ["MODE" => "html"]); ?></p>
            </a>
            <a class="item" href="/customer/delivery/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1120_23392)">
                            <path d="M7.5 19.5C8.60457 19.5 9.5 18.6046 9.5 17.5C9.5 16.3954 8.60457 15.5 7.5 15.5C6.39543 15.5 5.5 16.3954 5.5 17.5C5.5 18.6046 6.39543 19.5 7.5 19.5Z"
                                  stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.5 19.5C18.6046 19.5 19.5 18.6046 19.5 17.5C19.5 16.3954 18.6046 15.5 17.5 15.5C16.3954 15.5 15.5 16.3954 15.5 17.5C15.5 18.6046 16.3954 19.5 17.5 19.5Z"
                                  stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.5 17.5H3.5V13.5M2.5 5.5H13.5V17.5M9.5 17.5H15.5M19.5 17.5H21.5V11.5M21.5 11.5H13.5M21.5 11.5L18.5 6.5H13.5"
                                  stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.5 9.5H7.5" stroke="#131313" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_1120_23392">
                                <rect width="24" height="24" fill="white" transform="translate(0.5 0.5)"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <h4 class="item__title">Доставка</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-2.php", [], ["MODE" => "html"]); ?></p>
            </a>
            <a class="item" href="/customer/guarantee/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.5 12.5L11.5 14.5L15.5 10.5M21.118 6.484C17.9561 6.65192 14.8567 5.55861 12.5 3.444C10.1433 5.55861 7.0439 6.65192 3.882 6.484C3.62754 7.46911 3.49918 8.48255 3.5 9.5C3.5 15.091 7.324 19.79 12.5 21.122C17.676 19.79 21.5 15.092 21.5 9.5C21.5 8.458 21.367 7.448 21.118 6.484Z"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Гарантия и возврат</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-3.php", [], ["MODE" => "html"]); ?></p>
            </a><a class="item" href="/customer/materials/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.5 7.5V15.5C8.5 16.0304 8.71071 16.5391 9.08579 16.9142C9.46086 17.2893 9.96957 17.5 10.5 17.5H16.5M8.5 7.5V5.5C8.5 4.96957 8.71071 4.46086 9.08579 4.08579C9.46086 3.71071 9.96957 3.5 10.5 3.5H15.086C15.3512 3.50006 15.6055 3.60545 15.793 3.793L20.207 8.207C20.3946 8.39449 20.4999 8.6488 20.5 8.914V15.5C20.5 16.0304 20.2893 16.5391 19.9142 16.9142C19.5391 17.2893 19.0304 17.5 18.5 17.5H16.5M8.5 7.5H6.5C5.96957 7.5 5.46086 7.71071 5.08579 8.08579C4.71071 8.46086 4.5 8.96957 4.5 9.5V19.5C4.5 20.0304 4.71071 20.5391 5.08579 20.9142C5.46086 21.2893 5.96957 21.5 6.5 21.5H14.5C15.0304 21.5 15.5391 21.2893 15.9142 20.9142C16.2893 20.5391 16.5 20.0304 16.5 19.5V17.5"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Материалы по продукции</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-4.php", [], ["MODE" => "html"]); ?></p>
            </a><a
                    class="item" href="/customer/questions/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.728 9.5C9.277 8.335 10.758 7.5 12.5 7.5C14.71 7.5 16.5 8.843 16.5 10.5C16.5 11.9 15.222 13.075 13.494 13.407C12.952 13.511 12.5 13.947 12.5 14.5M12.5 17.5H12.51M21.5 12.5C21.5 13.6819 21.2672 14.8522 20.8149 15.9442C20.3626 17.0361 19.6997 18.0282 18.864 18.864C18.0282 19.6997 17.0361 20.3626 15.9442 20.8149C14.8522 21.2672 13.6819 21.5 12.5 21.5C11.3181 21.5 10.1478 21.2672 9.05585 20.8149C7.96392 20.3626 6.97177 19.6997 6.13604 18.864C5.30031 18.0282 4.63738 17.0361 4.18508 15.9442C3.73279 14.8522 3.5 13.6819 3.5 12.5C3.5 10.1131 4.44821 7.82387 6.13604 6.13604C7.82387 4.44821 10.1131 3.5 12.5 3.5C14.8869 3.5 17.1761 4.44821 18.864 6.13604C20.5518 7.82387 21.5 10.1131 21.5 12.5Z"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Вопрос-ответ</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-5.php", [], ["MODE" => "html"]); ?></p></a><a
                    class="item" href="/customer/feedbacks/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.5 12.5H8.51H8.5ZM12.5 12.5H12.51H12.5ZM16.5 12.5H16.51H16.5ZM21.5 12.5C21.5 16.918 17.47 20.5 12.5 20.5C11.0286 20.505 9.57479 20.1808 8.245 19.551L3.5 20.5L4.895 16.78C4.012 15.542 3.5 14.074 3.5 12.5C3.5 8.082 7.53 4.5 12.5 4.5C17.47 4.5 21.5 8.082 21.5 12.5Z"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Отзывы</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-6.php", [], ["MODE" => "html"]); ?></p></a>
            <a class="item" href="/customer/blog/">
                <div class="item__pic">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 5.49998H6.5C5.96957 5.49998 5.46086 5.71069 5.08579 6.08577C4.71071 6.46084 4.5 6.96955 4.5 7.49998V18.5C4.5 19.0304 4.71071 19.5391 5.08579 19.9142C5.46086 20.2893 5.96957 20.5 6.5 20.5H17.5C18.0304 20.5 18.5391 20.2893 18.9142 19.9142C19.2893 19.5391 19.5 19.0304 19.5 18.5V13.5M18.086 4.08598C18.2705 3.89496 18.4912 3.74259 18.7352 3.63778C18.9792 3.53296 19.2416 3.47779 19.5072 3.47548C19.7728 3.47317 20.0361 3.52377 20.2819 3.62434C20.5277 3.7249 20.751 3.8734 20.9388 4.06119C21.1266 4.24897 21.2751 4.47228 21.3756 4.71807C21.4762 4.96386 21.5268 5.22722 21.5245 5.49278C21.5222 5.75834 21.467 6.02078 21.3622 6.26479C21.2574 6.5088 21.105 6.72949 20.914 6.91398L12.328 15.5H9.5V12.672L18.086 4.08598Z"
                              stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="item__title">Блог</h4>
                <p><?php $APPLICATION->IncludeFile("/include/customer-7.php", [], ["MODE" => "html"]); ?></p></a>
        </div>
    </div>
</section>

<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
