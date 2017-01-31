<div class="panel" id="fieldset_0">
    <div class="panel-heading">
        <i class="icon-briefcase"></i>{l s='Relation'  mod=autorestocking}
    </div>
    {if !empty($relations)}
    <table id="table-product" class="table product">
        <thead>
        <tr class="nodrag nodrop">
            <th class="fixed-width-xs center">
                <span class="title_box active">{l s='ID' mod=autorestocking} </span>
            </th>
            <th class="">
                <span class="title_box">{l s='Name'  mod=autorestocking}</span>
            </th>
            <th class="text-center">
                <span class="title_box">{l s='Balance'  mod=autorestocking}</span>
            </th>
            <th class=" text-left">
                <span class="title_box">{l s='Min quantity' mod=autorestocking}</span>
            </th>
            <th class=" text-left">
                <span class="title_box">{l s='Order quantity' mod=autorestocking}</span>
            </th>
            <th class=" text-center">
                <span class="title_box">{l s='Order day'  mod=autorestocking}</span>
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
            <input type="hidden" name="id_relation" value="{$relation.id_relations|escape:'htmlall':'UTF-8'}">
            <td class="pointer fixed-width-xs center">
                {$relation.id_relations|escape:'htmlall':'UTF-8'}
            </td>
            <td class="pointer text-left">
                {$relation.name|escape:'htmlall':'UTF-8'} {$relation.name_combination|escape:'htmlall':'UTF-8'}
            </td>
            <td class="pointer text-center">
                {if $relation.id_product_attribute == 0}{$relation.product_quantity|escape:'htmlall':'UTF-8'}{else}{$relation.attribute_quantity|escape:'htmlall':'UTF-8'}{/if}
            </td>
            <td class="pointer text-center">
                <input type="number" name="min_count" id="min_count" value="{$relation.min_count|escape:'htmlall':'UTF-8'}">
            </td>
            <td class="text-center">
                <input type="number" name="product_count" id="product_count" value="{$relation.product_count|escape:'htmlall':'UTF-8'|escape:'htmlall':'UTF-8'}">
            </td>
            <td class="text-center">
                <select name="type_order_day" class="selectpicker">
                    <option>Select</option>
                    <option value="1" {if $relation.type_order_day == 1}selected{/if}>{l s='Days week' mod=autorestocking}</option>
                    <option value="2" {if $relation.type_order_day == 2}selected{/if}>{l s='Days month' mod=autorestocking}</option>
                </select>

                <div class="select-days-week no-active">
                    <div class="weekday-select" data-name="order_day" id="days_{$relation.id_relations|escape:'htmlall':'UTF-8'}">
                        <div class="week-parts">
                            <label>
                                <input type="checkbox" data-values="0,1,2,3,4,5,6">{l s='Any day' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox" data-values="0,6">{l s='Weekends' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox" data-values="1,2,3,4,5">{l s='Weekdays' mod=autorestocking}
                            </label>
                        </div>
                        <div class="days">
                            <label>
                                <input type="checkbox" value="1"
                                       {if $relation.type_order_day ==1 && preg_match('/"1"/',$relation.order_day)}checked{/if}
                                       name="order_day">{l s='Monday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox" value="2"
                                       {if $relation.type_order_day ==1 && preg_match('/"2"/',$relation.order_day)}checked{/if}
                                       name="order_day">{l s='Tuesday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox" value="3"
                                       {if $relation.type_order_day ==1 && preg_match('/"3"/',$relation.order_day)}checked{/if}
                                       name="order_day">{l s='Wednesday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"4"/',$relation.order_day)}checked{/if}
                                       value="4" name="order_day">{l s='Thursday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"5"/',$relation.order_day)}checked{/if}
                                       value="5" name="order_day">{l s='Friday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"6"/',$relation.order_day)}checked{/if}
                                       value="6" name="order_day">{l s='Saturday' mod=autorestocking}
                            </label>
                            <label>
                                <input type="checkbox"
                                       {if $relation.type_order_day ==1 && preg_match('/"7"/',$relation.order_day)}checked{/if}
                                       value="0" name="order_day">{l s='Sunday' mod=autorestocking}
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
                        <tbody class="month_days_{$relation.id_relations|escape:'htmlall':'UTF-8'}">
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
    <button type="button" class="btn-xs btn btn-primary update-relation">{l s='Update' mod=autorestocking}</button>
</td>
<td class="text-left">
    <button type="button" class="btn-xs btn btn-primary delete-relation">{l s='Delete' mod=autorestocking}</button>
</td>
</tr>
{/foreach}
{if $pages>1}
    <nav aria-label="...">
        <ul class="pagination pagination-sm" data-sel="{$select|escape:'htmlall':'UTF-8'}" data-count="{$pages|escape:'htmlall':'UTF-8'}">
            <li class="page-item {if $select == 1}disabled{/if}">
                <a class="page-link" data-page="-1">{l s='Previous' mod=autorestocking}</a>
            </li>
            {for $page=1 to $pages}
                <li class="page-item {if $select==$page}active{/if}"><a class="page-link"
                                                                        data-page="{$page|escape:'htmlall':'UTF-8'}">{$page|escape:'htmlall':'UTF-8'}</a></li>
            {/for}
            <li class="page-item {if $select == $pages}disabled{/if}">
                <a class="page-link" data-page="+1">{l s='Next' mod=autorestocking}</a>
            </li>
        </ul>
    </nav>
{/if}
</tbody>
</table>
{else}
<h4>{l s='You need add relation' mod=autorestocking}</h4>
{/if}
</div>