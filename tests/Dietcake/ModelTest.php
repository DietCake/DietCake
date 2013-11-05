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

    public function testValidateUseFunction()
    {
        $user = new User;
        $user->validation = array(
            'email' => array('invalid_email' => array('filter_var', FILTER_VALIDATE_EMAIL)),
        );

        $user->set(array('email' => 'john.doe@example.com'));
        $this->assertTrue($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'email' => array('invalid_email' => false),
        ));

        $user->set(array('email' => 'invalid.email'));
        $this->assertFalse($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'email' => array('invalid_email' => true),
        ));
    }

    public function testValidateUseMethod()
    {
        $user = new User;
        $user->validation = array(
            'is_active' => array('not_active' => array('isActive')),
        );

        $user->set(array('is_active' => true));
        $this->assertTrue($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'is_active' => array('not_active' => false),
        ));

        $user->set(array('is_active' => false));
        $this->assertFalse($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'is_active' => array('not_active' => true),
        ));
    }

    public function testValidateMultiple()
    {
        $user = new User;
        $user->validation = array(
            'email' => array(
                'invalid_email' => array('filter_var', FILTER_VALIDATE_EMAIL),
                'invalid_domain' => array('filter_var', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/@example\.com$/'))),
            ),
        );

        $user->set(array('email' => 'john.doe@example.com'));
        $this->assertTrue($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'email' => array(
                'invalid_email' => false,
                'invalid_domain' => false,
            ),
        ));

        $user->set(array('email' => 'jane.doe@example.jp'));
        $this->assertFalse($user->validate());
        $this->assertEquals($user->validation_errors, array(
            'email' => array(
                'invalid_email' => false,
                'invalid_domain' => true,
            ),
        ));
    }
}

class User extends Model
{
    public function isActive()
    {
        return (boolean) $this->is_active;
    }
}
