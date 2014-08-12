<?php
/**
 * Created by PhpStorm.
 * User: benno
 * Date: 8/12/14
 * Time: 2:03 PM
 */

namespace BC\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;
use BC\Command\FixtureCommand;
use BC\Fixtures\Manager;

use Knp\Console\ConsoleEvents;
use Knp\Console\ConsoleEvent;

class FixtureServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        // TODO: Implement register() method.

        $app['benno.fixtures'] = $app->share(function() use ($app){
            return new Manager($app['db'], $app, Finder::create()->in($app['fixtures.path']));
        });

        $app['dispatcher']->addListener(ConsoleEvents::INIT, function(ConsoleEvent $event) {
            $application = $event->getApplication();
            $application->add(new FixtureCommand());
        });

    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }


} 