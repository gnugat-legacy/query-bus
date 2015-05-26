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
 * The service that actually handles the interrogatory message.
 *
 * @api
 */
interface QueryMatcher
{
    /**
     * @param mixed $query
     *
     * @return bool
     *
     * @api
     */
    public function supports($query);

    /**
     * @param mixed $query
     *
     * @return mixed
     *
     * @api
     */
    public function match($query);
}
