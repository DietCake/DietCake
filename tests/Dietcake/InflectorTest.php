<?php
class InflectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider forTestCamelize
     */
    public function testCamelize($str, $expect)
    {
        $this->assertEquals($expect, Inflector::camelize($str));
    }

    public function forTestCamelize()
    {
        return array(
            array('foo', 'Foo'),
            array('plain_text', 'PlainText'),
        );
    }
}