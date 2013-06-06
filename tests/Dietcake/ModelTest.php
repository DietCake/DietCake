<?php
class ModelTest extends PHPUnit_Framework_TestCase
{
    public function testSet()
    {
        $model = new Model;
        $model->set(array('foo' => 200, 'bar' => 'test'));

        $this->assertEquals(200, $model->foo);
        $this->assertEquals('test', $model->bar);
    }

    public function testValidate()
    {
        $this->markTestIncomplete();
    }
}