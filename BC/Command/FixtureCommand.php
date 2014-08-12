<?php
/**
 * Created by PhpStorm.
 * User: benno
 * Date: 8/12/14
 * Time: 2:05 PM
 */

namespace BC\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixtureCommand extends Command
{

    public function configure()
    {
        $this->setName('bc:fixtures')
            ->setDescription('Load some fixtures in the database');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getSilexApplication();
        $fixtures = $app['benno.fixtures'];

        $fixtures->run();

    }

} 