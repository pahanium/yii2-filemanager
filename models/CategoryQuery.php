<?php
namespace pahanium\filemanager\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Category]].
 *
 * @see Category
 */
class CategoryQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
