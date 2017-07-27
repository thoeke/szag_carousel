<?php
namespace PierraaDesign\SzagCarousel\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Markus Klinger <klinger@pierraa-design.de>, PierraaDesign Werbeagentur GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * SlideController
 */
class SlideController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * slideRepository
	 *
	 * @var \PierraaDesign\SzagCarousel\Domain\Repository\SlideRepository
	 * @inject
	 */
	protected $slideRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$this->contentObj = $this->configurationManager->getContentObject();

		$settings = $this->settings;
		$settings['contentObjectUid'] = $this->contentObj->data['uid'];
		$slides = $this->slideRepository->findSlides( $settings['slides']);
		$this->view->assign('slides', $slides);
		$this->view->assign('settings', $settings);

		switch ($this->settings['mode']) {
			case 0:
				$slick['id'] = "#sz-carousel_content-mode_".$settings['contentObjectUid'];
				$slick['options']['fade'] = 'true';
				$slick['options']['cssEase'] = 'linear';
				$slick['options']['dots'] = 'true';
				break;

			case 1:
				$slick['id'] = "#sz-carousel_fullwidth-mode_".$settings['contentObjectUid'];
				$slick['options']['dots'] = 'true';
				break;

            case 4:
    			$slick['id'] = "#sz-carousel_overhead-mode_".$settings['contentObjectUid'];
    			$slick['options']['dots'] = 'true';
    			break;

			default:
				$slick['id'] = "#sz-carousel_default-mode_".$settings['contentObjectUid'];
				$slick['options']['dots'] = 'true';
				break;
		}

		if(!empty($this->settings['autoslide'])) {
			$slick['options']['autoplay'] = 'true';
			$slick['options']['autoplaySpeed'] = $this->settings['autoslide'];
		}

		foreach ($slick['options'] as $key => $value) {
			$slickOptions .= $key.":".$value.", ";
		}

		$GLOBALS['TSFE']->additionalFooterData[$this->extKey."_".$settings['contentObjectUid']] .= '<script>';
		$GLOBALS['TSFE']->additionalFooterData[$this->extKey."_".$settings['contentObjectUid']] .= "$('".$slick['id']."').slick({".$slickOptions."});";
		$GLOBALS['TSFE']->additionalFooterData[$this->extKey."_".$settings['contentObjectUid']] .= '</script>';

	}

}
