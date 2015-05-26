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

class GetArticle
{
    public $id;

    public function __construct($id)
    {
        if (null === $id) {
            throw new InvalidArgumentException('Missing required parameter: ID');
        }
        $this->id = (int) $id;
    }
}
