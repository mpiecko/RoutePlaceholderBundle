README
======

RoutePlaceholderBundle
-----------------

This is a very basic example of how to set a custom parameter in all routes, without having to add it every time a link
is generated. Imagine you want your clients name in all routes, like http://www.example.com/acme/account or
http://www.example.com/acme/contact. This example Bundle shows you how to define and use routes like this:

    ...

    <route id="client_account" pattern="/{_client}/account">
        <default key="_controller">AcmeDemoBundle:Account:index</default>
    </route>

    <route id="client_product_list" pattern="/{_client}/product/list">
        <default key="_controller">AcmeDemoBundle:Product:list</default>
    </route>

    ...

Now take a look at the RoutePlaceholderListener class. In this example the clients name is stored in the session. All we
need to do is get it from there (with a default value) and place it in the router context:

    ...

    // For this example we use a value stored in the session
    $client = $session->get('_client', 'default');

    $this->router->getContext()->setParameter('_client', $client);

    ...

From now on we can generate links with {{ path('client_account) }} or {{ path('client_product_list') }}. The client
will be present in all links. And of course, you can use this parameter in your controller, like any other parameter:

    class AccountController extends Controller
    {
        public function indexAction($_client)
        {
            // $_client is your clients name, or the default value

        }

        ...

    }

If you need another example, just look how the _locale is beeing handled in the
Symfony\Component\HttpKernel\EventListener\LocaleListener class.
