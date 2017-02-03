{**
* 2016 WeeTeam
*
* @author    WeeTeam
* @copyright 2016 WeeTeam
* @license   http://www.gnu.org/philosophy/categories.html (Shareware)
*}

<div class="row">
    <div class="col-lg-2 col-md-3">
        <div class="list-group">
            <a class="list-group-item active" data-toggle="tab" id="linkProvider" href="#provider">{l s='Provider' mod=autorestocking}</a>
            <a class="list-group-item " data-toggle="tab" id="linkRelation" href="#relation">{l s='Relation' mod=autorestocking}</a>
            <a class="list-group-item " data-toggle="tab" id="linkAddRelation"
               href="#addRelation">{l s='Add relation' mod=autorestocking}</a>
        </div>
    </div>
    <div class="tab-content">
        <div id="provider" class="tab-pane col-lg-9 active">
            <form id="providers_form" class="defaultForm form-horizontal AdminProviders" method="post"
                  enctype="multipart/form-data" novalidate="">
                <input type="hidden" name="submitAddproviders" value="1">
                <div class="panel" id="fieldset_0">
                    <div class="panel-heading">
                        <i class="icon-briefcase"></i>{l s='Providers' mod=autorestocking}
                    </div>
                    <div class="form-wrapper">
                        <input type="hidden" name="id_providers" id="id_providers"
                               value="{$id_providers|escape:'htmlall':'UTF-8'}">
                        <div class="form-group">
                            <label class="control-label col-lg-3 required">
                                {l s='Name'  mod=autorestocking}</label>
                            <div class="col-lg-3">
                                <input type="text" name="name" id="name" value="{$name|escape:'htmlall':'UTF-8'}"
                                       class="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">
                                {l s='Description'  mod=autorestocking}
                            </label>
                            <div class="col-lg-3">
                                <textarea name="description" id="description"
                                          class="textarea-autosize">{$description|escape:'htmlall':'UTF-8'}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 required">
                                <span class="label-tooltip" data-toggle="tooltip" data-html="true"
                                      title="">{l s='Email'  mod=autorestocking}</span>
                            </label>
                            <div class="col-lg-3">
                                <input type="text" name="email" id="email" value="{$email|escape:'htmlall':'UTF-8'}"
                                       class="" required="required">
                            </div>
                        </div>
                    </div><!-- /.form-wrapper -->
                    <div class="panel-footer">
                        <button type="submit" value="1" id="providers_form_submit_btn" name="submitAddproviders"
                                class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> {l s='Save'  mod=autorestocking}
                        </button>
                        <a href="index.php?controller=AdminProviders&amp;token=0f0bb702af1521fecfae53fdd682e2aa"
                           class="btn btn-default" onclick="window.history.back();">
                            <i class="process-icon-cancel"></i> {l s='Cansel'  mod=autorestocking}
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div id="relation" class="tab-pane col-md-9 ">
            <div class="col-md-12 place-add-relation">

            </div>
        </div>
        <div id="addRelation" class="tab-pane col-lg-9 ">
            <div class="col-lg-6">
                <div class="panel" id="fieldset_0">
                    <div class="panel-heading">
                        <i class="icon-briefcase"></i> {l s='Check Product' mod=autorestocking}
                    </div>
                    <div class="form-group search-product">
                        <label class="control-label col-lg-3 ">
                            {l s='Search and add product' mod=autorestocking}</label>
                        <div class="input-group row">
                            <input type="text" id="related_product_autocomplete_input" name="product_autocomplete"/>
                            <span class="input-group-addon"><i class="icon-search"></i></span>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary add-product">{l s='Add product' mod=autorestocking}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {hook h="displayHelperTree"}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <input type="hidden" name="submitAddRelation" value="1">
                <div class="panel" id="fieldset_0">
                    <div class="panel-heading">
                        <i class="icon-briefcase"></i> {l s='Save' mod=autorestocking}
                    </div>
                    <ul class="list-group product-list" id="product-list">
                        <li class="list-group-item justify-content-between"><span class="name-product">{l s='ID' mod=autorestocking}</span>
                            <span class="name-product">{l s='Name' mod=autorestocking}</span><span
                                    class="badge badge-default badge-pill">{l s='Save' mod=autorestocking}</span>
                        </li>
                    </ul>
                    <div class="panel-footer">
                        <button type="submit" value="1" id="addSubmitProduct" name="submitAddproviders"
                                class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> {l s='Save' mod=autorestocking}
                        </button>
                        <a href="index.php?controller=AdminProviders&amp;token=0f0bb702af1521fecfae53fdd682e2aa"
                           class="btn btn-default" onclick="window.history.back();">
                            <i class="process-icon-cancel"></i> {l s='Cancel' mod=autorestocking}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
