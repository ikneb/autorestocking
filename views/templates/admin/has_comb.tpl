{foreach from=$combinations item=combination}
    <div id="provider-product-tab" class="panel product-tab" data-atrt="{$combination.id_product_attribute}"
         data-comb="{$combination.comb}" data-cat="{$combination.id_category_default}" data-rel="{if $combination.id_relations}{$combination.id_relations}{/if}"
         data-prod="{$combination.id_product}">
        <h3 class="tab">{$combination.comb}</h3>
        <div class="row">
        <div class="col-md-6">
            <div class="col-lg-1"><span class="pull-right"></span></div>
            <label class="control-label col-lg-2" for="provider">Provider</label>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <select name="id_provider" id="id_provider">
                    <option value=""></option>
                    {foreach from=$providers item=provider}
                        <option {if $combination.id_provider == $provider.id_providers}selected{/if} value="{$provider.id_providers}" >{$provider.name}</option>
                    {/foreach}
                </select>
            </div>
            <div class="col-lg-1"><span class="pull-right"></span></div>
            <label class="control-label col-lg-2 col-md-2 col-sm-2" for="min_count">Auto-order count</label>
            <div class="col-lg-1 col-md-1 col-sm-1">
                <input type="number" name="min_count" id="min_count" value="{if $combination.min_count}{$combination.min_count}{/if}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-lg-1"><span class="pull-right"></span></div>
            <label class="control-label col-lg-2 col-md-2 col-sm-2" for="product_count">Product count</label>
            <div class="col-lg-1 col-md-1 col-sm-1">
                <input type="number" name="product_count" id="product_count" value="{if $combination.product_count}{$combination.product_count}{/if}">
            </div>

            <label class="control-label col-lg-3">
                Send
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <select name="order_day" class="selectpicker">
                    <option value="0"></option>
                    <option value="1" {if $combination.order_day && $combination.order_day == 1}selected{/if}>Mon</option>
                    <option value="2" {if $combination.order_day && $combination.order_day == 2}selected{/if}>Tue</option>
                    <option value="3" {if $combination.order_day && $combination.order_day == 3}selected{/if}>Wed</option>
                    <option value="4" {if $combination.order_day && $combination.order_day == 4}selected{/if}>Thu</option>
                    <option value="5" {if $combination.order_day && $combination.order_day == 5}selected{/if}>Fri</option>
                    <option value="6" {if $combination.order_day && $combination.order_day == 6}selected{/if}>Sat</option>
                    <option value="7" {if $combination.order_day && $combination.order_day == 7}selected{/if}>Sun</option>
                </select>
            </div>
            <button type="button"  class="btn btn-default pull-right submitCombination"><i class="process-icon-save"></i> {l s='Save' mod='wtproductadditionalfields'}</button>
        </div>
        </div>
    </div>
{/foreach}