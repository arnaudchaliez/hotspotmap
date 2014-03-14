<?php
/**
 * File: Status.php
 * Date: 13/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\ValueObject;

class Status {
    const Waiting = 0;
    const Validate = 1;
    const Rejected = 2;
}
