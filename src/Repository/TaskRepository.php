<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }


public function findByTitle(string $term, User $user, string $direction, string $status): array
{
    $qb = $this->createQueryBuilder('t')
        ->andWhere('t.owner = :user')
        ->setParameter('user', $user)
        ->orderBy('t.createdAt', $direction);
    if (!empty($term)) {
        $qb->andWhere('t.title LIKE :term')
           ->setParameter('term', '%' . $term . '%');
    }
    if ($status === 'Done') {
        $qb->andWhere('t.isDone = :done')->setParameter('done', true);
    } elseif ($status === 'Open') {
        $qb->andWhere('t.isDone = :open')->setParameter('open', false);
    }

    return $qb->getQuery()->getResult();
}
    //    /**
    //     * @return Task[] Returns an array of Task objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Task
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}