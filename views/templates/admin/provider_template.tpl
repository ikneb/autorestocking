<div class="row">
    <div class="col-lg-2 col-md-3">
        <div class="list-group">
            <a class="list-group-item active" data-toggle="tab" id="link-Provider" href="#provider">Provider</a>
            <a class="list-group-item " data-toggle="tab" id="link-Relation" href="#relation">Relation</a>
        </div>
    </div>
    <div class="tab-content">
        <div id="provider" class="tab-pane col-lg-9 active">
            <form id="providers_form" class="defaultForm form-horizontal AdminProviders"  method="post" enctype="multipart/form-data" novalidate="">
                <input type="hidden" name="submitAddproviders" value="1">
                <div class="panel" id="fieldset_0">
                    <div class="panel-heading">
                        <i class="icon-briefcase"></i>Providers
                    </div>
                    <div class="form-wrapper">
                        <input type="hidden" name="id_providers" id="id_providers" value="{$id_providers|escape:'htmlall':'UTF-8'}">
                        <div class="form-group">
                            <label class="control-label col-lg-3 required">
                                Name</label>
                            <div class="col-lg-3">
                                <input type="text" name="name" id="name" value="{$name|escape:'htmlall':'UTF-8'}" class="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">
                                Description
                            </label>
                            <div class="col-lg-3">
                                <textarea name="description" id="description" class="textarea-autosize" style="overflow: hidden; word-wrap: break-word; resize: none; height: 46px;">{$description|escape:'htmlall':'UTF-8'}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 required">
                                <span class="label-tooltip" data-toggle="tooltip" data-html="true" title="" >Email</span>
                            </label>
                            <div class="col-lg-3">
                                <input type="text" name="email" id="email" value="{$email|escape:'htmlall':'UTF-8'}" class="" required="required">
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
        <div id="relation" class="tab-pane col-md-9">
             <div class="col-md-12 ">
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
                                        <input type="hidden" name="id_providers" id="id_providers" value="{$id_providers|escape:'htmlall':'UTF-8'}">
                                        <input type="hidden" name="id_product" id="id_product" value="{$relation.id_product|escape:'htmlall':'UTF-8'}">
                                        <input type="hidden" name="id_relations" id="id_relations" value="{$relation.id_relations|escape:'htmlall':'UTF-8'}">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 required">
                                                Min</label>
                                            <div class="col-lg-1">
                                                <input type="text" name="min_count" id="min_count" value="{$relation.min_count|escape:'htmlall':'UTF-8'}" class="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 required">
                                                Count</label>
                                            <div class="col-lg-1">
                                                <input type="text" name="product_count" id="product_count" value="{$relation.product_count|escape:'htmlall':'UTF-8'}" class="">
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
                     <h4>You need add relative in page product</h4>
                 {/if}
            </div>
        </div>
    </div>
</div>