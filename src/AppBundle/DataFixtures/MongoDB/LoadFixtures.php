<?php

namespace AppBundle\DataFixtures\MongoDB;

use AppBundle\DataFixtures\BaseFixtures;
use AppBundle\Document\Post;
use AppBundle\Document\User;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadFixtures
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFixtures extends BaseFixtures
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->registerUser($manager);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function registerUser(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setUsername('marol');
        $encodedPassword = $passwordEncoder->encodePassword($user, 'marol');
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $this->loadUserPosts($manager, $user);
    }

    /**
     * @param ObjectManager $manager
     * @param User $user
     */
    private function loadUserPosts(ObjectManager $manager, User $user)
    {
        foreach (range(1, 20) as $i) {
            $faker = $this->initializeFaker();

            $post = new Post();
            $post->setTitle($faker->text(100));
            $post->setContent($faker->realText(rand(2000, 2500)));
            $post->setPublishedAt(new \DateTime('now - ' . $i . 'days'));
            $post->setUser($user);

            $manager->persist($post);
        }
    }
}