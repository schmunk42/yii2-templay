<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 28.02.14
 * Time: 01:07
 */

namespace schmunk42\templay;


class Template extends \yii\base\Widget {

    private static $_content;

    public static function begin($config = []){
        ob_start();
        ob_implicit_flush(false);
        parent::begin($config);
    }

    public static function end(){
        parent::end();
        self::$_content = ob_get_clean();
        self::process();
        echo self::$_content;
        echo self::renderModal();
    }

    private static function process(){
        $doc = new \DOMDocument();
        $doc->loadHTML(self::$_content);
        $xpath = new \DOMXPath($doc);
        $xpath->query('//h2')->item(0)->nodeValue = "1000!";
        self::$_content = $doc->saveHTML();
    }

    private static function renderModal(){
        $html = <<<EOS
<!-- Button trigger modal -->
<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Headline</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Text</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="3"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
EOS;
        return $html;
    }
} 