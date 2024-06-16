<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//use Bitrix\Main\Application;
//use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Context;

global $APPLICATION;

//$application = Application::getInstance();
$request = Context::getCurrent()->getRequest();
//$context = $application->getContext();
$sortten = $request->get('sortten');

if ($sortten == 'catalog_PRICE_1_max' || $sortten == 'catalog_PRICE_1_min')
{
    $order = $sortten == 'catalog_PRICE_1_max' ? 'ASC' : 'DESC';

//    $orderCookie = new Cookie('order', $order, time() + 60*60*24*60);
//    $orderCookie->setDomain($context->getServer()->getHttpHost());
//    $orderCookie->setHttpOnly(false);
//    $context->getResponse()->addCookie($orderCookie);
    setcookie('order', $order, 0, '/', '', false, true);
}

//$sorttenCookie = new Cookie('sortten', $sortten, time() + 60*60*24*60);
//$sorttenCookie->setDomain($context->getServer()->getHttpHost());
//$sorttenCookie->setHttpOnly(false);
//$context->getResponse()->addCookie($sorttenCookie);

//$context->getResponse()->flush('');

setcookie('sortten', $sortten, 0, '/', '', false, true);