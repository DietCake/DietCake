<?php
class ControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider forTestIsActionOk
     */
    public function testIsActionOk($action)
    {
        $this->assertTrue(Controller::isAction($action));
    }

    public function forTestIsActionOk()
    {
        return array(
            array('index'),
            array('view'),
        );
    }

    /**
     * @dataProvider forTestIsActionNok
     */
    public function testIsActionNok($action)
    {
        $this->assertFalse(Controller::isAction($action));
    }

    public function forTestIsActionNok()
    {
        return array(
            array('__construct'),
            array('beforeFilter'),
            array('afterFilter'),
            array('dispatchAction'),
            array('isAction'),
            array('set'),
            array('beforeRender'),
            array('render'),
        );
    }

    public function testSet()
    {
        $controller = new Controller('');
        $controller->set('foo', 100);
        $controller->set('bar', array(1, 2));

        $this->assertEquals(100, $controller->view->vars['foo']);
        $this->assertEquals(array(1, 2), $controller->view->vars['bar']);

        $controller->set(array('foo' => 200));
        $this->assertEquals(200, $controller->view->vars['foo']);
    }
}
