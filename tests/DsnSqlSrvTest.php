<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class DsnSqlSrvTest extends TestCase
{
    public function testPrefix()
    {
        $dsn = Dsn::parse('sqlsrv:Server=localhost;Database=testdb');
        $this->assertEquals('sqlsrv', $dsn->getPrefix());
    }
    
    public function testElements()
    {
        $dsn = Dsn::parse('sqlsrv:Server=localhost\\SQLEXPRESS;Database=MyDatabase');

        $this->assertEquals('localhost\\SQLEXPRESS', $dsn->element('Server'));
        $this->assertEquals('MyDatabase', $dsn->element('Database'));
        $this->assertNull($dsn->element('port'));
    }

    public function testElementsWithCommaInServer()
    {
        $dsn = Dsn::parse('sqlsrv:Server=localhost,1521;Database=testdb');

        $this->assertEquals('localhost,1521', $dsn->element('Server'));
    }
}
