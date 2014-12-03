<?php

/*
 * This file is part of the Joomla Rapid Sitemap Component
 *
 * website: www.vision-web.pl
 * (c) Rafał Mikołajun <rafal@vision-web.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ComRapidsitemap\Entities;

use ComRapidrouter\Model\RoutesModel;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use \JRoute;

/**
 * @Entity
 * @Table(name="sitemap")
 */
class Sitemap
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", length=1024)
     */
    private $loc;

    /**
     * @Column(type="date")
     */
    private $lastmod;

    /**
     * @Column(type="string", length=10)
     */
    private $changefreq;

    /**
     * @Column(type="decimal", precision=3, scale=2, nullable=true)
     */
    private $priority;

    /**
     * @Column(type="string", length=10)
     */
    private $type;

    /**
     * @var string
     */
    private $domain = '';

    /**
     * Adres do domeny
     * @return string
     */
    private function getDomain()
    {
        if (empty($this->domain)) {
            $url = parse_url(str_replace('&amp;', '&', \JURI::base()));
            $scheme = trim(isset($url['scheme']) ? $url['scheme'] : '');
            $domain = trim(isset($url['host']) ? $url['host'] : '');
            $this->domain = $scheme . "://" . $domain;
        }

        return $this->domain;
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        switch ($this->getType()) {
            case 'jroute':
                return $this->getDomain() . JRoute::_($this->loc);
                break;
            case 'route':
                return RoutesModel::parseFieldValue($this->loc);
                break;
            case 'internal':
                return $this->getDomain() . $this->loc;
                break;
            case 'external':
            default:
                return $this->loc;
        }
    }

    /**
     * @param string $loc
     */
    public function setLoc($loc)
    {
        $this->loc = $loc;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * @param string $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    /**
     * @return \DateTime
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param \DateTime $lastmod
     */
    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}
