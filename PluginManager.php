<?php

/*
 * This file is part of ProductContact42
 *
 * Copyright(c) U-Mebius Inc. All Rights Reserved.
 *
 * https://umebius.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductContact42;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\ProductContact42\Entity\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{
    public function enable(array $meta, ContainerInterface $container)
    {
        $em = $container->get('doctrine.orm.entity_manager');

        // プラグイン設定を追加
        $this->createConfig($em);
    }

    public function update(array $meta, ContainerInterface $container)
    {
        $em = $container->get('doctrine.orm.entity_manager');

        // プラグイン設定を追加
        $this->createConfig($em);
    }

    public function uninstall(array $meta, ContainerInterface $container)
    {
    }

    protected function createConfig(EntityManagerInterface $em)
    {
        $Config = $em->find(Config::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new Config();
        $Config->setId(1);
        $Config->setName('この商品を問い合わせる');
        $Config->setInsertButtonFlg(true);

        $em->persist($Config);
        $em->flush($Config);

        return $Config;
    }
}
