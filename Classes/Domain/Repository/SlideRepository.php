<?php
namespace PierraaDesign\SzagCarousel\Domain\Repository;


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
 * The repository for Slides
 */
class SlideRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

		protected $defaultOrderings = array(
			'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
		);

		// Repository wide settings
		public function initializeObject() {
			/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
			$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
			$querySettings->setRespectStoragePage(FALSE);
			$this->setDefaultQuerySettings($querySettings);
		}

	/**
	 * @param $slides
	 */
	public function findSlides( $slides ) {
            
            $slides = explode(',', $slides );
            $result = [];
            
            foreach ($slides as $slide) {
                $query = $this->createQuery();
                $field = $query->matching($query->equals('uid', $slide))->execute()->getFirst();
                if ($field !== null) {
                    $result[] = $field;
                }
            }
            return $result;
	}

}
