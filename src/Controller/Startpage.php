<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\Command\SendNotification;
use App\Message\Query\FetchUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

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

    /**
     * @Route("/notify")
     */
    public function notify(Request $request)
    {
        $users = ['samuel', 'christelle'];
        $message = $request->query->get('message', 'Something.');
        $this->messageBus->dispatch(new SendNotification($message, $users));

        return new Response('<html><body>OK.</body></html>');
    }
}
