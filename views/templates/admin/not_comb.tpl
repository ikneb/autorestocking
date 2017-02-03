{**
* 2016 WeeTeam
*
* @author    WeeTeam
* @copyright 2016 WeeTeam
* @license   http://www.gnu.org/philosophy/categories.html (Shareware)
*}

<div id="provider-product-tab" class="panel product-tab"
     data-atrt="99999999"
     data-comb="0" data-cat="{$id_category_default|escape:'htmlall':'UTF-8'}"
     data-rel="{if $relations.id_relations}{$relations.id_relations|escape:'htmlall':'UTF-8'}{/if}"
     data-prod="{$id_product|escape:'htmlall':'UTF-8'}">
    <h3 class="tab">{l s='Product Provider' mod='autorestocking'}</h3>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="provider">{l s='Provider'  mod=autorestocking}</label>
        <div class="col-lg-3">
            <select name="id_provider" id="id_provider">
                <option value=""></option>
                {foreach from=$providers item=provider}
                    <option {if $relations.id_provider == $provider.id_providers}selected{/if}
                            value="{$provider.id_providers|escape:'htmlall':'UTF-8'}">{$provider.name|escape:'htmlall':'UTF-8'}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="min_count">{l s='Auto-order count'  mod=autorestocking}</label>
        <div class="col-lg-1">
            <input type="number" name="min_count" id="min_count"
                   value="{if $relations}{$relations.min_count|escape:'htmlall':'UTF-8'}{else}{/if}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="product_count">{l s='Product count'  mod=autorestocking}</label>
        <div class="col-lg-1">
            <input type="number" name="product_count" id="product_count"
                   value="{if $relations}{$relations.product_count|escape:'htmlall':'UTF-8'}{else}{/if}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-3">
            {l s='Send'  mod=autorestocking}
        </label>
        <div class="col-lg-1 text-center">
            <select name="type_order_day" class="selectpicker">
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
                                   name="order_day"> Monday
                        </label>
                        <label>
                            <input type="checkbox" value="2"
                                   {if $relations.type_order_day ==1 && preg_match('/"2"/',$relations.order_day)}checked{/if}
                                   name="order_day"> Tuesday
                        </label>
                        <label>
                            <input type="checkbox" value="3"
                                   {if $relations.type_order_day ==1 && preg_match('/"3"/',$relations.order_day)}checked{/if}
                                   name="order_day"> Wednesday
                        </label>
                        <label>
                            <input type="checkbox"
                                   {if $relations.type_order_day ==1 && preg_match('/"4"/',$relations.order_day)}checked{/if}
                                   value="4" name="order_day"> Thursday
                        </label>
                        <label>
                            <input type="checkbox"
                                   {if $relations.type_order_day ==1 && preg_match('/"5"/',$relations.order_day)}checked{/if}
                                   value="5" name="order_day"> Friday
                        </label>
                        <label>
                            <input type="checkbox"
                                   {if $relations.type_order_day ==1 && preg_match('/"6"/',$relations.order_day)}checked{/if}
                                   value="6" name="order_day"> Saturday
                        </label>
                        <label>
                            <input type="checkbox"
                                   {if $relations.type_order_day ==1 && preg_match('/"7"/',$relations.order_day)}checked{/if}
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
    </div>

    <div class="panel-footer">
        <a href="{Context::getContext()->link->getAdminLink('AdminProducts')|escape:'htmlall':'UTF-8'}"
           class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel'  mod=autorestocking}
        </a>
        <button type="submit" name="submitCombination" class="btn btn-default pull-right submitCombination"><i
                    class="process-icon-save"></i> {l s='Save'  mod=autorestocking}</button>
    </div>
</div>
