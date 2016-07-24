<?php

namespace AppBundle\Repository;

/**
 * Class MessageRepositoryAwareTrait
 * @package AppBundle\Repository
 */
trait MessageRepositoryAwareTrait
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * ListController constructor.
     *
     * @param MessageRepository $messageRepository
     */
    public function setMessageRepository(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }
}