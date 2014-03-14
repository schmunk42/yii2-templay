<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 28.02.14
 * Time: 01:07
 */

namespace schmunk42\templay\widgets;


use schmunk42\templay\models\Template as Model;

class Template extends \yii\base\Widget
{

    public $description;

    private $_content;

    /**
     * @var string the view file that will be used to decorate the content enclosed by this widget.
     * This can be specified as either the view file path or path alias.
     */
    public $viewFile = '@vendor/schmunk42/yii2-templay/views/template.php';

    /**
     * @var array the parameters (name => value) to be extracted and made available in the decorative view.
     */
    public $params = [];

    public $model;

    /**
     * Starts a template
     */
    public function init()
    {
        \schmunk42\templay\assets\TemplayAsset::register($this->view);
        ob_start();
        ob_implicit_flush(false);
    }

    /**
     * Ends a template
     */
    public function run()
    {
        $params            = $this->params;

        $this->_content = $this->process($this->_content);
        $this->_content = html_entity_decode(ob_get_clean());
        $params['content'] = $this->_content;

        $params['id']      = $this->id;
        $params['model']   = new \yii\base\DynamicModel($this->extractTemplateAttributes());



        // render under the existing context
        echo $this->view->renderFile($this->viewFile, $params);

    }

    private function loadModel(){
        $model = Model::find(['tid'=>$this->id]);
        #var_dump($model);
        return $model;
    }

    /**
     * Replace template values with model data
     * TODO: to be implemented
     *
     * @param $content
     *
     * @return mixed
     */
    private function process($content)
    {
        $xml    = $this->asSimpleXMLElement();
        #$result = $xml->xpath('//*[@tpy:*]');
        var_dump($xml);
        $result = $xml->xpath('//h1');
        #var_dump($xml,$result);
        $model = $this->loadModel();

        foreach ($result as $element) {
            echo "BBBBBBB";
            $element->{0} = "xxx";

            $tpy = $element->attributes('tpy', true);
            #print_r($tpy['attributes']);
            #echo "111111111";
            // get all tpy: attributes
            $tpyAttributes = $element->attributes('tpy', true);
            #var_dump($tpyAttributes);

            if (isset($tpyAttributes['content'])) {
                list($var, $value) = explode('/', $tpyAttributes['content']);
                $element->{0} = isset($$var->$value) ? $$var->$value : 'NOT DEFINED';
            }
        }
        return $xml->asXML();
    }

    /**
     * Reads tpy: attributes from current template snippet
     * @return array defined attributes
     */
    private function extractTemplateAttributes()
    {
        $xml    = $this->asSimpleXMLElement();
        $result = $xml->xpath('//*[@tpy:*]');

        $attributes = [];
        foreach ($result as $element) {
            $tpy = $element->attributes('tpy', true);
            if (isset($tpy['content'])) {
                list($key, $value) = explode('/', $tpy['content']);
                $attributes[] = $value;
            }

            if (isset($tpy['attributes'])) {
                $pairs = explode(';', $tpy['attributes']);
                foreach ($pairs AS $pair) {
                    list($attribute, $data) = explode(' ', trim($pair));
                    list($key, $value) = explode('/', $data);
                    $attributes[] = $value;
                }
            }
        }
        return $attributes;
    }

    /**
     * Fixes namespace errors
     * @return \SimpleXMLElement
     */
    private function asSimpleXMLElement()
    {
        $content = "<?xml version='1.0' encoding='UTF-8'?>";
        $content .= "<item xmlns:tpy='http://sphundament.com/xmlns/tpy/1'>" . $this->_content . "</item>";
#echo $content;
#exit;
        #$content = $this->_content;
        $xml     = new \SimpleXMLElement($content, 0, false, "tpy", true);
        $xml->registerXPathNamespace('tpy', 'http://phundament.com/xmlns/tpy/1');
        return $xml;
    }
} 