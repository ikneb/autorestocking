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
            </th>
            <th class="text-center">
            </th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$relations item=relation}
        <tr class="items-relation">
            <input type="hidden" name="id_relation" value="{$relation.id_relations}">
            <td class="pointer fixed-width-xs center">
                {$relation.id_relations}
            </td>
            <td class="pointer text-left">
                {$relation.name} {$relation.name_combination}
            </td>
            <td class="pointer text-center">
                {if $relation.id_product_attribute == 0}{$relation.product_quantity}{else}{$relation.attribute_quantity}{/if}
            </td>
            <td class="pointer text-center">
                <input type="number" name="min_count" id="min_count" value="{$relation.min_count}">
            </td>
            <td class="text-center">
                <input type="number" name="product_count" id="product_count" value="{$relation.product_count}">
            </td>
            <td class="text-center">
                <select name="type_order_day" class="selectpicker">
                    <option>Select</option>
                    <option value="1" {if $relation.type_order_day == 1}selected{/if}>Days week</option>
                    <option value="2" {if $relation.type_order_day == 2}selected{/if}>Days month</option>
                </select>

                <div class="select-days-week no-active">
                    <div class="weekday-select" data-name="order_day" id="days_{$relation.id_relations}">
                        <div class="week-parts">
                            <label>
                                <input type="checkbox" data-values="0,1,2,3,4,5,6"> Any day
                            </label>
                            <label>
                                <input type="checkbox" data-values="0,6"> Weekends
                            </label>
                            <label>
                                <input type="checkbox" data-values="1,2,3,4,5"> Weekdays
                            </label>
                        </div>
                        <div class="days">
                            <label>
                                <input type="checkbox" value="1"
                                       {if $relation.type_order_day ==1 && preg_match('/"1"/',$relation.order_day)}checked{/if}
                                       name="order_day"> Monday
                            </label>
                            <label>
                                <input type="checkbox" value="2"
                                       {if $relation.type_order_day ==1 && preg_match('/"2"/',$relation.order_day)}checked{/if}
                                       name="order_day"> Tuesday
                            </label>
                            <label>
                                <input type="checkbox" value="3"
                                       {if $relation.type_order_day ==1 && preg_match('/"3"/',$relation.order_day)}checked{/if}
                                       name="order_day"> Wednesday
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"4"/',$relation.order_day)}checked{/if}
                                       value="4" name="order_day"> Thursday
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"5"/',$relation.order_day)}checked{/if}
                                       value="5" name="order_day"> Friday
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"6"/',$relation.order_day)}checked{/if}
                                       value="6" name="order_day"> Saturday
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"7"/',$relation.order_day)}checked{/if}
                                       value="0" name="order_day"> Sunday
                            </label>
                        </div>
                    </div>
                </div>
                <div class="select-days-month no-active">
                    <table class="ui-datepicker-calendar">
                        <thead>
                        <tr>
                            <th scope="col" class="ui-datepicker-week-end"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" class="ui-datepicker-week-end"></th>
                        </tr>
                        </thead>
                        <tbody class="month_days_{$relation.id_relations}">
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"1"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">1</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"2"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">2</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"3"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">3</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"4"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">4</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"5"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">5</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"6"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">6</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"7"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">7</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"8"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">8</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"9"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">9</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"10"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">10</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"11"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">11</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"12"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">12</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"13"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">13</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"14"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">14</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"15"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">15</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"16"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">16</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"17"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">17</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"18"/',$relation.order_day)}ui-state-active{/if}" href="#">18</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"19"/',$relation.order_day)}ui-state-active{/if}" href="#">19</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"20"/',$relation.order_day)}ui-state-active{/if}" href="#">20</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"21"/',$relation.order_day)}ui-state-active{/if}" href="#">21</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"22"/',$relation.order_day)}ui-state-active{/if}" href="#">22</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"23"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">23</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"24"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">24</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"25"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">25</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"26"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">26</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"27"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">27</a></td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"28"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">28</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"29"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">29</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"30"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">30</a></td>
                            <td class="">
                                <a class="ui-state-default
                                {if $relation.type_order_day ==2 &&
                                preg_match('/"31"/',$relation.order_day)}ui-state-active{/if}
                                " href="#">31</a>
                            </td>
                            <td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">
                                &nbsp;</td>
                            <td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">
                                &nbsp;</td>
                            <td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">
                                &nbsp;</td>
                            <td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">
                                &nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
</div>
<td class="text-right">
    <button type="button" class="btn-xs btn btn-primary update-relation">Update</button>
</td>
<td class="text-left">
    <button type="button" class="btn-xs btn btn-primary delete-relation">Delete</button>
</td>
</tr>
{/foreach}
{if $pages>1}
    <nav aria-label="...">
        <ul class="pagination pagination-sm" data-sel="{$select}" data-count="{$pages}">
            <li class="page-item {if $select == 1}disabled{/if}">
                <a class="page-link" data-page="-1">Previous</a>
            </li>
            {for $page=1 to $pages}
                <li class="page-item {if $select==$page}active{/if}"><a class="page-link"
                                                                        data-page="{$page}">{$page}</a></li>
            {/for}
            <li class="page-item {if $select == $pages}disabled{/if}">
                <a class="page-link" data-page="+1">Next</a>
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