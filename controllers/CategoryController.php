<?php
namespace pahanium\filemanager\controllers;

use pahanium\filemanager\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->orderBy('tree, lft'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            if (($parent = Category::findOne($model->parent)) !== null) {
                if ($model->appendTo($parent)) {
                    return $this->redirect(['index']);
                }
            } else {
                if ($model->makeRoot()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Catalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $parent = $model->parents(1)->one();
        $model->parent = isset($parent) ? $parent->getPrimaryKey() : null;
        $oldParent = $model->parent;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->parent != $oldParent) {
                if (($parent = Category::findOne($model->parent)) !== null) {
                    if ($model->appendTo($parent)) {
                        return $this->redirect(['index']);
                    }
                } else {
                    if ($model->makeRoot()) {
                        return $this->redirect(['index']);
                    }
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Catalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUp($id)
    {
        $model = $this->findModel($id);
        $neighbor = Category::findOne(['rgt' => $model->lft - 1, 'depth' => $model->depth]);
        if ($neighbor) {
            $model->insertBefore($neighbor);
        }
        return $this->redirect(['index']);
    }

    public function actionDown($id)
    {
        $model = $this->findModel($id);
        $neighbor = Category::findOne(['lft' => $model->rgt + 1, 'depth' => $model->depth]);
        if ($neighbor) {
            $model->insertAfter($neighbor);
        }
        return $this->redirect(['index']);
    }
}
