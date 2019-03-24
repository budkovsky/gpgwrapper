<?php
/**
 * @author Budkovsky
 * @copyright 2019
 */
declare(strict_types=1);

namespace Budkovsky\GpgWrapper;

/**
 * GnuPG signature info container
 * Represents signle record from array returned by gnupg_verify()
 * @see http://php.net/manual/en/function.gnupg-verify.php
 */
class SignatureInfo
{
    /**
     * @var string
     */
    protected $fingerprint;
    
    /**
     * @var int
     */
    protected $validity;
    
    /**
     * @var int
     */
    protected $timestamp;
    
    /**
     * @var int
     */
    protected $status;
    
    /**
     * @var int
     */
    protected $summary;

    /**
     * The constructor
     * @param array $signatureInfo signature info, a single record from array returned by gnupg_verify()
     * @see http://php.net/manual/en/function.gnupg-verify.php
     */
    public function __construct(?array $signatureInfo = null)
    {
        if ($signatureInfo === null) {
            return;
        }
        if (isset($signatureInfo['fingerprint']) && is_string($signatureInfo['fingerprint'])) {
            $this->setFingerprint($signatureInfo['fingerprint']);
        }
        if (isset($signatureInfo['validity']) && is_int($signatureInfo['validity'])) {
            $this->setValidity($signatureInfo['validity']);
        }
        if (isset($signatureInfo['timestamp']) && is_int($signatureInfo['timestamp'])) {
            $this->setTimestamp($signatureInfo['timestamp']);
        }
        if (isset($signatureInfo['status']) && is_int($signatureInfo['status'])) {
            $this->setStatus($signatureInfo['status']);
        }
        if (isset($signatureInfo['summary']) && is_int($signatureInfo['summary'])) {
            $this->setSummary($signatureInfo['summary']);
        }
    }
    
    /**
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     * @return SignatureInfo
     */
    public function setFingerprint(string $fingerprint): SignatureInfo
    {
        $this->fingerprint = $fingerprint;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getValidity(): int
    {
        return $this->validity;
    }

    /**
     * @param int $validity
     * @return SignatureInfo
     */
    public function setValidity(int $validity): SignatureInfo
    {
        $this->validity = $validity;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return SignatureInfo
     */
    public function setTimestamp(int $timestamp): SignatureInfo
    {
        $this->timestamp = $timestamp;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return SignatureInfo
     */
    public function setStatus(int $status): SignatureInfo
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getSummary(): int
    {
        return $this->summary;
    }

    /**
     * @param int $summary
     * @return SignatureInfo
     */
    public function setSummary(int $summary): SignatureInfo
    {
        $this->summary = $summary;
        
        return $this;
    }

}
