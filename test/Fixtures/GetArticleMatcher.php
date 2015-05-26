<?php

/*
 * This file is part of the gnugat/query-bus package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\QueryBus\Tests\Fixtures;

use Gnugat\QueryBus\QueryMatcher;

class GetArticleMatcher implements QueryMatcher
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function supports($query)
    {
        return $query instanceof GetArticle;
    }

    public function match($query)
    {
        return $this->articleRepository->find($query->id);
    }
}
