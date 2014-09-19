<?php
/**
 * Created by PhpStorm.
 * User: benno
 * Date: 8/12/14
 * Time: 2:43 PM
 */

namespace BC\Fixtures;

use Doctrine\DBAL\Connection;

abstract class AbstractFixture
{

    public function run(Connection $conn){}

} 