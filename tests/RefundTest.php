<?php
namespace Transbank\OnePay;

use PHPUnit\Framework\TestCase;

final class RefundTest extends TestCase 
{

    protected function setup()
    {
        OnePayBase::setSharedSecret("P4DCPS55QB2QLT56SQH6#W#LV76IAPYX");
        OnePayBase::setApiKey("mUc0GxYGor6X8u-_oB3e-HWJulRG01WoC96-_tUA3Bg");
        $this->externalUniqueNumber = "1532376544050";
        $this->occ = "1807829988419927";
        $this->authorizationCode = "497490";
    }

    public function testRefundWithOptionsWorks()
    {
        $apiKey = OnePayBase::getApiKey();
        $sharedSecret = OnePayBase::getSharedSecret();
        $options = new Options($apiKey, $sharedSecret);

        $httpResponse = Refund::create(27500, $this->occ,
                                       $this->externalUniqueNumber,
                                       $this->authorizationCode, $options);
        $this->assertEquals($httpResponse->getResponseCode(), 'OK');
        $this->assertEquals($httpResponse->getDescription(), 'OK');
    }

    public function testRefundWithoutOptionsWorks()
    {
        $apiKey = OnePayBase::getApiKey();
        $sharedSecret = OnePayBase::getSharedSecret();

        $httpResponse = Refund::create(27500, $this->occ,
                                       $this->externalUniqueNumber,
                                       $this->authorizationCode);
        $this->assertEquals($httpResponse->getResponseCode(), 'OK');
        $this->assertEquals($httpResponse->getDescription(), 'OK');
    }
    
    public function testRefundRaisesExceptionWhenInvalid()
    {
        $apiKey = OnePayBase::getApiKey();
        $sharedSecret = OnePayBase::getSharedSecret();
        $options = new Options($apiKey,$sharedSecret);

        // It should raise an exception when failing
        $this->setExpectedException(\Transbank\OnePay\Exceptions\RefundCreateException::class);
        $httpResponse = Refund::create(27500, "INVALID OCC", "12345someextuniqnum", "f506a955-800c-4185-8818-4ef9fca97aae",
                                       $options);
        $this->assertEquals($httpResponse->getResponseCode(), 'INVALID_PARAMS');
        $this->assertEquals($httpResponse->getDescription(), 'Parametros invalidos');
    }
}