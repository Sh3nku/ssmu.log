<?
use \Bitrix\Main\Loader;
use \Bitrix\Iblock\Iblock;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
if (empty($address)):
    Loader::includeModule('iblock');
    $address = Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("VALUE.VALUE", " value")
        ->addFilter("CODE", "address")
        ->exec()
        ->fetch()['value'];
    $phone = Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("VALUE.VALUE", " value")
        ->addFilter("CODE", "phone")
        ->exec()
        ->fetch()['value'];
    $email = Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("VALUE.VALUE", " value")
        ->addFilter("CODE", "email")
        ->exec()
        ->fetch()['value'];
    $terms = CFile::GetPath(Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("FILE.VALUE", " value")
        ->addFilter("CODE", "terms-of-use")
        ->exec()
        ->fetch()['value']);
    $terms = CFile::GetPath(Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("FILE.VALUE", " value")
        ->addFilter("CODE", "terms-of-use")
        ->exec()
        ->fetch()['value']);
    $policy = CFile::GetPath(Iblock::wakeUp(27)->getEntityDataClass()::query()
        ->addSelect("FILE.VALUE", " value")
        ->addFilter("CODE", "privacy-policy")
        ->exec()
        ->fetch()['value']);
endif;
?>
        <? if ($APPLICATION->GetCurDir() != "/" && $APPLICATION->GetProperty("DISABLE_SECTION") != "Y"): ?>
                </div>
            </section>
        <? endif; ?>
    </main>
    <div class="intro | js-intro">
        <div class="intro__item card | js-intro-item">
            <button class="intro__close | js-intro-close" type="button" value="all">
                <svg class="_icon-close">
                    <use href="<?= SITE_TEMPLATE_PATH ?>/i/sprite.svg#close"></use>
                </svg>
            </button>
            <p class="intro__item-text">
                Выбери свой город и&nbsp;узнай на&nbsp;какие мероприятия ты&nbsp;можешь записаться уже сегодня!
            </p>
        </div>
    </div>
    <footer class="footer" id="js-footer">
        <div class="container">
            <div class="footer__container">
                <div class="footer-contacts">
                    <div class="footer-contacts__column">
                        <a href="mailto:<?= $email ?>" class="footer__link footer-contacts__link"><?= $email ?></a>
                        <a href="tel:<?= str_replace(["+", " ", "(", ")", " "], "", $phone) ?>" class="footer-contacts__link"><?= $phone ?></a>
                        <div class="footer-social _desktop">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "social",
                                array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "Y",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "FILTER_NAME" => "",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "28",
                                    "IBLOCK_TYPE" => "content_promo",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "20",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(
                                        0 => "ICON",
                                        1 => "LINK",
                                    ),
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "Y",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ID",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                ),
                                false
                            ); ?>
                        </div>
                    </div>
                    <div class="footer-contacts__column">
                        <p class="footer-contacts__address">
                            <?= $address ?>
                        </p>
                    </div>
                </div>
                <div class="footer__links">
                    <a href="https://ssmu.ru/ru/" class="footer__link" target="_blank">Сайт СибГМУ</a>
                    <a href="https://abiturient.ssmu.ru/" class="footer__link" target="_blank">Абитуриент СибГМУ</a>
                </div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "social-mobile",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "28",
                        "IBLOCK_TYPE" => "content_promo",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "20",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "ICON",
                            1 => "LINK",
                        ),
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "Y",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__bottom">
                <div class="footer__documents">
                    <a href="<?= $terms ?>" class="footer__document" target="_blank">Пользовательское соглашение</a>
                    <a href="<?= $policy ?>" class="footer__document" target="_blank">Политика по обработке персональных данных</a>
                </div>
                <div class="footer__vendor">
                    <a href="#" target="_blank">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/i/c/footer/paraweb.svg" />
                    </a>
                </div>
            </div>
        </div>
    </footer>

<div
    class="cookies | js-cookies"
    role="region"
    aria-label="Мы используем cookie"
    data-cookies-status-url="/local/api/check/cookies.php"
    data-cookies-accept-url="/local/api/check/cookies.php?param=accepted"
    data-cookies-decline-url="/local/api/check/cookies.php?param=declined"
>
    <div class="cookies__panel">
        <div class="cookies__content">
            <p class="cookies__title">Мы используем cookie</p>
            <p class="cookies__text">
                <?$APPLICATION -> IncludeFile( SITE_DIR . '/include/privacy.php', [], ['MODE' => 'html', 'NAME' => 'Политика'] )?>
            </p>
        </div>
        <div class="cookies__actions">
            <button type="button" class="btn _medium | js-cookies-accept">Принять</button>
            <button type="button" class="btn _medium _outline | js-cookies-decline">Отказаться</button>
        </div>
    </div>
</div>

	</body>
</html>
