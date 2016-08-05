<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\BaseFixtures;
use AppBundle\Model\Message;
use AppBundle\Model\MessageAuthor;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;

/**
 * Class LoadFixtures
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFixtures extends BaseFixtures
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->registerMessageAuthors($manager);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function registerMessageAuthors(ObjectManager $manager)
    {
        foreach (range(1, 5) as $number) {
            /** @var Generator $faker */
            $faker = $this->initializeFaker();
            $date = $faker->dateTime();

            $author = new MessageAuthor();
            $author->setId($number);
            $author->setName($faker->name);
            $author->setEmail($faker->safeEmail);
            $author->setPhone($faker->phoneNumber);
            $author->setCreatedAt($date);
            $author->setUpdatedAt($date);

            $manager->persist($author);
            $manager->flush();

            $this->registerMessages($manager, $author);
        }
    }

    /**
     * @param ObjectManager $manager
     * @param MessageAuthor $author
     */
    private function registerMessages(ObjectManager $manager, MessageAuthor $author)
    {
        foreach (range(1, 10) as $number) {
            /** @var Generator $faker */
            $faker = $this->initializeFaker();
            $date = $faker->dateTime();

            $message = new Message();
            $message->setCreatedAt($date);
            $message->setContent($faker->text(rand(2000, 4000)));
            $message->setAuthorId($author->getId());
            $message->setAuthor($author);

            $manager->persist($message);
            $manager->flush();
        }
    }
}