<?php

namespace Louvre\FrontBundle\Repository;

/**
 * OrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderRepository extends \Doctrine\ORM\EntityRepository
{

    public function find($id, $lockMode = null, $lockVersion = null)
    {

        return $this->createQueryBuilder('o')
            ->addSelect('o')
            ->join('o.tickets', 't')
            ->andWhere('t.id = 2')
        ->getQuery()
        ->getResult()
        ;
    }
}
