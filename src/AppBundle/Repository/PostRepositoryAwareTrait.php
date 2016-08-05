<?php

namespace AppBundle\Repository;

/**
 * Class PostRepositoryAwareTrait
 * @package AppBundle\Repository
 */
trait PostRepositoryAwareTrait
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function setPostRepository(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
}