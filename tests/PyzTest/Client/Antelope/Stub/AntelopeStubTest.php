<?php

namespace PyzTest\Client\Antelope\Stub;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Client\Antelope\Stub\AntelopeStub;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

/**
 * @group PyzTest
 * @group Client
 * @group Antelope
 * @group AntelopeStubTest
 */
class AntelopeStubTest extends Unit
{
    public function testGetAntelopeLocationCallsZedGatewayAction(): void
    {
        // Arrange
        $criteriaTransfer = (new AntelopeLocationCriteriaTransfer())->setLocationName('Serengeti');
        $expectedResponse = (new AntelopeLocationResponseTransfer())
            ->setIsSuccessful(true)
            ->setAntelopeLocation((new AntelopeLocationTransfer())->setLocationName('Serengeti'));

        $zedRequestClientMock = $this->createMock(ZedRequestClientInterface::class);
        $zedRequestClientMock->expects($this->once())
            ->method('call')
            ->with('/antelope/gateway/get-antelope-location', $criteriaTransfer)
            ->willReturn($expectedResponse);

        // Act
        $result = (new AntelopeStub($zedRequestClientMock))->getAntelopeLocation($criteriaTransfer);

        // Assert
        $this->assertSame($expectedResponse, $result);
    }
}
