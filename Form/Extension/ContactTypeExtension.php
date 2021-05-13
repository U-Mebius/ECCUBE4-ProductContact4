<?php

namespace Plugin\ProductContact4\Form\Extension;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Product;
use Eccube\Form\DataTransformer\EntityToIdTransformer;
use Eccube\Form\Type\Front\ContactType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ContactTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add($builder->create('Product', HiddenType::class, [
            'required' => false,
            'eccube_form_options' => [
                'auto_render' => true,
                'form_theme' => '@ProductContact4/Form/product_contact_layout.twig',
            ]
            ])
        ->addModelTransformer(new EntityToIdTransformer($this->entityManager, Product::class)));

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            if (isset($data['Product']) && !is_null($data['Product'])) {
                $form = $event->getForm();
                $form['contents']->setData('「'.$data['Product']->getName().'」についての問い合わせです。');
            }
        });
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getExtendedType()
    {
        return ContactType::class;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getExtendedTypes(): iterable
    {
        return [ContactType::class];
    }
}
