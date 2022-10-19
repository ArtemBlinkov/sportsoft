<?php

namespace backend\modules\update\models;

class SearchModel extends PageModel
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['slug', 'title', 'body'], 'safe']
        ];
    }
}
