<?php
/**
 * @author Budkovsky
 * @copyright 2019
 */

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\Collection;
use Budkovsky\GpgWrapper\Entity\SignatureInfo;

/**
 * Collection of SignatureInfo objects
 */
class SignatureInfoCollection extends Collection
{
    protected $itemType = SignatureInfo::class;   
}

