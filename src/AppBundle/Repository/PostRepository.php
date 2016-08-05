<?php

namespace AppBundle\Repository;

use AppBundle\Document\Post;
use Doctrine\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class PostRepository
 * @package AppBundle\Repository
 */
class PostRepository extends DocumentRepository
{
    /**
     * @return Builder
     */
    public function queryLatest()
    {
        return $this->createQueryBuilder()
            ->sort('publishedAt', 'DESC');
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $query = $this->queryLatest();

        $paginator = new Pagerfanta(new DoctrineODMMongoDBAdapter($query, false));
        $paginator->setMaxPerPage(Post::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}