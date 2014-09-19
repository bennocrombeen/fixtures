<?php
/**
 * Created by PhpStorm.
 * User: benno
 * Date: 8/12/14
 * Time: 2:32 PM
 */

namespace BC\Fixtures;

use Doctrine\DBAL\Connection;
use Symfony\Component\Finder\Finder;
use Silex\Application;

class Manager
{

    protected $connection;

    protected $app;

    protected $finder;

    public function __construct(Connection $conn, Application $app, Finder $finder)
    {
        $this->connection = $conn;
        $this->app = $app;
        $this->finder = $finder;
    }


    public function run()
    {
        $finder     = clone($this->finder);

        $finder->files()
            ->name('*Fixture.php')
            ->sortByName()
        ;

        foreach($finder as $fixture){
            var_dump($fixture);
        }


    }

} 