{if !empty($relations)}
    {foreach from=$relations item=relation}
        <div class="row">
            <form id="relation_form" class="defaultForm form-horizontal relationForm"  method="post" enctype="multipart/form-data" novalidate="">
                <input type="hidden" name="submitAddrelation" value="1">
                <div class="panel" id="fieldset_0">
                    <div class="panel-heading">
                        <i class="icon-briefcase"></i> {$relation.name|escape:'htmlall':'UTF-8'}
                    </div>
                    <div class="form-wrapper">
                        <input type="hidden" name="id_providers" id="id_provid" value="{$id_providers|escape:'htmlall':'UTF-8'}">
                        <input type="hidden" name="id_product" id="id_product" value="{$relation.id_product|escape:'htmlall':'UTF-8'}">
                        <input type="hidden" name="id_relations" id="id_relations" value="{$relation.id_relations|escape:'htmlall':'UTF-8'}">

                        <div class="row">
                            <label class="control-label col-lg-2 ">
                                Min</label>
                            <div class="col-lg-2 col-md-2">
                                <input type="text" name="min_count" id="min_count" value="{$relation.min_count|escape:'htmlall':'UTF-8'}" class="">
                            </div>
                            <label class="control-label col-lg-2 ">
                                Count</label>
                            <div class="col-lg-2 col-md-2">
                                <input type="text" name="product_count" id="product_count" value="{$relation.product_count|escape:'htmlall':'UTF-8'}" class="">
                            </div>


                            <label class="control-label col-lg-2">
                                Send
                            </label>
                            <div class="col-lg-2 col-md-2">
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


                    </div><!-- /.form-wrapper -->
                    <div class="panel-footer">
                        <button type="submit" value="1" id="providers_form_submit_btn" name="submitAddproviders" class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> Сохранить
                        </button>
                        <a href="index.php?controller=AdminProviders&amp;token=0f0bb702af1521fecfae53fdd682e2aa" class="btn btn-default" onclick="window.history.back();">
                            <i class="process-icon-cancel"></i> Отмена
                        </a>
                    </div>
                </div>
            </form>
        </div>
    {/foreach}
{else}
    <h4>You need add relation</h4>
{/if}