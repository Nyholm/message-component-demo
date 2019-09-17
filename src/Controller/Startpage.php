<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\Query\FetchUser;
use App\Message\QueryBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class Startpage
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $user = $this->queryBus->query(new FetchUser(4711));

        return new Response('<html><head></head><body>Checkout the profiler page for messages.</body></html>');
    }
}
