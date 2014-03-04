<?php
/**
 * This widget has to be used in conjunction with schmunk42\templay\Content, it
 * discards its output buffer, which should be "filtered" by the Content widget.
 */

namespace schmunk42\templay;


class Html extends \yii\base\Widget
{
    public function init()
    {
        ob_start();
        ob_implicit_flush(false);
    }

    /**
     */
    public function run()
    {
        ob_end_clean();
    }
} 