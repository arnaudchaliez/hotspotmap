<?php
/**
 * File: Price.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Model\ValueObject;


class Price
{
    private $value;

    private static $rates = [
        '$' => 1.0,
        '€' => 0.72997,
    ];

    public function __construct($value = 0.0, $currency = null)
    {
        $this->setValue($value, $currency);
    }

    public function getValue($currency = null)
    {
        if($currency === null) {
            return $this->value;
        }
        return Price::getRate($currency) * $this->value;
    }

    public function setValue($value, $currency = null)
    {
        if($currency === null) {
            return $this->value = $value;
        }
        else {
            $this->value = Price::getRate($currency) / $this->value;
        }
    }

    public static function getRate($currency)
    {
        if(array_key_exists($currency, Price::$rates)) {
            return Price::$rates[$currency];
        }
        return 1.0;
    }
} 