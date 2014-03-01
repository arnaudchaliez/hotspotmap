<?php
/**
 * File: InvokeAttribute.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Helper;

trait InvokeAttribute
{
    public function invokeAttribute($object, $attribute)
    {
        if (0 === strpos($attribute, 'get')) {
            return $object->$attribute();
        }
        return $object->$attribute;
    }
} 