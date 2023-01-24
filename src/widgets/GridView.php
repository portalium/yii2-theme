<?php
namespace portalium\theme\widgets;

class GridView extends \yii\grid\GridView
{
    public function init()
    {
        parent::init();
        $this->pager = [
            'class' => 'yii\bootstrap5\LinkPager',
            'options' => [
                'class' => 'pagination justify-content-end',
            ],
        ];
        $this->layout = "{items}{pager}{summary}";
    }
}
