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
                <th class="text-center">
                    <span class="title_box">Остаток</span>
                </th>
                <th class=" text-left">
                    <span class="title_box">Мин количество</span>
                </th>
                <th class=" text-left">
                    <span class="title_box">Количество заказа</span>
                </th>
                <th class=" text-center">
                    <span class="title_box">Order day</span>
                </th>
                <th class="text-center">
                        Update
                </th>
            </tr>
            </thead>
            <tbody>
                {foreach from=$relations item=relation}
                    <tr class="items-relation">
                        <input type="hidden" name="id_relation" value="{$relation.id_relations}" >
                        <td class="pointer fixed-width-xs center">
                            {$relation.id_relations}
                        </td>
                        <td class="pointer text-left">
                            {$relation.name}
                        </td>
                        <td class="pointer text-center">
                            {$relation.quantity}
                        </td>
                        <td class="pointer text-center">
                                <input type="number" name="min_count" id="min_count" value="{$relation.min_count}">
                        </td>
                        <td class="text-center">
                                <input type="number" name="product_count" id="product_count" value="{$relation.product_count}">
                        </td>
                        <td class="text-center">
                            <select name="order_day" class="selectpicker">
                                <option value="0"></option>
                                <option value="1" {if $relation && $relation.order_day == 1}selected{/if}>Mon</option>
                                <option value="2" {if $relation && $relation.order_day == 2}selected{/if}>Tue</option>
                                <option value="3" {if $relation && $relation.order_day == 3}selected{/if}>Wed</option>
                                <option value="4" {if $relation && $relation.order_day == 4}selected{/if}>Thu</option>
                                <option value="5" {if $relation && $relation.order_day == 5}selected{/if}>Fri</option>
                                <option value="6" {if $relation && $relation.order_day == 6}selected{/if}>Sat</option>
                                <option value="7" {if $relation && $relation.order_day == 7}selected{/if}>Sun</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn-xs btn btn-primary update-relation">Update</button>
                        </td>
                    </tr>
                {/foreach}
                {if !empty($pages)}
                    <nav aria-label="...">
                        <ul class="pagination pagination-sm" data-sel="{$select}" data-count="{$pages}">
                            <li class="page-item {if $select == 1}disabled{/if}">
                                <a class="page-link" data-page="-1">Previous</a>
                            </li>
                            {for $page=1 to $pages}
                                <li class="page-item {if $select==$page}active{/if}" ><a class="page-link" data-page="{$page}">{$page}</a></li>
                            {/for}
                            <li class="page-item {if $select == $pages}disabled{/if}">
                                <a class="page-link"  data-page="+1">Next</a>
                            </li>
                        </ul>
                    </nav>
                {/if}
            </tbody>
        </table>
    {else}
        <h4>You need add relation</h4>
    {/if}
</div>