<?php

namespace wechat\modules\rabbit;

/**
 * rabbit module definition class
 */
class RabbitMQ extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\modules\rabbit\controllers';
    public $defaultRoute = 'index';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
