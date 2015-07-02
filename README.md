# QueryBus [![SensioLabsInsight](https://insight.sensiolabs.com/projects/f7b5e707-5a4c-4dcb-9959-8cca01e4fab4/mini.png)](https://insight.sensiolabs.com/projects/f7b5e707-5a4c-4dcb-9959-8cca01e4fab4) [![Travis CI](https://travis-ci.org/gnugat/query-bus.png)](https://travis-ci.org/gnugat/query-bus)

A PHP library for Interrogatory Messages.

[Interrogatory Messages](http://verraes.net/2015/01/messaging-flavours/) are passed
to the `QueryBus` service which returns the result of the first `QueryMatcher`
that supports it.

## Installation

QueryBus can be installed using [Composer](http://getcomposer.org/):

    composer require "gnugat/query-bus:~2.0"

## Simple conversion

Let's take the following table:

```sql
CREATE TABLE article (
    id int,
    title VARCHAR(255),
    content TEXT
);
```

If we want to execute the following query:

```sql
SELECT id, title, content FROM article WHERE id = 42;
```

Then we have first to create a `Query`, which is a simple
[DTO](http://martinfowler.com/eaaCatalog/dataTransferObject.html):

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Gnugat\QueryBus\QueryBus;

class GetArticle
{
    public $id;

    public function __construct($id)
    {
        if (null === $id) {
            throw new \InvalidArgumentException('Required parameter ID is missing');
        }
        $this->id = (int) $id;
    }
}
```

> **Note**: Queries can contain simple [validation](http://verraes.net/2015/02/form-command-model-validation/),
> for example to check for `null` values.

Then we have to create a `QueryMatcher`:

```php
// ...

use Gnugat\QueryBus\QueryMatcher;

class GetArticleMatcher implements QueryMatcher
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        pg_prepare($this->connection, 'get_article', 'SELECT id, title, content FROM articles WHERE id = $1');
    }

    public function supports($query)
    {
        return $query instanceof GetArticle;
    }

    public function match($query)
    {
        $result = pg_execute($this->connection, 'get_article', array($query->id));

        return pg_fetch_array($result, NULL, PGSQL_ASSOC);
    }
}
```

Next we need to register it in `QueryBus`:

```php
// ...

use Gnugat\QueryBus\QueryBus;

$connection = pg_pconnect('dbname=blog');
$queryBus = new QueryBus();
$queryBus->add(new GetArticleMatcher($connection));
```

Finally we can actually execute the query:

```php
// ...

$articles = $queryBus->match(new GetArticle(42));
```

## Further documentation

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/query-bus/releases)
* the file listing the [changes between versions](CHANGELOG.md)

You can find more documentation at the following links:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
