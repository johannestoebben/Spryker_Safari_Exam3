<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
 public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer):?AntelopeTransfer
 {
     $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
         $antelopeCriteriaTransfer->getName(),
     )->findOne();
     if(!$antelopeEntity){
         return null;
     }

     $antelopeTransfer = (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(), true);

     $locationEntity = $antelopeEntity->getPyzAntelopeLocation();
     if ($locationEntity !== null) {
         $antelopeTransfer->setLocation(
             (new AntelopeLocationTransfer())->fromArray($locationEntity->toArray(), true),
         );
     }

     return $antelopeTransfer;
 }

 public function findLocationById(int $idLocation): ?AntelopeLocationTransfer
 {
     $antelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()->findPk($idLocation);
     if (!$antelopeLocationEntity) {
         return null;
     }

     return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(), true);
 }
}
