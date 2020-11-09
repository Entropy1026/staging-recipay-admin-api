<?php
namespace Application\Infra\Repository;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class RepositoryFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $em = $container->get(EntityManager::class);
        return new $requestedName($em);
    }
}