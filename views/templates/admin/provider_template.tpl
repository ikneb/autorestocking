
<div class="row">
    <div class="col-lg-2 col-md-3">
        <div class="list-group">
            <a class="list-group-item active" data-toggle="tab" id="linkProvider" href="#provider">Provider</a>
            <a class="list-group-item " data-toggle="tab" id="linkRelation" href="#relation">Relation</a>
            <a class="list-group-item " data-toggle="tab" id="linkAddRelation" href="#addRelation">Add relation</a>
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
                                <textarea name="description" id="description" class="textarea-autosize">{$description|escape:'htmlall':'UTF-8'}</textarea>
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
             <div class="col-md-12 place-add-relation">

            </div>
        </div>
        <div id="addRelation" class="tab-pane col-lg-9">
                <div class="col-lg-6">
                    <form id="addRelationProductForm"  class="defaultForm form-horizontal"  method="post" enctype="multipart/form-data" novalidate="">
                        <input type="hidden" name="submitProductRelation" value="1">
                        <div class="panel" id="fieldset_0">
                            <div class="panel-heading">
                                <i class="icon-briefcase"></i>Check Product
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 ">
                                    Search and add product</label>
                                <div id="">
                                    <div class="input-group" style="padding-left: 50px">
                                        <input type="text" id="related_product_autocomplete_input" name="product_autocomplete" autocomplete="on"/>
                                        <span class="input-group-addon"><i class="icon-search"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" value="1"  name="submitProductRelation" class="btn btn-default pull-right">
                                    <i class="process-icon-save"></i> Сохранить
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-6">
                    <form id="addRelationForm"  class="defaultForm form-horizontal"  method="post" enctype="multipart/form-data" novalidate="">
                        <input type="hidden" name="submitRelation" value="1">
                        <div class="panel" id="fieldset_0">
                            <div class="panel-heading">
                                <i class="icon-briefcase"></i>Check Category
                            </div>
                            <div class="form-group">
                                {$tree}
                            </div>
                            <div class="panel-footer">
                                <button type="submit" value="1"  name="submitRelation" class="btn btn-default pull-right">
                                    <i class="process-icon-save"></i> Сохранить
                                </button>
                                {* <a href="index.php?controller=AdminProviders&amp;token=0f0bb702af1521fecfae53fdd682e2aa" class="btn btn-default" onclick="window.history.back();">
                                     <i class="process-icon-cancel"></i> Отмена
                                 </a>*}
                            </div>
                        </div>
                    </form>
                </div>
            </diw>
        </div>
</div>
