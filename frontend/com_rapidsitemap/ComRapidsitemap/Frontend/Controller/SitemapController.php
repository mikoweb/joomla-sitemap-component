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

namespace ComRapidsitemap\Frontend\Controller;

use Joomla\Rapid\Component\ControllerAbstract;
use \JRegistry;

/**
 * @author Rafał Mikołajun <rafal@vision-web.pl>
 * @package Joomla Rapid Sitemap Component
 * @subpackage Frontend_Component
 */
final class SitemapController extends ControllerAbstract
{
    public function sitemapFromMenuAction()
    {
        $doc = $this->container->get("document");
        $doc->renameRoot("urlset");
        $root = $doc->element('root');
        $root->attr("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

        return $this->render("@component/com_rapidsitemap/views/sitemap.xml.twig", array(
                "links" => $this->getDoctrine()
                    ->getRepository('ComRapidsitemap\Entities\Sitemap')
                    ->findAll()
            ));
    }
}
