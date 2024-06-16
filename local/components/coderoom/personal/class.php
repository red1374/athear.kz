<?php

namespace Coderoom\Components;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UserTable;
use CBitrixComponent;

class PersonalComponent extends CBitrixComponent implements Controllerable
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
        global $USER;

        $user = new \CUser;

        $arFields = [
            'LAST_NAME' => $LAST_NAME,
            'NAME' => $NAME,
            'SECOND_NAME' => $SECOND_NAME,
            'PERSONAL_PHONE' => $PERSONAL_PHONE,
            'EMAIL' => $EMAIL,
            'UF_MAIL' => $UF_MAIL,
        ];

        if ($OLD_PASSWORD && $PASSWORD && $CONFIRM_PASSWORD)
        {
            $isAuthResult = $USER->Login($USER->GetLogin(), $OLD_PASSWORD, 'Y');

            if ($isAuthResult && $PASSWORD == $CONFIRM_PASSWORD)
            {
                $arFields['PASSWORD'] = $PASSWORD;
                $arFields['CONFIRM_PASSWORD'] = $CONFIRM_PASSWORD;
            } else {
                return [
                    'result' => 'false',
                ];
            }
        }

        $user->Update($USER->GetId(), $arFields);

        return [
            'result' => 'true',
        ];
    }
}