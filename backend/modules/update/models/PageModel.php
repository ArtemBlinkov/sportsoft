<?php

namespace backend\modules\update\models;

use Yii;
use yii\base\Model;

class PageModel extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    const SCENARIO_NEW = 'new';

    public $id;
    public $slug;
    public $title;
    public $body;
    public $view;
    public $status;
    public $created_at;
    public $updated_at;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['status'], 'integer'],
            [['slug'], 'checkUniqueSlug', 'on' => self::SCENARIO_NEW],
            [['slug'], 'string', 'max' => 2048],
            [['title'], 'string', 'max' => 512],
            [['view'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'body' => Yii::t('common', 'Body'),
            'view' => Yii::t('common', 'Page View'),
            'status' => Yii::t('common', 'Active'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return array statuses list
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_DRAFT => Yii::t('common', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('common', 'Published'),
        ];
    }

    /**
     * Check unique slug
     */
    public function checkUniqueSlug()
    {
        if (PageRecord::existsSlug($this->slug)) {
            $this->addError('slug', 'This slug already exists');
        }
    }
}
