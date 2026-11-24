<?php

namespace Approval;

use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Highloadblock\HighloadBlockTable;

class Cookie
{
    public static function Log ()  {
        Loader::includeModule( 'highloadblock' );

        // 1. Последняя активная запись согласия по ID формы
        $hlApproval = HighloadBlockTable::getList([
            'filter' => [ '=NAME' => 'ApprovalCookie' ],
        ]) -> fetch();

        if ( !$hlApproval )  {
            return false;
        }

        $approvalClass = HighloadBlockTable::compileEntity( $hlApproval ) -> getDataClass();

        $item = $approvalClass::getList([
            'select' => [ 'ID' ],
            'filter' => [ '=UF_ACTIVE' => 1 ],
            'order'  => [ 'UF_DATETIME' => 'DESC', 'ID' => 'DESC' ],
            'limit'  => 1,
        ]) -> fetch();

        if ( !$item )  {
            return false;
        }

        // 2. Запись в лог
        $hlLog = HighloadBlockTable::getList([
            'filter' => [ '=NAME' => 'ApprovalCookieLog' ],
        ]) -> fetch();

        if ( !$hlLog )  {
            return false;
        }

        $logClass = HighloadBlockTable::compileEntity( $hlLog ) -> getDataClass();
        $request  = Context::getCurrent() -> getRequest();

        $result = $logClass::add([
            'UF_USER_AGENT' => $request -> getUserAgent(),
            'UF_USER_IP'    => $request -> getRemoteAddress(),
            'UF_APPROVAL'   => $item['ID'],
        ]);

        return $result -> isSuccess();
    }
}