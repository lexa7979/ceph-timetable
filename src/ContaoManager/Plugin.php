<?php

namespace Cepharum\TimetableBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Cepharum\TimetableBundle\CepharumTimetableBundle')
                ->setLoadAfter([
					'Contao\CoreBundle\ContaoCoreBundle',
					'Contao\ManagerBundle\ContaoManagerBundle'
				])
				->setReplace(['ceph-timetable'])
        ];
    }
}
