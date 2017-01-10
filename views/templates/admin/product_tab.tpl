<div id="provider-product-tab" class="panel product-tab">
    <h3 class="tab">{l s='Product Provider' mod='autorestocking'}</h3>
    <input type="hidden" name="provider_save" value="provider_save" >
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="min_count">Auto-order count</label>
        <div class="col-lg-3">
          <input type="number" name="min_count" id="min_count" value="{$autorestocking.min_count}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1"><span class="pull-right"></span></div>
        <label class="control-label col-lg-2" for="provider">Provider</label>
        <div class="col-lg-3">
            <select name="provider" id="provider">
                <option value=""></option>
                {foreach from=$providers item=provider}
                    <option {if $autorestocking.provider_id == $provider.id_providers}selected{/if} value="{$provider.id_providers}" >{$provider.name}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="panel-footer">
        <a href="{Context::getContext()->link->getAdminLink('AdminProducts')|escape:'htmlall':'UTF-8'}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='wtproductadditionalfields'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save' mod='wtproductadditionalfields'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay' mod='wtproductadditionalfields'}</button>
    </div>
</div>