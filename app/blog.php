<?php
/**
 * Created by JetBrains PhpStorm.
 * User: patrick
 * Date: 26/10/13
 * Time: 23:22
 * To change this template use File | Settings | File Templates.
 */

use Silex\Application;

$app = new Application();
$app->get('/', function () {
    return "Hello from Blog";
});

return $app;