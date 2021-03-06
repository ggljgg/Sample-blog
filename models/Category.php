<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 *
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public static function getAll()
    {
        return Category::find()->all();
    }

    public static function getArticlesByCategory($id, $pageSize=6)
    {
        $query = Article::find()->where(['category_id' => $id]);
        $countQuery = clone $query;

        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $pageSize
        ]);
        
        $articles = $query->offset($pages->offset)
                          ->limit($pages->limit)
                          ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pages;

        return $data;
    }
}
