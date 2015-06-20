<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Location controller
 */
class LocationController extends ActiveController
{
    public $modelClass = 'common\models\Location';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}
