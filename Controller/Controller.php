<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    /**
     * Sends 404 to Page AtomLogger
     *
     * @param  string     $message  Error Message to be logged
     * @param  \Exception $previous Previous message made prior to 404
     * @return NotFoundHttpException
     */
    public function createNotFoundException($message = 'Not Found', \Exception $previous = null)
    {
        if ($this->has('atom.404.logger')) {
            $log = $this->get('atom.404.logger');
            $log->addRecord(400, $message, array('request' => $this->getRequest()->getUri()));
        }

        return new NotFoundHttpException($message, $previous);
    }
}
