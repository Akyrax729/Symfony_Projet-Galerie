<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

   /**
    * @return Product[] Returns an array of Product objects
    */
   public function filterTags($tag, $price): array
   {
       $qb = $this->createQueryBuilder('p');
            if ($tag != 'all'){
                $qb = $qb
                ->leftJoin('p.tags', 't')
                ->andWhere('t.label = :tag')
                ->setParameter('tag', $tag)
            ;}
            if ($price != null){
                $qb = $qb
                ->andWhere('p.estimated_price <= :price')
                ->setParameter('price', $price)
            ;}
        ;
        return $qb->getQuery()->getResult();
   }
//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
