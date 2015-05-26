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

class ArticleRepository
{
    private $articles;

    public function __construct()
    {
        $this->articles = array(
            42 => array(
                'id' => 42,
                'title' => 'Nobody expects...',
                'content' => '... The Spanish Inquisition!',
            ),
        );
    }

    public function find($id)
    {
        if (!isset($this->articles[$id])) {
            throw new \DomainException(sprintf('Could not find article "%s"', $id));
        }

        return $this->articles[$id];
    }
}
