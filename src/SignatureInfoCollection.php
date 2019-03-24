<?php
/**
 * @author Budkovsky
 * @copyright 2019
 */

namespace Budkovsky\GpgWrapper;

use Budkovsky\Aid\Collection;

/**
 * Collection of SignatureInfo objects
 */
class SignatureInfoCollection extends Collection
{
    protected $itemType = SignatureInfo::class;   
}

