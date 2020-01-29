# PGP Wrapper for PHP

PHP GnuPG object-oriented implementation. 
Wraps PHP functions from ext-gnupg extension to modern, PHP7-compatible objects with full type-hinting. 
No results returned by reference, no "false" boolean return on failed, when expecting scalar / object values. 
According to PHP7.1+ type-hinting rules, sometimes "null" can be returned instead.

## Requirements
* PHP 7.2+
* GnuPG PGP extension(ext-gnupg)

## Example of use

[&raquo; Example of the service in your application using this package](https://github.com/budkovsky/gpgwrapper/blob/master/src/Example/Service.php)
