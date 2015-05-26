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

use Exception;

/**
 * Thrown if the $query given to QueryBus isn't supported by any of its
 * registered matchers.
 *
 * @api
 */
class NotSupportedException extends Exception
{
}
