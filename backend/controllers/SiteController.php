<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use yii\web\Response;
use yii\filters\Cors;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
      return [
        'corsFilter' => [
          'class' => \yii\filters\Cors::className(),
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


    public function actionIndex()
    {
      \Yii::$app->response->format = Response::FORMAT_JSON;
      $client = new Client();
      $response = $client->createRequest()->setMethod('GET')->setUrl('https://jsonplaceholder.typicode.com/users')->send()->data;
      $data = [];
      for ($i = 0; $i < count($response); $i++) {
        $data[$i]['id'] = $response[$i]['id'];
        $data[$i]['name'] = $response[$i]['name'];
        $data[$i]['email'] = $response[$i]['email'];
      }
      return $data;
    }
}
