{foreach from=$combinations item=combination}
    <div class="panel product-tab" data-atrt="{$combination.id_product_attribute}"
         data-comb="{$combination.comb}" data-cat="{$combination.id_category_default}"
         data-rel="{if $combination.id_relations}{$combination.id_relations}{/if}"
         data-prod="{$combination.id_product}">
        <div class="panel-heading"><strong>{$combination.comb}</strong></div>

        <div class="row panel-body">
            <div class="col-md-3">
                <label class="form-control-label">Provider</label>
                <select id="id_provider" name="id_provider" class="form-control select2-hidden-accessible"
                        data-toggle="select2" tabindex="-1" aria-hidden="true">
                    <option value="0"></option>
                    {foreach from=$providers item=provider}
                        <option {if $combination.id_provider == $provider.id_providers}selected{/if}
                                value="{$provider.id_providers}">{$provider.name}</option>
                    {/foreach}
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-control-label">Auto-order count</label>
                <span class="help-box" data-toggle="popover" data-content="Information" data-original-title=""
                      title=""></span>
                <input type="text" id="min_count" name="min_count" required="required" class="form-control"
                       value="{if $combination}{$combination.min_count}{/if}">
            </div>
            <div class="col-md-2">
                <label class="form-control-label">Product count</label>
                <span class="help-box" data-toggle="popover" data-content="Information" data-original-title=""
                      title=""></span>
                <input type="text" id="product_count" name="product_count" required="required" class="form-control"
                       value="{if $combination}{$combination.product_count}{/if}">
            </div>

            <div class="col-md-3 text-center">
                <label class="form-control-label">Send</label>
                <select name="type_order_day" class="selectpicker">
                    <option>Select</option>
                    <option value="1" {if $combination.type_order_day == 1}selected{/if}>Days week</option>
                    <option value="2" {if $combination.type_order_day == 2}selected{/if}>Days month</option>
                </select>

                <div class="select-days-week no-active">
                    <div class="weekday-select" data-name="order_day" id="days_{$combination.id_product_attribute}">
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
                                <input type="checkbox" value="1" name="order_day"
                                       {if $combination.type_order_day ==1 && preg_match('/"1"/',$combination.order_day)}checked{/if}
                                > Monday
                            </label>
                            <label>
                                <input type="checkbox" value="2"
                                       {if $combination.type_order_day ==1 && preg_match('/"2"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Tuesday
                            </label>
                            <label>
                                <input type="checkbox" value="3"
                                       {if $combination.type_order_day ==1 && preg_match('/"3"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Wednesday
                            </label>
                            <label>
                                <input type="checkbox" value="4"
                                       {if $combination.type_order_day ==1 && preg_match('/"4"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Thursday
                            </label>
                            <label>
                                <input type="checkbox" value="5"
                                       {if $combination.type_order_day ==1 && preg_match('/"5"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Friday
                            </label>
                            <label>
                                <input type="checkbox" value="6"
                                       {if $combination.type_order_day ==1 && preg_match('/"6"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Saturday
                            </label>
                            <label>
                                <input type="checkbox" value="7"
                                       {if $combination.type_order_day ==1 && preg_match('/"7"/',$combination.order_day)}checked{/if}
                                       name="order_day"> Sunday
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
                        <tbody class="month_days_{$combination.id_product_attribute}">
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"1"/',$combination.order_day)}ui-state-active{/if}"
                                   href="#">1</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"2"/',$combination.order_day)}ui-state-active{/if}" href="#">2</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"3"/',$combination.order_day)}ui-state-active{/if}" href="#">3</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"4"/',$combination.order_day)}ui-state-active{/if}" href="#">4</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"5"/',$combination.order_day)}ui-state-active{/if}" href="#">5</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"6"/',$combination.order_day)}ui-state-active{/if}" href="#">6</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"7"/',$combination.order_day)}ui-state-active{/if}" href="#">7</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"8"/',$combination.order_day)}ui-state-active{/if}" href="#">8</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"9"/',$combination.order_day)}ui-state-active{/if}" href="#">9</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"10"/',$combination.order_day)}ui-state-active{/if}" href="#">10</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"11"/',$combination.order_day)}ui-state-active{/if}" href="#">11</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"12"/',$combination.order_day)}ui-state-active{/if}" href="#">12</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"13"/',$combination.order_day)}ui-state-active{/if}" href="#">13</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"14"/',$combination.order_day)}ui-state-active{/if}" href="#">14</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"15"/',$combination.order_day)}ui-state-active{/if}" href="#">15</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"16"/',$combination.order_day)}ui-state-active{/if}" href="#">16</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"17"/',$combination.order_day)}ui-state-active{/if}" href="#">17</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"18"/',$combination.order_day)}ui-state-active{/if}" href="#">18</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"19"/',$combination.order_day)}ui-state-active{/if}" href="#">19</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"20"/',$combination.order_day)}ui-state-active{/if}" href="#">20</a>
                            </td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"21"/',$combination.order_day)}ui-state-active{/if}" href="#">21</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"22"/',$combination.order_day)}ui-state-active{/if}" href="#">22</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"23"/',$combination.order_day)}ui-state-active{/if}" href="#">23</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"24"/',$combination.order_day)}ui-state-active{/if}" href="#">24</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"25"/',$combination.order_day)}ui-state-active{/if}" href="#">25</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"26"/',$combination.order_day)}ui-state-active{/if}" href="#">26</a></td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"27"/',$combination.order_day)}ui-state-active{/if}" href="#">27</a></td>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"28"/',$combination.order_day)}ui-state-active{/if}" href="#">28</a>
                            </td>
                        </tr>
                        <tr>
                            <td class=" ui-datepicker-week-end ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"29/',$combination.order_day)}ui-state-active{/if}" href="#">29</a>
                            </td>
                            <td class=" ">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"30"/',$combination.order_day)}ui-state-active{/if}" href="#">30</a></td>
                            <td class="">
                                <a class="ui-state-default
                                    {if $combination.type_order_day ==2 &&
                                preg_match('/"31"/',$combination.order_day)}ui-state-active{/if}" href="#">31</a>
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
                <button type="button" class="btn btn-primary save uppercase save-relation-new submitCombination">Save
                </button>
            </div>
        </div>
    </div>
{/foreach}