<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class DsnSqliteTest extends TestCase
{
    public function testPrefix()
    {
        $dsn = Dsn::parse('sqlite:/opt/databases/mydb.sq3');

        $this->assertEquals('sqlite', $dsn->getPrefix());
    }
    
    public function testElementsOfMemory()
    {
        $dsn = Dsn::parse('sqlite::memory:');

        $this->assertContains(':memory:', $dsn->getElements());
    }

    public function testElementsOfPath()
    {
        $dsn = Dsn::parse('sqlite2:/opt/databases/mydb.sq2');

        $this->assertContains('/opt/databases/mydb.sq2', $dsn->getElements());
    }
}
