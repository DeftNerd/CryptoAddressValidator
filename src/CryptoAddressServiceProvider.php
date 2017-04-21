<?php

namespace DeftNerd\CryptoAddressValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use StephenHill\Base58;

class CryptoAddressServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // bitcoin address validator
        Validator::extend('bitcoin', function ($attribute, $value, $parameters, $validator) {
            $conditions = [];
            $conditions[] = strlen($value) <= 34;
            $conditions[] = strlen($value) >= 26;
            try { 
                $base58decoder = new Base58();
                $decoded = strtoupper(bin2hex($base58decoder->decode($value)));
            } catch (Exception $e) { 
                return false; 
            }

            $conditions[] = strlen($decoded) == 50;

            if (count($parameters) > 0) {
                switch (strtolower($parameters[0])) {
                    case 'mainnet':
                        $conditions[] = in_array(substr($decoded, 0, 2), array('00', '05'));
                    case 'testnet':
                        $conditions[] = in_array(substr($decoded, 0, 2), array('6F', 'C4'));
                    default:
                        throw new Exception($parameters[0]." is not a supported bitcoin network type.", 1);
                }
            } else {
                $conditions[] = in_array(substr($decoded, 0, 2), array('00', '05', '6F', 'C4'));
            }

            $conditions[] = strtoupper(substr(hash('sha256', hex2bin(hash('sha256', hex2bin(substr($decoded, 0, -8))))), 0, 8)) == substr($decoded, -8);

            return (bool) array_product($conditions);
        });


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }


}