<?php

namespace app\controllers;

use app\models\Result;
use app\models\Question;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        $questions = Question::find()->all();

        return $this->render('index', [
            'questions' => $questions,
        ]);
    }

    public function actionTest()
    {
        if (Yii::$app->request->post() && isset($_POST['Answer']) && isset($_POST['test_id'])) {
            foreach ($_POST['Answer'] as $key => $value) {
                $model = new Result();
                $model->test_id = $_POST['test_id'];
                $model->question_id = $key;
                $model->answer_id = $value;
                $model->save();
            }
            return $this->redirect(['show-results', 'id' => $_POST['test_id']]);
        } else
            return $this->goHome();
    }

    public function actionShowResults($id)
    {
        $results = Result::find()->where('test_id = :id', [':id' => $id])->all();
        $correctAnswers = Result::getNumOfCorrectAnswers($id);

        return $this->render('results', [
            'results' => $results,
            'correctAnswers' => $correctAnswers,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
