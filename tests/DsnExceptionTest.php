<?php
declare(strict_types=1);

use Bluefrg\ParsePdoDsn\Dsn;
use PHPUnit\Framework\TestCase;

final class DsnExceptionTest extends TestCase
{
    public function testThrowsIfElementsMissing()
    {
        $this->expectException(\LogicException::class);
        Dsn::parse('foobar');
    }

    public function testThrowsIfElementsContainsIllegalSymbols()
    {
        $this->expectException(\LogicException::class);
        Dsn::parse('foo$@.bar:host=localhost');
    }
}
