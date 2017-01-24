
{foreach from=$combinations item=combination}
<div class="panel product-tab" data-atrt="{$combination.id_product_attribute}"
     data-comb="{$combination.comb}" data-cat="{$combination.id_category_default}" data-rel="{if $combination.id_relations}{$combination.id_relations}{/if}"
     data-prod="{$combination.id_product}">
    <div class="panel-heading"><strong>{$combination.comb}</strong></div>

<div class="row panel-body">
    <div class="col-md-3">
        <label class="form-control-label">Provider</label>
        <select id="id_provider" name="id_provider" class="form-control select2-hidden-accessible" data-toggle="select2" tabindex="-1" aria-hidden="true">
            <option value="0"></option>
            {foreach from=$providers item=provider}
                <option {if $relations.id_provider == $provider.id_providers}selected{/if} value="{$provider.id_providers}" >{$provider.name}</option>
            {/foreach}
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-control-label">Auto-order count</label>
        <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
        <input type="text" id="min_count" name="min_count" required="required" class="form-control" value="{if $relations}{$relations.min_count}{/if}">
    </div>
    <div class="col-md-2">
        <label class="form-control-label">Product count</label>
        <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
        <input type="text" id="product_count" name="product_count" required="required" class="form-control" value="{if $relations}{$relations.product_count}{/if}">
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Send</label>
        <select id="order_day" name="order_day" class="form-control select2-hidden-accessible" data-toggle="select2" aria-hidden="true">
            <option value="0"></option>
            <option value="1" {if $relations && $relations.order_day == 1}selected{/if}>Mon</option>
            <option value="2" {if $relations && $relations.order_day == 2}selected{/if}>Tue</option>
            <option value="3" {if $relations && $relations.order_day == 3}selected{/if}>Wed</option>
            <option value="4" {if $relations && $relations.order_day == 4}selected{/if}>Thu</option>
            <option value="5" {if $relations && $relations.order_day == 5}selected{/if}>Fri</option>
            <option value="6" {if $relations && $relations.order_day == 6}selected{/if}>Sat</option>
            <option value="7" {if $relations && $relations.order_day == 7}selected{/if}>Sun</option>
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-control-label"></label>
        <input  type="submit" class="btn btn-primary save uppercase save-relation-new submitCombination" value="Save" >
    </div>
</div>
    </div>
{/foreach}