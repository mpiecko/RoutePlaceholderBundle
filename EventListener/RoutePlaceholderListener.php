<?php

namespace PMWD\RoutePlaceholderBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RoutePlaceholderListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(RouterInterface $router = null)
    {
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (null === $this->router) {
            return;
        }

        $request = $event->getRequest();
        $session = $request->getSession();

        // For this example we use a value stored in the session, with a fallback default
        $client = $session->get('_client', 'default');

        $this->router->getContext()->setParameter('_client', $client);
    }

    static public function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 31)),
        );
    }

}
