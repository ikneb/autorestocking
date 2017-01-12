
<div id="provider-product-tab" class="panel product-tab">
    <h3 class="tab">{l s='Product Provider' mod='autorestocking'}</h3>
    <input type="hidden" name="provider_save" value="provider_save" >
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="provider">Provider</label>
        <div class="col-lg-3">
            <select name="id_provider" id="id_provider">
                <option value=""></option>
                {foreach from=$providers item=provider}
                    <option {if $relation.id_provider == $provider.id_providers}selected{/if} value="{$provider.id_providers}" >{$provider.name}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="min_count">Auto-order count</label>
        <div class="col-lg-1">
          <input type="number" name="min_count" id="min_count" value="{$relation.min_count}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="product_count">Product count</label>
        <div class="col-lg-1">
            <input type="number" name="product_count" id="product_count" value="{$relation.product_count}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-3">
            Send
        </label>
        <div class="col-lg-1">
            <select name="order_day" class="selectpicker">
                <option value="0"></option>
                <option value="1" {if $relation.order_day == 1}selected{/if}>Mon</option>
                <option value="2" {if $relation.order_day == 2}selected{/if}>Tue</option>
                <option value="3" {if $relation.order_day == 3}selected{/if}>Wed</option>
                <option value="4" {if $relation.order_day == 4}selected{/if}>Thu</option>
                <option value="5" {if $relation.order_day == 5}selected{/if}>Fri</option>
                <option value="6" {if $relation.order_day == 6}selected{/if}>Sat</option>
                <option value="7" {if $relation.order_day == 7}selected{/if}>Sun</option>
            </select>
        </div>
    </div>

    <div class="panel-footer">
        <a href="{Context::getContext()->link->getAdminLink('AdminProducts')|escape:'htmlall':'UTF-8'}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='wtproductadditionalfields'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save' mod='wtproductadditionalfields'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay' mod='wtproductadditionalfields'}</button>
    </div>
</div>
