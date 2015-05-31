<?php

/*
 * This file is part of the gnugat/query-bus package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\QueryBus;

/**
 * Converts from one format to another, using the appropriate QueryMatcher.
 */
class QueryBus
{
    /**
     * @var array
     */
    private $queryMatchers = array();

    /**
     * @param QueryMatcher $queryMatcher
     */
    public function add(QueryMatcher $queryMatcher)
    {
        $this->queryMatchers[] = $queryMatcher;
    }

    /**
     * @param mixed $query
     *
     * @return mixed
     *
     * @throws NotSupportedException If the given $query isn't supported by any registered matchers
     */
    public function match($query)
    {
        foreach ($this->queryMatchers as $queryMatcher) {
            if ($queryMatcher->supports($query)) {
                return $queryMatcher->match($query);
            }
        }

        throw new NotSupportedException('The given $query is not supported by any registered matchers.');
    }
}
