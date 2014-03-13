<?php
/**
 * File: SocialInformation.php
 * Date: 13/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\ValueObject;

class SocialInformation
{
    /** @var int number of persons who loves it */
    private $loves;

    private $facebookPage;

    private $twitterAccount;


    public function __construct($facebookPage = '', $twitterAccount = '', $loves = 0)
    {
        $this->loves            = $loves;
        $this->twitterAccount   = $twitterAccount;
        $this->facebookPage     = $facebookPage;
    }

    public function getLoves()
    {
        return $this->loves;
    }

    public function getFacebookPage()
    {
        return $this->facebookPage;
    }

    public function getTwitterAccount()
    {
        return $this->twitterAccount;
    }

    public function love()
    {
        $this->love++;
    }
} 