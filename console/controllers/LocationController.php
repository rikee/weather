<?php

namespace console\controllers;

use Yii;
use common\models\Location;
use yii\console\Controller;

class LocationController extends Controller
{
    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne($id)) !== null) {
            return $model;
        } else {
            return Controller::EXIT_CODE_ERROR;
        }
    }

    public function actionImportPastData($id)
    {
        $model = $this->findModel($id);
        $model->importPastData();

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionImportYesterdayData()
    {
        $model = new Location();
        $model->importAllDayData(date('Y-m-d', strtotime("-1 day")));

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionImportDayData($date)
    {
        $model = new Location();
        $model->importAllDayData($date);

        return Controller::EXIT_CODE_NORMAL;
    }
}