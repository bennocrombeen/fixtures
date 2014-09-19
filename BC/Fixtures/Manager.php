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
        foreach($this->getFixtures() as $fixture){
            $fixture->run($this->connection);
        }
    }



    protected function getFixtures()
    {
        $finder     = clone($this->finder);

        $finder->files()
            ->name('*Fixture.php')
            ->sortByName()
        ;

        $availableFixtures = [];

        foreach($finder as $fixture){

            if(preg_match('/^(.*Fixture).php$/', basename($fixture), $matches)){
                list($file, $class) = $matches;

                require_once $fixture;

                $clz = '\\Fixture\\' . $class;
                $rf = new \ReflectionClass($clz);

                if(!$rf->isSubclassOf('\\BC\\Fixtures\\AbstractFixture')){
                    throw new \Exception('Not subclass of');
                }

                $availableFixtures[] = new $clz();
            }
        }
        return $availableFixtures;
    }


} 