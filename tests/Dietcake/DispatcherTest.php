<?php
class DispatcherTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider forTestParseAction
     */
    public function testParseAction($action, $expect)
    {
        $this->assertEquals($expect, Dispatcher::parseAction($action));
    }

    public function forTestParseAction()
    {
        return array(
            array('top/index', array('top', 'index')),
            array('player/view_record', array('player', 'view_record')),
            array('event/top/index', array('event_top', 'index')),
        );
    }

    /**
     * @expectedException DCException
     * @expectedExceptionMessage invalid url format
     */
    public function testExceptionOnParseAction()
    {
        Dispatcher::parseAction('foo');
    }

    /**
     * @dataProvider forTestGetController
     */
    public function testGetController($controller_name, $expect)
    {
        $stub = $this->getMockBuilder('Controller')
            ->disableOriginalConstructor()
            ->setMockClassName($expect)
            ->getMock();

        $this->assertInstanceOf(get_class($stub), Dispatcher::getController($controller_name));
    }

    public function forTestGetController()
    {
        return array(
            array('hello', 'HelloController'),
            array('LOREM_IPSUM', 'LoremIpsumController'),
            array('fooBarBaz', 'FoobarbazController'),
        );
    }
}
