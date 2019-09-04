<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class Dsn4dTest extends TestCase
{
    public function testPrefixNoElements()
    {
        $dsn = Dsn::parse('4D:');

        $this->assertEquals('4D', $dsn->getPrefix());
    }

    public function testElements()
    {
        $dsn = Dsn::parse('4D:host=localhost;charset=UTF-8');

        $this->assertEquals('localhost', $dsn->element('host'));
        $this->assertNull($dsn->element('port'));
    }
}
