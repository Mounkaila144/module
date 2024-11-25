
{messages class="site-errors"}
<span id="error-container" class="text-danger"></span>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Oauth2ServerPhpClient"}

<button id="Oauth2ServerPhpClient-filter" class="btn  ">{__("Filter")}</button>
<button id="Oauth2ServerPhpClient-init" class="btn  ">{__("Init")}</button>
<button id="Oauth2ServerPhpClient-New" class="btn btn-sm pull-right" title="{__('new Client')}"><i
            class="fa fa-plus" style="margin-right:10px;"></i>{__('New Client')}</button>
<table class="tabl-list footable table table-striped">
    <thead>
    <tr class="table-info">

        <thead>
    <tr class="list-header">
        <th data-hide="phone" style="display: table-cell;">#</th>
        {if $pager->getNbItems()>5}
            <th data-hide="phone" style="display: table-cell;">&nbsp;</th>
        {/if}

        <th>
            <span>{__('Name')|capitalize}</span>
        </th>

<th>
            <span>{__('Client id')|capitalize}</span>
        </th>


        <th>
            <span>{__('Client secret')|capitalize}</span>

        </th>

        <th>
            <span>{__('Redirect uri')}</span>

        </th>


        <th>
            {__('Scope')}

        </th>

        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}
            <td></td>
        {/if}
        {*     <td>{* id *}
        {* </td>        *}
        <td>{* name *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
        <td>{* manager *}</td>
    </tr>
    {foreach $pager as $item}
        <tr class="Oauth2ServerPhpClient list"
            id="Oauth2ServerPhpClient-{$item->get('client_id')}">
            <td class="Oauth2ServerPhpClient-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>
                    <input class="Oauth2ServerPhpClient-selection" type="checkbox"
                           id="{$item->get('client_id')}" name="{$item->get('client_id')}"/>
                </td>
            {/if}
            {*  <td><span>{$item->get('client_id')}</span></td>   *}
            <td>
                {$item->get('name')}
            </td>
            <td>
                {$item->get('client_id')}
            </td>
            <td>
                {$item->get('client_secret')}
            </td>
            <td>
                {$item->get('redirect_uri')}

            </td>
            <td>
                {$item->get('scope')}

            </td>
            <td>

                <a href="#" title="{__('edit')}" class="Oauth2ServerPhpClient-View"
                   id="{$item->get('client_id')}">
                    <img src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>

                <a href="#" title="{__('delete')}" class="Oauth2ServerPhpClient-Delete"
                   id="{$item->get('client_id')}" name="{$item->get('client_id')}">
                    <img src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>


            </td>
        </tr>
    {/foreach}

</table>
{if !$pager->getNbItems()}
    <span>{__('No Client')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="Oauth2ServerPhpClient-all"/>
        <a style="opacity:0.5" class="Oauth2ServerPhpClient-actions_items" href="#"
           title="{__('delete')}" id="Oauth2ServerPhpClient-Delete">
            <img src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>
    {/if}
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Oauth2ServerPhpClient"}

<div class="" style="top:100px;position: fixed;left: 20px;z-index: 1000;">
    <a href="javascript:void(0);" style="margin-right: 20px;" id="Cancel">
        <i class="mdi mdi-arrow-left-bold-circle text-danger fs-36"></i>
    </a>
</div>
<script type="text/javascript">

    function getSiteClientFilterParameters() {
        var params = {
            filter: {
                order: {},
                search: {},
                equal: {},
                   nbitemsbypage: $("[name=Oauth2ServerPhpClient-nbitemsbypage]").val(),
                token: '{$formFilter->getCSRFToken()}'
            }
        };

        $(".Oauth2ServerPhpClient-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });


        if ($(".Oauth2ServerPhpClient-order_active").attr("name"))
            params.filter.order[$(".Oauth2ServerPhpClient-order_active").attr("name")] = $(".Oauth2ServerPhpClient-order_active").attr("id");
        $(".Oauth2ServerPhpClient-search").each(function () {
            params.filter.search[$(this).attr('name')] = $(this).val();
        });
        return params;
    }

    function updateSiteClientFilter() {
        return $.ajax2({
            data: getSiteClientFilterParameters(),
            url: "{url_to('oauth2_server_php_ajax',['action'=>'ListPartialClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    }

    function updateSitePager(n) {
        page_active = $(".Oauth2ServerPhpClient-pager .Oauth2ServerPhpClient-active").html() ? parseInt($(".Oauth2ServerPhpClient-pager .Oauth2ServerPhpClient-active").html()) : 1;
        records_by_page = $("[name=Oauth2ServerPhpClient-nbitemsbypage]").val();
        start = (records_by_page != "*") ? (page_active - 1) * records_by_page + 1 : 1;
        $(".Oauth2ServerPhpClient-count").each(function (id) {
            $(this).html(start + id)
        }); // Update index column
        nb_results = parseInt($("#Oauth2ServerPhpClient-nb_results").html()) - n;
        $("#Oauth2ServerPhpClient-nb_results").html((nb_results > 1 ? nb_results + " {__('results')}" : "{__('one result')}"));
        $("#Oauth2ServerPhpClient-end_result").html($(".Client-count:last").html());
    }

    {* =====================  P A G E R  A C T I O N S =============================== *}

    $("#Oauth2ServerPhpClient-init").click(function () {
        $.ajax2({
            url: "{url_to('oauth2_server_php_ajax',['action'=>'ListPartialClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $('.Oauth2ServerPhpClient-order').click(function () {
        $(".Oauth2ServerPhpClient-order_active").attr('class', 'Oauth2ServerPhpClient-order');
        $(this).attr('class', 'Oauth2ServerPhpClient-order_active');
        return updateSiteClientFilter();
    });

    $(".Oauth2ServerPhpClient-search").keypress(function (event) {
        if (event.keyCode == 13)
            return updateSiteClientFilter();
    });

    $("#Oauth2ServerPhpClient-filter").click(function () {
        return updateSiteClientFilter();
    });
    $(".Oauth2ServerPhpClient-equal").change(function () {
        return updateSiteClientFilter();
    });

    $("[name=Oauth2ServerPhpClient-nbitemsbypage]").change(function () {
        return updateSiteClientFilter();
    });


    $(".Oauth2ServerPhpClient-pager").click(function () {
        return $.ajax2({
            data: getSiteClientFilterParameters(),
            url: "{url_to('oauth2_server_php_ajax',['action'=>'ListPartialClient'])}?" + this.href.substring(this.href.indexOf("?") + 1, this.href.length),
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $("#Oauth2ServerPhpClient-New").click(function () {

        return $.ajax2({
            url: "{url_to('oauth2_server_php_ajax',['action'=>'NewClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });

    $(".Oauth2ServerPhpClient-View").click(function () {
        return $.ajax2({
            data: { Oauth2ServerPhpClient: $(this).attr('id')},
            loading: "#loading",
            url: "{url_to('oauth2_server_php_ajax',['action'=>'ViewClient'])}",
            errorTarget: ".site-errors",
            target: "#tab-site-panel-dashboard-x-list-client-base"
        });
    });


    $(".Oauth2ServerPhpClient-Delete").click(function () {
        if (!confirm('{__("Client \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
        return $.ajax2({
            data: { Oauth2ServerPhpClient: $(this).attr('id')},
            url: "{url_to('oauth2_server_php_ajax',['action'=>'DeleteClient'])}",
            errorTarget: ".site-errors",
            loading: "#loading",
            success: function (resp) {
                if (resp.action == 'deleteOauth2ServerPhpClient') {
                    $("tr#Oauth2ServerPhpClient-" + resp.id).remove();
                    if ($('.Oauth2ServerPhpClient').length == 0)
                        return updateSiteClientFilter()

                }
            }
        });
    });


</script>
