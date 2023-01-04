<?php

namespace App\Repository\Football\Game;

use App\Entity\Football\Game\Game;
use App\Entity\Football\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function save(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPreviousByTeam(Team $team, \DateTime $date)
    {
        return $this->createQueryBuilder('m')
            ->where('m.teamHome = :team OR m.teamOutside = :team')->setParameter('team', $team)
            ->andWhere('m.date <= :date')->setParameter('date', $date)
            ->orderBy('m.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findNextByTeam(Team $team, \DateTime $date)
    {
        return $this->createQueryBuilder('m')
            ->where('m.teamHome = :team OR m.teamOutside = :team')->setParameter('team', $team)
            ->andWhere('m.date >= :date')->setParameter('date', $date)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
