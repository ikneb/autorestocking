{**
* 2016 WeeTeam
*
* @author    WeeTeam
* @copyright 2016 WeeTeam
* @license   http://www.gnu.org/philosophy/categories.html (Shareware)
*}

<div class="row product-tab" data-atrt="99999999"
     data-cat="{$id_category_default|escape:'htmlall':'UTF-8'}"
     data-rel="{if $relations.id_relations}{$relations.id_relations|escape:'htmlall':'UTF-8'}{/if}"
     data-comb="--"
     data-prod="{$id_product|escape:'htmlall':'UTF-8'}">
    <div class="col-md-3">
        <label class="form-control-label">{l s='Provider'  mod=autorestocking}</label>
        <select id="id_provider" name="id_provider" class="form-control select2-hidden-accessible" data-toggle="select2"
                tabindex="-1" aria-hidden="true">
            <option value="0"></option>
            {foreach from=$providers item=provider}
                <option {if $relations.id_provider == $provider.id_providers}selected{/if}
                        value="{$provider.id_providers|escape:'htmlall':'UTF-8'}">{$provider.name|escape:'htmlall':'UTF-8'}</option>
            {/foreach}
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-control-label">{l s='Auto-order count'  mod=autorestocking}</label>
        <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
        <input type="text" id="min_count" name="min_count" required="required" class="form-control"
               value="{if $relations}{$relations.min_count|escape:'htmlall':'UTF-8'}{/if}">
    </div>
    <div class="col-md-2">
        <label class="form-control-label">{l s='Product count'  mod=autorestocking}</label>
        <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
        <input type="text" id="product_count" name="product_count" required="required" class="form-control"
               value="{if $relations}{$relations.product_count|escape:'htmlall':'UTF-8'}{/if}">
    </div>

    <div class="col-md-3 text-center">
        <label class="form-control-label">{l s='Send'  mod=autorestocking}</label>
        <select name="type_order_day" class="selectpicker new-product-select-type-order">
            <option value="0">{l s='Select' mod=autorestocking}</option>
            <option value="1" {if $relations.type_order_day == 1}selected{/if}>{l s='Days week'  mod=autorestocking}</option>
            <option value="2" {if $relations.type_order_day == 2}selected{/if}>{l s='Days month'  mod=autorestocking}</option>
        </select>

        <div class="select-days-week no-active">
            <div class="weekday-select" data-name="order_day" id="days_99999999">
                <div class="week-parts">
                    <label>
                        <input type="checkbox" data-values="0,1,2,3,4,5,6"> {l s='Any day'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox" data-values="0,6"> {l s='Weekends'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox" data-values="1,2,3,4,5"> {l s='Weekdays'  mod=autorestocking}
                    </label>
                </div>
                <div class="days">
                    <label>
                        <input type="checkbox" value="1"
                               {if $relations.type_order_day ==1 && preg_match('/"1"/',$relations.order_day)}checked{/if}
                               name="order_day"> {l s='Monday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox" value="2"
                               {if $relations.type_order_day ==1 && preg_match('/"2"/',$relations.order_day)}checked{/if}
                               name="order_day"> {l s='Tuesday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox" value="3"
                               {if $relations.type_order_day ==1 && preg_match('/"3"/',$relations.order_day)}checked{/if}
                               name="order_day">{l s='Wednesday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox"
                               {if $relations.type_order_day ==1 && preg_match('/"4"/',$relations.order_day)}checked{/if}
                               value="4" name="order_day"> {l s='Thursday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox"
                               {if $relations.type_order_day ==1 && preg_match('/"5"/',$relations.order_day)}checked{/if}
                               value="5" name="order_day"> {l s='Friday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox"
                               {if $relations.type_order_day ==1 && preg_match('/"6"/',$relations.order_day)}checked{/if}
                               value="6" name="order_day">{l s='Saturday'  mod=autorestocking}
                    </label>
                    <label>
                        <input type="checkbox"
                               {if $relations.type_order_day ==1 && preg_match('/"7"/',$relations.order_day)}checked{/if}
                               value="0" name="order_day"> {l s='Sunday'  mod=autorestocking}
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
                <tbody class="month_days_">
                <tr>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"1"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">1</a></td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"2"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">2</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"3"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">3</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"4"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">4</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"5"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">5</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"6"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">6</a>
                    </td>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"7"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">7</a>
                    </td>
                </tr>
                <tr>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"8"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">8</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"9"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">9</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"10"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">10</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"11"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">11</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"12"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">12</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"13"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">13</a>
                    </td>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"14"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">14</a>
                    </td>
                </tr>
                <tr>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"15"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">15</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"16"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">16</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"17"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">17</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"18"/',$relations.order_day)}ui-state-active{/if}" href="#">18</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"19"/',$relations.order_day)}ui-state-active{/if}" href="#">19</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"20"/',$relations.order_day)}ui-state-active{/if}" href="#">20</a>
                    </td>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"21"/',$relations.order_day)}ui-state-active{/if}" href="#">21</a>
                    </td>
                </tr>
                <tr>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"22"/',$relations.order_day)}ui-state-active{/if}" href="#">22</a></td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"23"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">23</a></td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"24"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">24</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"25"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">25</a></td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"26"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">26</a></td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"27"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">27</a></td>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"28"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">28</a>
                    </td>
                </tr>
                <tr>
                    <td class=" ui-datepicker-week-end ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"29"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">29</a>
                    </td>
                    <td class=" ">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"30"/',$relations.order_day)}ui-state-active{/if}
                                " href="#">30</a></td>
                    <td class="">
                        <a class="ui-state-default
                                {if $relations.type_order_day ==2 &&
                        preg_match('/"31"/',$relations.order_day)}ui-state-active{/if}
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
    </div>
    <div class="col-md-2">
        <label class="form-control-label"></label>
        <input type="submit" class="btn btn-primary save uppercase save-relation-new submitCombination" value="{l s='Save'  mod=autorestocking}">
    </div>
</div>
