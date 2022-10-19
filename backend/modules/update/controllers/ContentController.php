<?php

namespace backend\modules\update\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\db\StaleObjectException;
use backend\modules\update\models\PageModel;
use backend\modules\update\models\PageRecord;
use backend\modules\update\models\SearchModel;
use backend\modules\update\models\SearchRecord;

class ContentController extends Controller
{
    /**
     * @return string
     */
    public function actionPages(): string
    {
        $searchModel = new SearchModel();
        $dataProvider = SearchRecord::search(Yii::$app->request->queryParams, $searchModel);

        return $this->render('pages', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionUpdate($id)
    {
        $record = PageRecord::findOne($id);
        $model = new PageModel($record);

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $record->setProperty($model);

                if ($record->update()) return $this->redirect(['pages']);
            }
        }

        return $this->render('edit', [
            'model' => $model,
            'isNewRecord' => $record->isNewRecord
        ]);
    }
}
