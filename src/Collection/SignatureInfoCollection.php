<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\CollectionTrait;
use Budkovsky\GpgWrapper\Entity\SignatureInfo;

/**
 * Collection of SignatureInfo objects
 */
class SignatureInfoCollection implements \IteratorAggregate, \Countable
{
    use CollectionTrait;
    
    /**
     * Adds item to the collection
     * @param SignatureInfo $signatureInfo
     * @return SignatureInfoCollection
     */
    public function add(SignatureInfo $signatureInfo): SignatureInfoCollection
    {
        $this->collection[] = $signatureInfo;
        
        return $this;
    }
}
