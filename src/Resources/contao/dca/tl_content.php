<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['player'] = str_replace
(
    '{source_legend},playerSRC;',
    '{source_legend},playerSRC;{playerTracksLegend},playerTracks,playerTracksDefault;',
    $GLOBALS['TL_DCA']['tl_content']['palettes']['player']
);

$GLOBALS['TL_DCA']['tl_content']['fields']['playerTracks'] = array
(
    'label'             => &$GLOBALS['TL_LANG']['tl_content']['playerTracks'],
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => array
    (
        'multiple' => true,
        'fieldType' => 'checkbox',
        'files' => true,
        'filesOnly' => true,
        'mandatory' => false,
        'extensions' => 'vtt',
        'isSortable' => true
    ),
    'sql'               => 'blob NULL'
);

$GLOBALS['TL_DCA']['tl_content']['fields']['playerTracksDefault'] = array
(
    'label'             => &$GLOBALS['TL_LANG']['tl_content']['playerTracksDefault'],
    'exclude'           => true,
    'toggle'            => true,
    'inputType'         => 'checkbox',
    'sql'               => "char(1) NOT NULL default ''"
);
