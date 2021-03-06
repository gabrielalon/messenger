<?php

namespace AppBundle\Repository;

use AppBundle\Model\Message;
use AppBundle\Model\MessageAuthor;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class MessageRepository
 * @package AppBundle\Repository
 */
class MessageRepository extends EntityRepository
{
    /**
     * @param $term
     *
     * @return array
     */
    public function findAllLikeContent($term)
    {
        $queryBuilder = $this->createQueryBuilder('m');

        return $queryBuilder
            ->select('m')
            ->where( $queryBuilder->expr()->like('m.content', $queryBuilder->expr()->literal('%' . $term . '%')) )
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $page
     *
     * @return array
     */
    public function findAllPaginated($page = 1)
    {
        $limit = Message::NUM_ITEMS;
        $offset = $limit * max(0, $page - 1);

        return $this->getEntityManager()
            ->createQuery('
                SELECT m
                FROM AppBundle:Message m
                ORDER BY m.createdAt DESC
            ')
            ->setMaxResults(Message::NUM_ITEMS)
            ->setFirstResult($offset)
            ->getResult();
    }
    /**
     * @return Query
     */
    public function queryLatest()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT m
                FROM AppBundle:Message m
                WHERE m.createdAt <= :now
                ORDER BY m.createdAt DESC
            ')
            ->setParameter('now', new \DateTime());
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $query = $this->queryLatest();

        return $this->initializePagination($query, $page);
    }

    /**
     * @param MessageAuthor $messageAuthor
     *
     * @return Query
     */
    public function queryLatestForAuthor(MessageAuthor $messageAuthor)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT m
                FROM AppBundle:Message m
                WHERE m.createdAt <= :now AND m.authorId = :authorId
                ORDER BY m.createdAt DESC
            ')
            ->setParameter('now', new \DateTime())
            ->setParameter('authorId', $messageAuthor->getId());
    }

    /**
     * @param MessageAuthor $messageAuthor
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatestForAuthor(MessageAuthor $messageAuthor, $page = 1)
    {
        $query = $this->queryLatestForAuthor($messageAuthor);

        return $this->initializePagination($query, $page);
    }

    /**
     * @param Query $query
     * @param int $page
     *
     * @return Pagerfanta
     */
    protected function initializePagination(Query $query, $page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query, false));
        $paginator->setMaxPerPage(Message::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}