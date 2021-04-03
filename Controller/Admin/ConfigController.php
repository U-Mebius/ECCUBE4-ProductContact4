<?php

namespace Plugin\ProductContact4\Controller\Admin;

use Eccube\Controller\AbstractController;
use Plugin\ProductContact4\Entity\Config;
use Plugin\ProductContact4\Form\Type\Admin\ConfigType;
use Plugin\ProductContact4\Repository\ConfigRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractController
{
    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * ConfigController constructor.
     *
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/product_contact4/config", name="product_contact4_admin_config")
     * @Template("@ProductContact4/admin/config.twig")
     */
    public function index(Request $request)
    {
        $Config = $this->configRepository->get();

        if (!$Config) {
            $Config = new Config();
            $Config->setId(1);
            $Config->setName('この商品を問い合わせる');
            $Config->setInsertButtonFlg(true);
        }

        $form = $this->createForm(ConfigType::class, $Config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($Config);
            $this->entityManager->flush();
            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('product_contact4_admin_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
