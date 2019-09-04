<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class DsnMysqlTest extends TestCase
{
    public function testPrefix()
    {
        $dsn = Dsn::parse('mysql:host=localhost;dbname=testdb');

        $this->assertEquals('mysql', $dsn->getPrefix());
    }

    public function testPrefixWithSpaces()
    {
        $dsn = Dsn::parse(' mysql    : host=localhost; dbname = testdb ');

        $this->assertEquals('mysql', $dsn->getPrefix());
        $this->assertEquals('testdb', $dsn->element('dbname'));
    }

    public function testElements()
    {
        $dsn = Dsn::parse('mysql:host=localhost;dbname=testdb');

        $this->assertEquals('localhost', $dsn->element('host'));
        $this->assertEquals('testdb', $dsn->element('dbname'));
        $this->assertNull($dsn->element('port'));
        $this->assertSame(['host' => 'localhost', 'dbname' => 'testdb'], $dsn->getElements());
    }

    public function testElementsWithSocket()
    {
        $dsn = Dsn::parse('mysql:unix_socket=/tmp/mysql.sock');

        $this->assertEquals('/tmp/mysql.sock', $dsn->element('unix_socket'));
    }

    public function testElementCount()
    {
        $dsn = Dsn::parse('mysql:host=localhost;dbname=testdb');

        $this->assertCount(2, $dsn->getElements());
    }
}
