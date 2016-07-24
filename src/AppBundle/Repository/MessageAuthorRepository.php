<?php

namespace AppBundle\Repository;

use AppBundle\Model\MessageAuthor;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class MessageAuthorRepository
 * @package AppBundle\Repository
 */
class MessageAuthorRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function queryLatest()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT ma
                FROM AppBundle:MessageAuthor ma
                ORDER BY ma.createdAt DESC
            ');
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryLatest(), false));
        $paginator->setMaxPerPage(MessageAuthor::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}