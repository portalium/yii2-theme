<?php

namespace portalium\theme\widgets;

use yii\helpers\ArrayHelper;

class DetailView extends \yii\widgets\DetailView
{
    public function init()
    {
        parent::init();

        foreach ($this->attributes as &$attribute) {
            if (is_array($attribute)) {
                $attribute['contentOptions'] = ArrayHelper::merge(
                    $attribute['contentOptions'] ?? [],
                    ['style' => 'overflow-wrap: anywhere;']
                );
            }
        }
    }
}
