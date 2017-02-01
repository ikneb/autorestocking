<?php
/**
 * 2016 WeeTeam
 *
 * @author    WeeTeam
 * @copyright 2016 WeeTeam
 * @license   http://www.gnu.org/philosophy/categories.html (Shareware)
 */

require_once(dirname(__FILE__) . '../../../config/config.inc.php');
require_once(dirname(__FILE__) . '../../../init.php');
require_once(dirname(__FILE__) . '/classes/Relation.php');

$sql = 'SELECT id_sent_email FROM `' . _DB_PREFIX_ . 'sent_email` WHERE token = "'. Tools::getValue('token').'"';
$token = Db::getInstance()->getValue($sql);

if ($token == 0) {
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Status order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="/modules/autorestocking/views/css/status.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="/modules/autorestocking/views/js/url.js"></script>
</head>
<body>
<div class="wrapper">
    <button type="button" class="btn btn-primary btn-lg status" data-status="1"
            data-order="<?php echo Tools::getValue('id_order') ?>"
            data-provider="<?php echo Tools::getValue('provider') ?>"
            data-product="<?php echo Tools::getValue('product') ?>"
            data-email="<?php echo Tools::getValue('id_email') ?>"
        >Order in
        processing
    </button>
    <button type="button" class="btn btn-secondary btn-lg status" data-status="2"
            data-order="<?php echo Tools::getValue('id_order') ?>"
            data-provider="<?php echo Tools::getValue('provider') ?>"
            data-product="<?php echo Tools::getValue('product') ?>"
            data-email="<?php echo Tools::getValue('id_email') ?>"
            data-list='<?php echo Tools::getValue('relation_list') ?>'
        >Order
        send
    </button>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Status</h4>
            </div>
            <div class="modal-body">Status has changed</div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>