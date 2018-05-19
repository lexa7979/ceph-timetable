<?php

namespace Cepharum\Timetable;

/**
 * Front end module
 */

class ModuleTimetable extends \Module {

    /**
	 * Title of the corresponding template
	 * 
     * @var string
     */
    protected $strTemplate = 'mod_timetable';

    /**
     * (Do not display the module if there are no menu items)
     *
     * @return string
     */
    public function generate() {

		// // Display a wildcard in the back end:
        // if (TL_MODE == 'BE') {
        //     /** @var \BackendTemplate|object $objTemplate */
        //     $objTemplate = new \BackendTemplate('be_wildcard');

        //     $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['ModuleCarList'][0]) . ' ###';
        //     $objTemplate->title = $this->headline;
        //     $objTemplate->id = $this->id;
        //     $objTemplate->link = $this->name;
        //     $objTemplate->href = 'contao?do=themes&table=tl_module&act=edit&id=' . $this->id;

        //     return $objTemplate->parse();
        // }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile() {

        // $carService = \System::getContainer()->get('xuad_car.service.carservice');

        // $carList = $carService->findAll();

        // $this->Template->carList = $carList;
    }
}
