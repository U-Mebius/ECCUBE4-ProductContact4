<?php

namespace Plugin\ProductContact4\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="plg_product_contact4_config")
 * @ORM\Entity(repositoryClass="Plugin\ProductContact4\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="insert_button_flg", type="boolean", nullable=false, options={"default": true})
     */
    private $insert_button_flg = true;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this;
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInsertButtonFlg()
    {
        return $this->insert_button_flg;
    }

    /**
     * @param bool $insert_button_flg
     * @return Config
     */
    public function setInsertButtonFlg($insert_button_flg)
    {
        $this->insert_button_flg = $insert_button_flg;
        return $this;
    }

}
