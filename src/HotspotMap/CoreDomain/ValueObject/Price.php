<?php
/**
 * File: Price.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\ValueObject;

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
        if (null === $currency) {
            return $this->value;
        }
        return Price::getRate($currency) * $this->value;
    }

    public function setValue($value, $currency = null)
    {
        $this->value = $value;
        if (null !== $currency) {
            $this->value /= Price::getRate($currency);
        }
    }

    public static function getRate($currency)
    {
        if (array_key_exists($currency, Price::$rates)) {
            return Price::$rates[$currency];
        }
        return 1.0;
    }

    public function __toString()
    {
        return (string)$this->getValue();
    }
} 