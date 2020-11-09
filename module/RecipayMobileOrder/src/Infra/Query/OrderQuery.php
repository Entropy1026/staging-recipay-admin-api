<?php
namespace RecipayMobileOrder\Infra\Query;

use RecipayMobileOrder\Infra\Entity\Order;
use Doctrine\ORM\QueryBuilder;

class OrderQuery {

    private $qb;

    function __construct(QueryBuilder $qb) {
        $this->qb = $qb;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder() {
        return $this->qb;
    }

    public function select() {
        $qb = $this->qb;
        $qb->select("o");
        $qb->from(Order::class, "o");
        $qb->addOrderBy("o.id","ASC");
        return $this;
    }
    public function myOrder($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.user", $qb->expr()->literal($id)));
        return $this;
    }
    public function findby($field,$id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.$field", $qb->expr()->literal($id)));
        return $this;
    }
    public function findbyUser($user,$id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.id", $qb->expr()->literal($id)));
        $qb->andWhere($qb->expr()->eq("o.user", $qb->expr()->literal($user)));
        $qb->andWhere($qb->expr()->eq("o.order_status", $qb->expr()->literal('Delivered')));
        return $this;
    }
    public function existingOrders($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.user", $qb->expr()->literal($id)));
        // $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Delivered")));
        // $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Cancelled")));
        return $this;
    }
    public function carrierdelivery($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.carrier", $qb->expr()->literal($id)));
        // $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Delivered")));
        // $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Cancelled")));
        return $this;
    }
    public function ordersforconfirmation(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.order_status", $qb->expr()->literal("Waiting Confirmation")));
        return $this;
    }
    public function ordersforpreparation(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.order_status", $qb->expr()->literal("On Proccess")));
        return $this;
    }
    public function delivered(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("o.order_status", $qb->expr()->literal("Delivered")));
        return $this;
    }
    public function onproccessOrders(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("On Proccess")));
        $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Cancelled")));
        $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Waiting Confirmation")));
        $qb->andWhere($qb->expr()->neq('o.order_status', $qb->expr()->literal("Delivered")));
       
        return $this;
    }
  
}
