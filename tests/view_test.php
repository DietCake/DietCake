<?php
require_once dirname(__FILE__).'/bootstrap.php';

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    /**
     * @expectedException DCException
     */
    public function test_extract_dcexception()
    {
        View::extract('not_found_filename', array());
    }
}
