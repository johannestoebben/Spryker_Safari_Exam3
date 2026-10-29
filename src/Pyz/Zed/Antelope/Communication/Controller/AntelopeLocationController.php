<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Faker\Factory as FakerFactory;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 */
class AntelopeLocationController extends AbstractController
{
    protected const PARAM_ID = 'id';
    protected const PARAM_LOCATION_NAME = 'locationName';

    protected const URL_INDEX = '/antelope/antelope-location';
    protected const URL_GET = '/antelope/antelope-location/get?id=%d';

    /**
     * @return array<string,mixed>
     */
    public function indexAction(): array
    {
        return $this->viewResponse([
            'antelopeLocations' => $this->getFacade()->getAntelopeLocationCollection()->getAntelopeLocations(),
        ]);
    }

    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $locationName = $request->get(static::PARAM_LOCATION_NAME);
        if (!$locationName) {
            $locationName = FakerFactory::create()->city();
        }
        $antelopeLocationTransfer->setLocationName($locationName);
        $antelopeLocationTransfer = $this->getFacade()->createLocation($antelopeLocationTransfer);

        return $this->viewResponse(['antelopeLocation' => $antelopeLocationTransfer]);
    }

    /**
     * @param Request $request
     * @return array<string,mixed>|RedirectResponse
     */
    public function getAction(Request $request): array|RedirectResponse
    {
        $antelopeLocationCriteriaTransfer = (new AntelopeLocationCriteriaTransfer())
            ->setIdAntelopeLocation($this->castId($request->get(static::PARAM_ID)));
        $antelopeLocationResponseTransfer = $this->getFacade()->getAntelopeLocation($antelopeLocationCriteriaTransfer);

        if (!$antelopeLocationResponseTransfer->getIsSuccessful()) {
            $this->addErrorMessage('Antelope location not found.');

            return $this->redirectResponse(static::URL_INDEX);
        }

        return $this->viewResponse(['antelopeLocation' => $antelopeLocationResponseTransfer->getAntelopeLocation()]);
    }

    public function updateAction(Request $request): RedirectResponse
    {
        $idAntelopeLocation = $this->castId($request->get(static::PARAM_ID));
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())
            ->setIdAntelopeLocation($idAntelopeLocation)
            ->setLocationName($request->get(static::PARAM_LOCATION_NAME));
        $antelopeLocationResponseTransfer = $this->getFacade()->updateLocation($antelopeLocationTransfer);

        if (!$antelopeLocationResponseTransfer->getIsSuccessful()) {
            $this->addErrorMessage('Antelope location not found.');

            return $this->redirectResponse(static::URL_INDEX);
        }

        $this->addSuccessMessage('Antelope location updated.');

        return $this->redirectResponse(sprintf(static::URL_GET, $idAntelopeLocation));
    }

    public function deleteAction(Request $request): RedirectResponse
    {
        try {
            $isDeleted = $this->getFacade()->deleteLocation($this->castId($request->get(static::PARAM_ID)));
        } catch (PropelException) {
            $this->addErrorMessage('Antelope location is still used by an antelope and cannot be deleted.');

            return $this->redirectResponse(static::URL_INDEX);
        }

        if (!$isDeleted) {
            $this->addErrorMessage('Antelope location not found.');

            return $this->redirectResponse(static::URL_INDEX);
        }

        $this->addSuccessMessage('Antelope location deleted.');

        return $this->redirectResponse(static::URL_INDEX);
    }
}
