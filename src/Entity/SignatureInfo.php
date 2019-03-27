<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

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
     * GPG singature verify validity
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l360
     * @var int
     */
    protected $validity;
    
    /**
     * @var int
     */
    protected $timestamp;
    
    /**
     * GPG signature verify status
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l291
     * @var int
     */
    protected $status;
    
    /**
     * GPG signature verify summary
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l1506
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
        if (isset($signatureInfo['fingerprint'])) {
            $this->setFingerprint($signatureInfo['fingerprint']);
        }
        if (isset($signatureInfo['validity'])) {
            $this->setValidity($signatureInfo['validity']);
        }
        if (isset($signatureInfo['timestamp'])) {
            $this->setTimestamp($signatureInfo['timestamp']);
        }
        if (isset($signatureInfo['status'])) {
            $this->setStatus($signatureInfo['status']);
        }
        if (isset($signatureInfo['summary'])) {
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
