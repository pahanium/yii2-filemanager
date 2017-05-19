<?php
namespace pahanium\filemanager\models;

use creocoder\nestedsets\NestedSetsBehavior;
use pahanium\filemanager\Module;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @method boolean appendTo(ActiveRecord $node)
 * @method boolean insertBefore(ActiveRecord $node)
 * @method boolean insertAfter(ActiveRecord $node)
 * @method boolean makeRoot($runValidation = true, $attributes = null)
 * @method ActiveQuery parents($depth = null)
 */
class Category extends ActiveRecord
{
    public $parent;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filemanager_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Module::t('main', 'Name'),
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getTreeList()
    {
        return self::find()
            ->select(["CONCAT(REPEAT('--', depth), ' ', name) AS name", 'id'])
            ->orderBy('lft')
            ->indexBy('id')
            ->column();
    }
}
