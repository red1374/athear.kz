<?php

namespace Coderoom\Components;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UserTable;
use CBitrixComponent;

//implements Controllerable, Errorable
class PersonalComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult['USER'] = $this->getUserData();
        $this->includeComponentTemplate();
    }

    public function getUserData() : array
    {
        global $USER;

        $arUser = UserTable::getList(Array(
            'select' => [
                'ID',
                'EMAIL',
                'NAME',
                'LAST_NAME',
                'PERSONAL_PHONE',
                'SECOND_NAME',
                'UF_MAIL'
            ],
            'filter' => [
                'ID' => $USER->GetId(),
            ],
        ))->fetchAll();

        return $arUser[0];
    }

    public function configureActions(): array
    {
        return [
            'send' => [
                'prefilters' => []
            ]
        ];
    }

    public function sendAction(
        string $LAST_NAME = '',
        string $NAME = '',
        string $SECOND_NAME = '',
        string $PERSONAL_PHONE = '',
        string $EMAIL = '',
        string $OLD_PASSWORD = '',
        string $PASSWORD = '',
        string $CONFIRM_PASSWORD = '',
        string $UF_MAIL = ''
    ): array
    {
        $this->sendUserInfo();

        return [
            "result" => "Ваше сообщение принято",
        ];
    }
}

//function changePassword($OLD_PASSWORD,$PASSWORD ,$CONFIRM_PASSWORD ){
//    global  $USER;
//    $mass_ret=array();
//    $arAuthResult = $USER->Login($USER->GetLogin(), $OLD_PASSWORD, "Y");
//    if( $arAuthResult==1){
//        if($PASSWORD ==$CONFIRM_PASSWORD ){
//            //test@test.ru
//            //123456
//            $user = new CUser;
//            $fields = Array(
//                "PASSWORD"          => $PASSWORD,
//                "CONFIRM_PASSWORD"  => $CONFIRM_PASSWORD ,
//            );
//            $user->Update(  $USER->GetID(), $fields);
//            $strError = $user->LAST_ERROR;
//            if(empty($strError)){
//                $mass_ret['success']='Сохранено';
//            }else{
//                $mass_ret['error']=$strError;
//            }
//        }else{
//            $mass_ret['error']='Пароли не совпадают';
//            $mass_ret['n_iput']=2;
//        }
//
//    }else{
//
//        $mass_ret['error']='неправильный пароль';
//        $mass_ret['n_iput']=1;
//    }
//    return $mass_ret;
//}

//https://dev.1c-bitrix.ru/api_help/main/reference/cuser/changepassword.php
//https://dev.1c-bitrix.ru/api_help/main/reference/cuser/update.php