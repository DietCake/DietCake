<?php
use org\bovigo\vfs\vfsStream;

class ViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');

        $this->controller = $this->getMockBuilder('Controller')
            ->disableOriginalConstructor()
            ->getMock();
        $this->view = new View($this->controller);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRender()
    {
        define('VIEWS_DIR', vfsStream::url($this->root->getName()));

        $vFile = vfsStream::newFile('index.php');
        $vFile->setContent(
            <<<'EOF'
Hello <?php echo $name ?> !!
EOF
        );
        $this->root->addChild($vFile);

        $this->view->vars = array('name' => 'John Doe');
        $this->view->render('index');
        $this->assertContains('Hello John Doe !!', $this->view->controller->output);
    }

    public function testExtract()
    {
        $vFile = vfsStream::newFile('index.php');
        $vFile->setContent(
            <<<'EOF'
Hello <?php echo $name ?> !!
EOF
        );
        $this->root->addChild($vFile);
        $this->assertContains('Hello John Doe !!', View::extract(vfsStream::url($this->root->getName() . DIRECTORY_SEPARATOR . $vFile->getName()), array('name' => 'John Doe')));
    }

    /**
     * @expectedException DCException
     * @expectedExceptionMessage not_exists.php is not found
     */
    public function testDCExceptionOnExtract()
    {
        View::extract('not_exists.php', array());
    }
}