<?php
/**
 * File: CloneHelper.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Helper;

trait CloneHelper
{
    public function cloneAttribute($value)
    {
        if (null === $value)
            return $value;
        return clone $value;
    }
}