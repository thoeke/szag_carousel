<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PierraaDesign.' . $_EXTKEY,
	'Carousel',
	array(
		'Slide' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Slide' => 'list',
		
	)
);
