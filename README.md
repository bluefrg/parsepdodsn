# Parse PDO DSN

A simple library to parse and interpret a PDO DSN string.

```php
<?php
$dsn = Bluefrg\ParsePdoDsn\Dsn::parse('mysql:host=localhost;dbname=testdb');

// Get the prefix
echo $dsn->getPrefix(); // mysql

// Fetch an element's value 
echo $dsn->element('host'); // localhost 
echo $dsn->element('dbname'); // testdb

// List all elements as key-values
print_r($dsn->getElements()); 
```

## Install

```bash
$ composer require bluefrg/parsepdodsn
```