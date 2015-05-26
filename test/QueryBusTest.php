<?php

/*
 * This file is part of the gnugat/query-bus package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\QueryBus\Tests;

use Gnugat\QueryBus\QueryBus;
use Gnugat\QueryBus\Tests\Fixtures\ArticleRepository;
use Gnugat\QueryBus\Tests\Fixtures\GetArticle;
use Gnugat\QueryBus\Tests\Fixtures\GetArticleMatcher;
use PHPUnit_Framework_TestCase;

class QueryBusTest extends PHPUnit_Framework_TestCase
{
    const ARTICLE_ID = 42;

    private $articleRepository;
    private $queryBus;

    protected function setUp()
    {
        $this->articleRepository = new ArticleRepository();
        $this->queryBus = new QueryBus();
        $this->queryBus->add(new GetArticleMatcher($this->articleRepository));
    }

    /**
     * @test
     */
    public function it_converts_article_to_array()
    {
        $article = $this->queryBus->match(new GetArticle(self::ARTICLE_ID));

        self::assertSame($this->articleRepository->find(self::ARTICLE_ID), $article);
    }
}
