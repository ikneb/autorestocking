{if $version }
    {if $has_combination}
        {include file="$has_comb_tpl" }
    {else}
        {include file="$not_comb_tpl" }
    {/if}
{else}
    <div class="row">
        <div class="col-md-3">
            <label class="form-control-label">Provider</label>
            <select id="id_provider" name="id_provider" class="form-control select2-hidden-accessible" data-toggle="select2" tabindex="-1" aria-hidden="true">
                <option value="0"></option>
                {foreach from=$providers item=provider}
                    <option {if $relation.id_provider == $provider.id_providers}selected{/if} value="{$provider.id_providers}" >{$provider.name}</option>
                {/foreach}
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-control-label">Auto-order count</label>
            <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
            <input type="text" id="min_count" name="min_count" required="required" class="form-control" value="{if $relation} {$relation.min_count} {/if}">
        </div>
        <div class="col-md-2">
            <label class="form-control-label">Product count</label>
            <span class="help-box" data-toggle="popover" data-content="Information" data-original-title="" title=""></span>
            <input type="text" id="product_count" name="product_count" required="required" class="form-control" value="{if $relation}{$relation.product_count}{/if}">
        </div>

        <div class="col-md-3">
            <label class="form-control-label">Send</label>
            <select id="order_day" name="order_day" class="form-control select2-hidden-accessible" data-toggle="select2" aria-hidden="true">
                <option value="0"></option>
                <option value="1" {if $relation && $relation.order_day == 1}selected{/if}>Mon</option>
                <option value="2" {if $relation && $relation.order_day == 2}selected{/if}>Tue</option>
                <option value="3" {if $relation && $relation.order_day == 3}selected{/if}>Wed</option>
                <option value="4" {if $relation && $relation.order_day == 4}selected{/if}>Thu</option>
                <option value="5" {if $relation && $relation.order_day == 5}selected{/if}>Fri</option>
                <option value="6" {if $relation && $relation.order_day == 6}selected{/if}>Sat</option>
                <option value="7" {if $relation && $relation.order_day == 7}selected{/if}>Sun</option>
            </select>
        </div>
    </div>
{/if}
