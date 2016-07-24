<?php

namespace AppBundle\Repository;

/**
 * Class MessageAuthorRepositoryAwareTrait
 * @package AppBundle\Repository
 */
trait MessageAuthorRepositoryAwareTrait
{
    /**
     * @var MessageAuthorRepository
     */
    protected $messageAuthorRepository;

    /**
     * ListController constructor.
     *
     * @param MessageAuthorRepository $messageAuthorRepository
     */
    public function setMessageAuthorRepository(MessageAuthorRepository $messageAuthorRepository)
    {
        $this->messageAuthorRepository = $messageAuthorRepository;
    }
}