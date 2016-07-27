<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Message
 * @package AppBundle\Model
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 * @Serializer\XmlRoot("message")
 */
class Message
{
    const NUM_ITEMS = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $authorId;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(
     *     targetEntity = "AppBundle\Model\MessageAuthor",
     *     inversedBy = "messages",
     *     cascade = {"persist"}
     * )
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * @Serializer\Exclude
     */
    private $author;

    /**
     * @return MessageAuthor
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param MessageAuthor $author
     */
    public function setAuthor(MessageAuthor $author)
    {
        $this->author = $author;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}