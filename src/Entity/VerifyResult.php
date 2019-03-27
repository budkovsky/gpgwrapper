<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

use Budkovsky\GpgWrapper\Collection\SignatureInfoCollection;

/**
 * GnuPG verify action's results container
 * Agregates signature info array returned directly and plaintext returned in reference
 * @see http://php.net/manual/en/function.gnupg-verify.php
 */
class VerifyResult
{
    /**
     * @var SignatureInfoCollection
     */
    protected $signatureInfoCollection;
    
    /**
     * @var string
     */
    protected $plaintext;
    
    /**
     * The constructor
     * @param SignatureInfoCollection $signatureInfoCollection
     * @param string $plainText
     */
    public function __construct(?SignatureInfoCollection $signatureInfoCollection = null, ?string $plaintext = null)
    {
        if ($signatureInfoCollection !== null) {
            $this->setSignatureInfoCollection($signatureInfoCollection);
        }
        if ($plaintext !== null) {
            $this->setPlaintext($plaintext);
        }
    }

    /**
     * @return SignatureInfoCollection
     */
    public function getSignatureInfoCollection(): ?SignatureInfoCollection
    {
        return $this->signatureInfoCollection;
    }

    /**
     * @param SignatureInfoCollection $signatureInfoCollection
     * @return VerifyResult
     */
    public function setSignatureInfoCollection(SignatureInfoCollection $signatureInfoCollection): VerifyResult
    {
        $this->signatureInfoCollection = $signatureInfoCollection;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaintext(): ?string
    {
        return $this->plaintext;
    }

    /**
     * @param string $plaintext
     * @return VerifyResult
     */
    public function setPlaintext(string $plaintext): VerifyResult
    {
        $this->plaintext = $plaintext;
        
        return $this;
    }
}
