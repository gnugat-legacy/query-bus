<?php

/*
 * This file is part of the gnugat/query-bus package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\QueryBus;

use Gnugat\QueryBus\QueryMatcher;
use PhpSpec\ObjectBehavior;

class QueryBusSpec extends ObjectBehavior
{
    function it_executes_the_appropriate_strategy(
        QueryMatcher $queryMatcher1,
        QueryMatcher $queryMatcher2,
        QueryMatcher $queryMatcher3
    ) {
        $query = array();

        $queryMatcher1->supports($query)->willReturn(false);
        $queryMatcher2->supports($query)->willReturn(false);
        $queryMatcher3->supports($query)->willReturn(true);

        $this->add($queryMatcher1);
        $this->add($queryMatcher2);
        $this->add($queryMatcher3);

        $queryMatcher3->match($query)->shouldBeCalled();

        $this->match($query);
    }

    function it_fails_when_no_matcher_support_the_given_query()
    {
        $query = array();

        $notSupportedException = 'Gnugat\QueryBus\NotSupportedException';
        $this->shouldThrow($notSupportedException)->duringMatch($query);
    }
}
