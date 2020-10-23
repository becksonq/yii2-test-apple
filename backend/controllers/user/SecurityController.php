<?php


namespace backend\controllers\user;

use dektrium\user\controllers\SecurityController as BaseSecurityController;

/**
 * Class AdminController
 * @package backend\controllers\user
 */
class SecurityController extends BaseSecurityController
{
    public $layout = '@backend/themes/apples/views/layouts/blank';
}