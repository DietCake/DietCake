<?php
class ParamTest extends PHPUnit_Framework_TestCase
{
    public function testGetScalar()
    {
        $_REQUEST['foo'] = 200;
        $this->assertEquals(200, Param::get('foo'));
    }

    public function testGetArray()
    {
        $_REQUEST['foo'] = array('a', 'b');
        $this->assertEquals(array('a', 'b'), Param::get('foo'));
    }

    public function testGetDefault()
    {
        $this->assertNull(Param::get('bar'));
        $this->assertEquals('default', Param::get('bar', 'default'));
    }
}