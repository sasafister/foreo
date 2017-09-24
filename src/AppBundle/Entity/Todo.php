<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="todo")
 * @ORM\Entity()
 */
class Todo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $scheduled_at;

    /**
     * @return mixed
     */
    public function getScheduledAt()
    {
        return $this->scheduled_at;
    }

    /**
     * @param mixed $scheduled_at
     */
    public function setScheduledAt($scheduled_at)
    {
        $this->scheduled_at = $scheduled_at;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}