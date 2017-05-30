<?php
require_once dirname(__FILE__).'/bootstrap.php';

use PHPUnit\Framework\TestCase;

class ParamTest extends TestCase
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
        $_REQUEST = [];

        $this->assertEquals([], Param::params());

        $_REQUEST['foo'] = 100;
        $this->assertEquals(['foo' => 100], Param::params());
    }

    public function test_getHeader()
    {
        $this->assertEquals(null, Param::getHeader('foo'));
        $this->assertEquals(1, Param::getHeader('foo', 1));
        $_SERVER['HTTP_FOO'] = 'juno';
        $this->assertEquals('juno', Param::getHeader('foo'));
        $this->assertEquals('juno', Param::getHeader('foo', 1));
    }
}
