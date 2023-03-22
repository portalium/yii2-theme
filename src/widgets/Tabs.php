<?php
namespace portalium\theme\widgets;

class Tabs extends \yii\bootstrap5\Tabs
{
    public function init()
    {
        foreach ($this->items as $key => $item) {
            if (!isset($item['linkOptions'])) {
                $this->items[$key]['linkOptions'] = ['style' => 'color: #333; border-bottom: 1px solid #ddd;'];
            }
        }
        parent::init();
    }
}