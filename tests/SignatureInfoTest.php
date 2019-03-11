<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use Budkovsky\GpgWrapper\SignatureInfo;

class SignatureInfoTest extends TestCase
{
    public function testCanCreateEmptyObject(): void
    {
        $this->assertInstanceOf(SignatureInfo::class, new SignatureInfo());
    }
    
    public function testCanCreateFromArray(): void
    {
        $array = $this->getSignatureInfoArray();
        $signatureInfo = new SignatureInfo($array);
        
        $this->assertInstanceOf(SignatureInfo::class, $signatureInfo);
        $this->assertEquals($array['fingerprint'], $signatureInfo->getFingerprint());
        $this->assertEquals($array['validity'], $signatureInfo->getValidity());
        $this->assertEquals($array['timestamp'], $signatureInfo->getTimestamp());
        $this->assertEquals($array['status'], $signatureInfo->getStatus());
        $this->assertEquals($array['summary'], $signatureInfo->getSummary());
    }
    
    protected function getSignatureInfoArray(
        string $fingerprint = 'abcdefghij',
        int $validity = 2,
        int $timestamp = 1552343579,
        int $status = 4,
        int $summary = 9
    ): array
    {
        return [
            'fingerprint' => $fingerprint,
            'validity' => $validity,
            'timestamp' => $timestamp,
            'status' => $status,
            'summary' => $summary
        ];
    }
}