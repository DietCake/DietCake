<?php
require_once dirname(__FILE__).'/bootstrap.php';

class ParamTest extends PHPUnit_Framework_TestCase
{
    public function test_get()
    {
        $_REQUEST['foo'] = 200;
        $this->assertEquals(200, Param::get('foo'));

        $_REQUEST['foo'] = ['a', 'b'];
        $this->assertEquals(['a', 'b'], Param::get('foo'));

        $this->assertTrue(is_null(Param::get('bar')));

        $this->assertEquals('default', Param::get('bar', 'default'));
    }

    public function test_params()
    {
        $this->assertEquals([], Param::params());

        $_REQUEST['foo'] = 100;
        $this->assertEquals(['foo' => 100], Param::params());
    }
}
