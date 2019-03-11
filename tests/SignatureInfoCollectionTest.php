<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use Budkovsky\GpgWrapper\SignatureInfoCollection;
use Budkovsky\GpgWrapper\SignatureInfo;
use Budkovsky\GpgWrapper\GpgException;

class SignatureInfoCollectionTest extends TestCase
{
    public function testCanCreateEmptyObject(): void
    {
        $this->assertInstanceOf(SignatureInfoCollection::class, new SignatureInfoCollection());
    }

    public function testCanAppendItem(): void
    {
        $collection = new SignatureInfoCollection();
        $collection->append(new SignatureInfo());
        
        $this->assertGreaterThan(0, count($collection));
    }
    
    public function testIsIterable(): void
    {
        $this->assertIsIterable(new SignatureInfoCollection());
    }
    
    public function testCanAppendRejectInvalidItem(): void
    {
        $this->expectException(GpgException::class);
        
        $collection = new SignatureInfoCollection();
        $collection->append(new \stdClass());
    }
    
    public function testCanOffsetsetRejectIndex(): void
    {
        $this->expectException(GpgException::class);
        
        $collection = new SignatureInfoCollection();
        $collection->offsetSet(0, new SignatureInfo());
    }
    
    public function testCanOffsetsetRejectInvalidItem(): void
    {
        $this->expectException(GpgException::class);
        
        $collection = new SignatureInfoCollection();
        $collection->offsetSet(null, new \stdClass());
    }
}

