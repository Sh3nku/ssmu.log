<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

Loader::includeModule( 'highloadblock' );

$hlblock = HighloadBlockTable::getList([
    'filter' => [ '=NAME' => 'ApprovalCookie' ],
]) -> fetch();

$approvalFilePath = '';

if ( $hlblock )  {
    $entity    = HighloadBlockTable::compileEntity( $hlblock );
    $dataClass = $entity -> getDataClass();

    $item = $dataClass::getList([
        'select' => [ 'UF_FILE' ],
        'filter' => [ '=UF_ACTIVE' => 1 ],
        'order'  => [ 'UF_DATETIME' => 'DESC', 'ID' => 'DESC' ],
        'limit'  => 1,
    ]) -> fetch();

    if ( !empty( $item['UF_FILE'] ) ) {
        $approvalFilePath = CFile::GetPath( $item['UF_FILE'] );
    }
}
?>

Даю согласие на
<a href="<?=$approvalFilePath?>" target="_blank">обработку персональных данных</a>
, полученных с помощью метрических систем