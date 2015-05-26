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
    private $prioritizedMatchers = array();

    /**
     * @var bool
     */
    private $isSorted = false;

    /**
     * @param QueryMatcher $queryMatcher
     * @param int          $priority
     */
    public function add(QueryMatcher $queryMatcher, $priority = 0)
    {
        $this->prioritizedMatchers[$priority][] = $queryMatcher;
        $this->isSorted = false;
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
        if (!$this->isSorted) {
            $this->sortmatchers();
        }
        foreach ($this->prioritizedMatchers as $priority => $matchers) {
            foreach ($matchers as $queryMatcher) {
                if ($queryMatcher->supports($query)) {
                    return $queryMatcher->match($query);
                }
            }
        }

        throw new NotSupportedException('The given $query is not supported by any registered matchers.');
    }

    /**
     * Sort registered matchers according to their priority.
     */
    private function sortMatchers()
    {
        krsort($this->prioritizedMatchers);
        $this->isSorted = true;
    }
}
