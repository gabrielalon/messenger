<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MessageRepository
 * @package AppBundle\Repository
 */
class MessageRepository extends EntityRepository
{
    public function test()
    {
        return 'sd';
    }
}