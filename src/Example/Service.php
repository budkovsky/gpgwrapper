<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Example;

use Budkovsky\GpgWrapper\GpgWrapper;
use Budkovsky\GpgWrapper\GpgEnum;
use Budkovsky\GpgWrapper\Collection\SignatureInfoCollection;
use Budkovsky\GpgWrapper\Entity\ImportResult;
use Budkovsky\GpgWrapper\Entity\SignatureInfo;
use Budkovsky\GpgWrapper\Entity\VerifyResult;

/**
 * An example service, demonstration how you can use GpgWrapper library in your project
 */
class Service
{
    /**
     * @var GpgWrapper
     */
    protected $gpg;
    
    /**
     * @var string
     */
    protected $ourPrivateKeyFingerprint;

    /**
     * @var string
     */
    protected $partnerPublicKeyFingerprint;
    
    /**
     * The constructor
     * @return self
     */
    public function __construct()
    {
        $this->gpg = new GpgWrapper();
        $this->gpg
            ->setArmor(1)
            ->setErrorMode(GpgEnum::ERROR_MODE_EXCEPTION)
            ->setSignMode(GpgEnum::SIGN_MODE_NORMAL)
        ;
    }
    
    /**
     * Imports GPG keys and assign them do sign/decrypt/encrypt actions
     * @param string $ourPrivateKey
     * @param string $partnerPublicKey
     * @throws ServiceException
     * @return self
     */
    public function setKeys(string $ourPrivateKey, string $partnerPublicKey): self
    {
        //import our private key and set it as decrypt/sign key
        $importResult = $this->gpg->import($ourPrivateKey);
        if (!$this->isImportResultValid($importResult)) {
            throw new ServiceException('GPG: our private key import failure');
        }
        $this->ourPrivateKeyFingerprint = $importResult->getFingerprint();
        $this->gpg->addDecryptKey($importResult->getFingerprint());
        $this->gpg->addSignKey($importResult->getFingerprint());
        unset($importResult);
        
        //import partner's public key and set it as encrypt key
        $importResult = $this->gpg->import($partnerPublicKey);
        if (!$this->isImportResultValid($importResult)) {
            throw new ServiceException('GPG: parnter\'s public key import failure');
        }
        $this->partnerPublicKeyFingerprint = $importResult->getFingerprint();
        $this->gpg->addEncryptKey($importResult->getFingerprint());
        unset($importResult);
        
        return $this;
    }

    /**
     * Sign and write a file
     * @param string $inputPath local path for file to sign
     * @param string $outputPath local path for signed file
     * @return bool
     */
    public function signAndWrite(string $inputPath, string $outputPath): bool
    {
        $content = file_get_contents($inputPath);
        $signedContent = $this->gpg->sign($content);
        
        return $this->write($outputPath, $signedContent);
    }
    
    /**
     * Encrypt and write a file
     * @param string $inputPath local path for file to encrypt
     * @param string $outputPath local path for encrypted file
     * @return bool
     */
    public function encryptAndWrite(string $inputPath, string $outputPath): bool
    {
        $content = file_get_contents($inputPath);
        $encryptionResult = $this->gpg->encrypt($content);
        
        return $this->write($outputPath, $encryptionResult);
    }
    
    /**
     * Encrypt, sign and write a file
     * @param string $inputPath
     * @param string $outputPath
     * @return bool
     */
    public function encryptSignAndWrite(string $inputPath, string $outputPath): bool
    {
        $content = file_get_contents($inputPath);
        $encryptedSignedContent = $this->gpg->encryptSign($content);
        
        return $this->write($outputPath, $encryptedSignedContent);
    }
    
    /**
     * @param string $inputPath
     * @param string $outputPath
     * @throws ServiceException
     * @return bool
     */
    public function verifyAndWrite(string $inputPath, string $outputPath): bool
    {
        $content = file_get_contents($inputPath);
        $verifyResult = $this->gpg->verify($content);
        $signatureInfo = $this->getSignatureFromCollection($verifyResult->getSignatureInfoCollection());
        if (!$this->isPartnerSignatureValid($signatureInfo)) {
            throw new ServiceException('Invalid partner\'s PGP signature');
        }
        
        return $this->write($outputPath, $verifyResult->getPlaintext());
    }
    
    /**
     * @param string $inputPath
     * @param string $outputPath
     * @throws ServiceException
     * @return bool
     */
    public function decryptAndWrite(string $inputPath, string $outputPath): bool
    {
        $content = file_get_contents($inputPath);
        $decryptedContent = $this->gpg->decrypt($content);
        if ($decryptedContent === false) {
            throw new ServiceException('GPG decryption failed');
        }
        
        return $this->write($outputPath, $decryptedContent);
    }
    
    /**
     * Decrypt, verify and write a plaintext file
     * @param string $inputPath
     * @param string $outputPath
     * @throws ServiceException
     * @return bool
     */
    public function decryptVerifyAndWrite(string $inputPath, string $outputPath): VerifyResult
    {
        $content = file_get_contents($inputPath);
        $decryptVerifyResult = $this->gpg->decryptVerify($content);
        $signatureInfo = $this->getSignatureFromCollection($decryptVerifyResult->getSignatureInfoCollection());
        if (!$this->isPartnerSignatureValid($signatureInfo)) {
            throw new ServiceException('Invalid partner\'s PGP signature');
        }
        
        return $this->write($outputPath, $decryptVerifyResult->getPlaintext());
    }
    
    /**
     * Validates partner signature
     * @param SignatureInfo $signatureInfo
     * @return bool
     */
    protected function isPartnerSignatureValid(?SignatureInfo $signatureInfo): bool
    {
        if ($signatureInfo === null) {
            return false;
        }
        if ($signatureInfo->getFingerprint() != $this->partnerPublicKeyFingerprint) {
            return false;
        }
        
        return true;
    }
    
    /**
     * @param array
     * @return bool
     */
    protected function isImportResultValid(ImportResult $importResult): bool
    {
        return
            is_string($importResult->getFingerprint())
            && strlen($importResult->getFingerprint()) >= GpgEnum::FINGERPRINT_MINIMUM_LENGTH
        ;
    }

    /**
     * Writes local file
     * @param string $filePath Local path for file to write
     * @param string $content Content for file to wrtie
     * @return bool true on success, false on failure
     */
    protected function write(string $filePath, string $content): bool
    {
        return file_put_contents($filePath, $content) !== false ?: false;
    }
    
    /**
     * @param SignatureInfoCollection $signatureInfoCollection
     * @param int $index
     */
    protected function getSignatureFromCollection(
        SignatureInfoCollection $signatureInfoCollection,
        int $index = 0
    ): ?SignatureInfo {
        return $signatureInfoCollection[$index] ?? null;
    }
}
