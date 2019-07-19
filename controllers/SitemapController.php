<?php

namespace app\controllers;


use app\models\Category;
use app\models\News;
use app\models\Pages;
use app\models\Shares;
use app\models\Works;
use Yii;
use yii\web\Response;

class SitemapController extends AllController {

    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    public function actionIndex() {

        if (!$items = Yii::$app->cache->get('sitemap')) {
            $items = [];
            $items = array_merge($items, [
                [
                    'models' => Pages::find()->all(),
                    'changefreq' => self::WEEKLY,
                    'priority' => 0.2,
                ]
            ]);
            $items = array_merge($items, [
                [
                    'models' => News::find()->all(),
                    'changefreq' => self::DAILY,
                    'priority' => 0.5,
                ]
            ]);
            $items = array_merge($items, [
                [
                    'models' => Shares::find()->all(),
                    'changefreq' => self::DAILY,
                    'priority' => 0.5,
                ]
            ]);
            $items = array_merge($items, [
                [
                    'models' => Category::find()->all(),
                    'changefreq' => self::MONTHLY,
                    'priority' => 0.5,
                ]
            ]);
            $items = array_merge($items,[
                [
                    'models' => Works::find()->with('category')->all(),
                    'changefreq' => self::WEEKLY,
                    'priority' => 0.8,
                ]
            ]);

            Yii::$app->cache->set('sitemap', $items, 3600 * 6);
        }


        $host = Yii::$app->request->hostInfo;

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');
        return $this->renderPartial('index', compact('host', 'items'));
    }
}