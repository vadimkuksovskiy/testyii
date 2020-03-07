<?php

namespace app\controllers;

use app\models\ArrayDivisionAlgorithm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ArrayDivisionAlgorithmController extends Controller
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
            'authenticator' => [
                'class' => HttpBasicAuth::class,
            ]
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
     * @return int
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex(): int
    {
        $request = Yii::$app->request;
        $post = $request->getBodyParams();

        $algorithm = new ArrayDivisionAlgorithm($post['value'], $post['array']);

        $result = $algorithm->run();

        return $result;
    }
}
