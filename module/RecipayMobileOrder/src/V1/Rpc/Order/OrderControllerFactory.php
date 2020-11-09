<?php
namespace RecipayMobileOrder\V1\Rpc\Order;

use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Product\ProductRepository;
use RecipayIdentity\Domain\Billing\BillingRepository;
use RecipayIdentity\Domain\User\UserRepository;
use RecipayMobileOrder\Domain\Cart\CartRepository;
use RecipayMobileOrder\Domain\Order\OrderRepository;
use RecipayMobileOrder\Domain\Payment\PaymentRepository;

class OrderControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new OrderController(
            $container->get(OrderRepository::class),
            $container->get(CartRepository::class),
            $container->get(ProductRepository::class),
            $container->get(BillingRepository::class),
            $container->get(PaymentRepository::class),
            $container->get(UserRepository::class)         
        );
        
    }
}
