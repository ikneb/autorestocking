<div class="panel" id="fieldset_0">
    <div class="panel-heading">
        <i class="icon-briefcase"></i> Relation
    </div>
    {if !empty($relations)}
        <table id="table-product" class="table product">
            <thead>
            <tr class="nodrag nodrop">
                <th class="fixed-width-xs center">
                    <span class="title_box active">ID</span>
                </th>
                <th class="">
                    <span class="title_box">Имя</span>
                </th>
                <th class="">
                    <span class="title_box">Количество</span>
                </th>
                <th class=" text-right">
                    <span class="title_box">Мин количество</span>
                </th>
                <th class=" text-right">
                    <span class="title_box">Количество заказа</span>
                </th>
                <th class=" text-right">
                    <span class="title_box">Статус</span>
                </th>
                <th class="fixed-width-xs center">

                </th>
            </tr>
            </thead>
            <tbody>
                {foreach from=$relations item=relation}
                    <tr id="tr__1_0" class=" odd">
                        <td class="pointer fixed-width-xs center">
                            1
                        </td>
                        {*<td class="pointer center" onclick="document.location = 'index.php?controller=AdminProducts&amp;id_product=1&amp;updateproduct&amp;token=36c7e5ca8fb2666c5ad464334185d1ce'">
                            <img src="../img/tmp/product_mini_1_1.jpg?time=1484773205" alt="" class="imgm img-thumbnail">
                        </td>*}
                        <td class="pointer">
                            Faded Short Sleeve T-shirts
                        </td>
                        <td class="pointer text-right">
                        </td>
                        <td class="pointer fixed-width-sm text-center" onclick="document.location = 'index.php?controller=AdminProducts&amp;id_product=1&amp;updateproduct&amp;token=36c7e5ca8fb2666c5ad464334185d1ce'">

                        </td>
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                        </td>

                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <h4>You need add relation</h4>
    {/if}
</div>