<?php
/**
 * @author Budkovsky
 * @copyright 2019
 */

namespace Budkovsky\GpgWrapper;

/**
 * Collection of SignatureInfo objects
 */
class SignatureInfoCollection extends \ArrayObject
{
    public function __construct(array $input = [], int $flags = 0 , string $iterator_class = "ArrayIterator")
    {
        
    }

    /**
     * {@inheritDoc}
     */
    public function append($value)
    {
        $this->offsetSet(null, $value);
    }
    
    /**
     * {@inheritDoc}
     * @throws GpgException
     */
    public function offsetSet($index, $newval)
    {
        if ($index !== null || !$newval  instanceof SignatureInfo) {
            throw new GpgException(sprintf(
                'Invalid parameters for method add element collection',
                __METHOD__,
                SignatureInfo::class
            ));
        }
        
        parent::offsetSet(null, $newval);
    }
    
    public function setFromArray(array $input): self
    {
        foreach ($input as $item) {
            $this->append($this->createItem($item));
        }
    }
    
    protected function createItem(array $signatureInfo): SignatureInfo
    {
        return new SignatureInfo($signatureInfo);
    }
}

