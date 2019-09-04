<?php
declare(strict_types=1);

namespace Bluefrg\ParsePdoDsn;

class Dsn
{
    private $prefix;
    private $elements;

    /**
     * Dsn constructor.
     * @param string $prefix
     * @param array $elements
     */
    public function __construct(
        string $prefix,
        array $elements
    )
    {
        $this->prefix = $prefix;
        $this->elements = $elements;
    }

    /**
     * Get the engine/prefix
     * @return string
     */
    public function getPrefix() : string
    {
        return $this->prefix;
    }

    /**
     * Get all elements as key-value pairs, or flags
     * @return array
     */
    public function getElements() : array
    {
        return $this->elements;
    }

    /**
     * Get an element's value
     * @param string $key
     * @return string|null
     */
    public function element(string $key) : ?string
    {
        if ( array_key_exists($key, $this->elements) ) {
            return $this->elements[$key];
        }

        return null;
    }

    /**
     * Parse a DSN string
     * @param string $dsn
     * @return Dsn
     */
    public static function parse(string $dsn) : self
    {
        $dsn = trim($dsn);

        if (false === strpos($dsn, ':')) {
            throw new \LogicException(sprintf('The DSN is invalid. It does not have scheme separator ":".', ));
        }

        list($prefix, $dsnWithoutPrefix) = preg_split('#\s*:\s*#', $dsn, 2);

        if (false == preg_match('/^[a-z\d]+$/', strtolower($prefix))) {
            throw new \LogicException('The DSN is invalid. Prefix contains illegal symbols.');
        }

        $dsnElements = preg_split('#\s*\;\s*#', $dsnWithoutPrefix);

        $elements = [];
        foreach($dsnElements as $element) {

            if (false !== strpos($dsnWithoutPrefix, '=')) {
                list($key, $value) = preg_split('#\s*=\s*#', $element, 2);
                $elements[$key] = $value;
            }
            else {
                $elements = [
                    $dsnWithoutPrefix
                ];
            }

        }

        return new self(
            $prefix,
            $elements
        );
    }
}