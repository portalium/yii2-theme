<?php
namespace portalium\theme\widgets;

class DetailView extends \yii\widgets\DetailView
{
    public function init()
    {
        parent::init();
    }
    protected function renderAttribute($attribute, $index)
    {
        if (is_string($this->template)) {

            $captionOptions = isset($attribute['captionOptions'])
                ? Html::renderTagAttributes($attribute['captionOptions'])
                : '';


            
            $contentOptionsArray = isset($attribute['contentOptions']) ? $attribute['contentOptions'] : [];
            
            $contentOptionsArray['style'] = 'overflow-wrap: anywhere;';

            $contentOptions = Html::renderTagAttributes($contentOptionsArray);

            $value = $this->formatter->format($attribute['value'], $attribute['format']);

            return strtr($this->template, [
                '{label}' => $attribute['label'],
                '{value}' => $value,
                '{captionOptions}' => $captionOptions,
                '{contentOptions}' => $contentOptions,
            ]);
        }

        return call_user_func($this->template, $attribute, $index, $this);
    }
}