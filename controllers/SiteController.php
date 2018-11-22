<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\CommentForm;
use app\models\Article;
use app\models\Category;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAll(1);
        $popularArticles = Article::getPopular();
        $recentArticles = Article::getRecent();
        $articleCategories = Category::getAll();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'articleCategories' => $articleCategories
        ]);
    }

    /**
     * 
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $popularArticles = Article::getPopular();
        $recentArticles = Article::getRecent();
        $articleCategories = Category::getAll();
        $articleComments = $article->getArticleComments();
        $commentForm = new CommentForm();
        $articleTags = $article->getArticleTags();

        $article->viewedCounter();

        return $this->render('single', [
            'article' => $article,
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'articleCategories' => $articleCategories,
            'articleComments' => $articleComments,
            'commentForm' => $commentForm,
            'articleTags' => $articleTags
        ]);
    }

    /**
     * 
     */
    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id);
        $popularArticles = Article::getPopular();
        $recentArticles = Article::getRecent();
        $articleCategories = Category::getAll();

        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularArticles' => $popularArticles,
            'recentArticles' => $recentArticles,
            'articleCategories' => $articleCategories
        ]);
    }
    
    public function actionComment($id)
    {
        $model = new CommentForm();
        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'You comment will be added soon.');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
