<div class="frame-user-toolbar{if $_COOKIE['condUserToolbar'] == 1 || !isset($_COOKIE['condUserToolbar'])} active{/if}">
    <div class="container inside-padd">
        {$countSh = getProductViewsCount()}
        <div class="content-user-toolbar">
            <ul class="items items-user-toolbar">
                <li class="box-1">
                    {include_shop_tpl('wish_list_data')}
                </li>
                <li class="box-2">
                    {include_shop_tpl('compare_data')}
                </li>
                <li class="box-3">
                    <div class="btn-already-show{if $countSh} pointer{/if}">
                        <button type="button" data-drop=".frame-already-show" data-effect-on="slideDown" data-effect-off="slideUp" data-place="inherit">
                            <span class="text-view-list text-el">
                                <span class="icon_view_product"></span>
                                <span class="icon_arrow_down"></span>
                                <span class="text-el">{lang("Уже видели",'newLevel')}</span><span>&nbsp;({echo $countSh})</span>
                            </span>
                        </button>
                    </div>
                </li>
                <!--Start. Top menu and authentication data block-->
                {include_shop_tpl('auth_data')}
                <!--End. Top menu and authentication data block-->
            </ul>
        </div>
        <div class="btn-to-up">
            <button type="button">
                <span class="text-el ref t-d_n"><span class="icon_arrow_p icon_arrow_p2"></span>{lang('Наверх','newLevel')}</span>
            </button>
        </div>
    </div>
    <div class="drop frame-already-show">
        <div class="content-already-show">
            <div id="ViewedProducts">
                {/*{widget_ajax('ViewedProducts', '#ViewedProducts')}*/}
                {widget('ViewedProducts')}
            </div>
        </div>
    </div>
</div>