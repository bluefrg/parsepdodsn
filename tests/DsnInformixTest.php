<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class DsnInformixTest extends TestCase
{
    public function testPrefix()
    {
        $dsn = Dsn::parse('informix:DSN=Infdrv33');

        $this->assertEquals('informix', $dsn->getPrefix());
    }

    public function testElements()
    {
        $dsn = Dsn::parse('informix:DSN=Infdrv33');

        $this->assertEquals('Infdrv33', $dsn->element('DSN'));
        $this->assertNull($dsn->element('port'));
    }

    public function testElementsWithSpaces()
    {
        // The PHP docs contain spaces, test for it
        $dsn = Dsn::parse('informix:host=host.domain.com; service=9800; database=common_db; server=ids_server; protocol=onsoctcp; EnableScrollableCursors=1');

        $this->assertEquals('host.domain.com', $dsn->element('host'));
        $this->assertEquals('9800', $dsn->element('service'));
        $this->assertEquals('common_db', $dsn->element('database'));
        $this->assertEquals('ids_server', $dsn->element('server'));
        $this->assertEquals('onsoctcp', $dsn->element('protocol'));
        $this->assertEquals('1', $dsn->element('EnableScrollableCursors'));
    }
}
