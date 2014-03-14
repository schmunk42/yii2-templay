<?php
/**
 * This widget has to be used in conjunction with schmunk42\templay\Content, it
 * discards its output buffer, which should be "filtered" by the Content widget.
 */

namespace schmunk42\templay\widegts;


class Wrapper extends \yii\base\Widget
{

    public $output = true;

    public function init()
    {
        if ($this->return) {
            ob_end_clean();
        } else {
            ob_start();
            ob_implicit_flush(false);
        }
    }

    /**
     */
    public function run()
    {
        if ($this->return) {
            ob_end_clean();
        } else {
            ob_start();
        }
    }

    /*
     *     public function init()
    {
        ob_end_clean();
    }

    public function run()
    {
        ob_start();
    }
     */


} 