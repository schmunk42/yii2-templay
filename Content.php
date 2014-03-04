<?php
/**
 * This widget has to be used in conjunction with schmunk42\templay\Html, it
 * discards the current output buffer and starts a new one if it ends
 */

namespace schmunk42\templay;


class Content extends \yii\base\Widget
{
    public function init()
    {
        ob_end_clean();
    }

    /**
     */
    public function run()
    {
        ob_start();
    }
} 