<?php
class Controller
{
    public $name;
    public $action;
    public $view;
    public $default_view_class = 'View';
    public $output;

    public function __construct($name)
    {
        $this->name = $name;
        $this->view = new $this->default_view_class($this);
    }

    public function beforeFilter()
    {
    }

    public function afterFilter()
    {
    }

    public function dispatchAction()
    {
    }

    public static function isAction($action)
    {
        $methods = get_class_methods(__CLASS__);
        return !in_array($action, $methods);
    }

    public function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->set($k, $v);
            }
        } else {
            $this->view->vars[$name] = $value;
        }
    }

    public function beforeRender()
    {
    }

    public function render($action = null)
    {
    }
}