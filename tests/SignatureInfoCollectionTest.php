<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use Budkovsky\GpgWrapper\Collection\SignatureInfoCollection;
use Budkovsky\GpgWrapper\Entity\SignatureInfo;

class SignatureInfoCollectionTest extends TestCase
{
    public function testCanCreateEmptyObject(): void
    {
        $this->assertInstanceOf(SignatureInfoCollection::class, new SignatureInfoCollection());
    }

    public function testCanAddItem(): void
    {
        $collection = new SignatureInfoCollection();
        $collection->add(new SignatureInfo());
        
        $this->assertGreaterThan(0, count($collection));
    }
    
    public function testIsIterable(): void
    {
        $this->assertIsIterable(new SignatureInfoCollection());
    }
    
    public function testCanAddRejectInvalidItem(): void
    {
        $this->expectException(\TypeError::class);
        
        $collection = new SignatureInfoCollection();
        $collection->add(new \stdClass());
    }
    
    public function testCanSetRejectIndex(): void
    {
        $this->expectException(\TypeError::class);
        
        $collection = new SignatureInfoCollection();
        $collection->set(0, new SignatureInfo());
    }
    
    public function testCanSetRejectInvalidItem(): void
    {
        $this->expectException(\TypeError::class);
        
        $collection = new SignatureInfoCollection();
        $collection->set(null, new \stdClass());
    }
}
