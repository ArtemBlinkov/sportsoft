<?php

namespace backend\modules\update\models;

use yii\data\ActiveDataProvider;

class SearchRecord
{
    /**
     * Creates data provider instance with search query applied
     * @param $params
     * @param $model
     * @return ActiveDataProvider
     */
    public static function search($params, $model): ActiveDataProvider
    {
        $query = PageRecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($model->load($params) && $model->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $model->id,
            'status' => $model->status,
        ])
            ->andFilterWhere(['like', 'slug', $model->slug])
            ->andFilterWhere(['like', 'title', $model->title])
            ->andFilterWhere(['like', 'body', $model->body]);

        return $dataProvider;
    }
}
