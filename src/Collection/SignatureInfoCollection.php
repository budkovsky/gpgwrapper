<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\GpgWrapper\Entity\SignatureInfo;
use Budkovsky\Aid\Abstraction\CollectionAbstract;

/**
 * Collection of SignatureInfo objects
 */
class SignatureInfoCollection extends CollectionAbstract
{
    /**
     * Adds item to the collection
     * @param SignatureInfo $signatureInfo
     * @return SignatureInfoCollection
     */
    public function add(?SignatureInfo $signatureInfo=null): SignatureInfoCollection
    {
        if ($signatureInfo) {
            $this->collection[] = $signatureInfo;
        }

        return $this;
    }
}
