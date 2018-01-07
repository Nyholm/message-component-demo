<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\Query\FetchUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Message\MessageBusInterface;

class Startpage
{
    /** @var MessageBusInterface */
    private $messageBus;

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $user = $this->messageBus->dispatch(new FetchUser(4711));

        return new Response('<html><head></head><body>Checkout the profiler page for messages.</body></html>');
    }
}
