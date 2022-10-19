<?php

namespace backend\modules\update\models;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\query\PageQuery;

/**
 * This is the ActiveRecord class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string $view
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class PageRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => true
            ]
        ];
    }

    /**
     * @return PageQuery
     */
    public static function find(): PageQuery
    {
        return new PageQuery(get_called_class());
    }

    /** `
     * @param $model
     */
    public function setProperty($model)
    {
        $this->id = $model->id;
        $this->title = $model->title;
        $this->body = $model->body;
        $this->view = $model->view;
        $this->status = $model->status;
        $this->view = $model->view;
    }

    /**
     * @param $slug
     * @return bool
     */
    public static function existsSlug($slug): bool
    {
        $count = static::find()->where(['slug' => $slug])->count();
        return $count > 0;
    }
}
