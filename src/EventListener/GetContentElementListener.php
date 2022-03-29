<?php

/**
 * This file is part of Vtt Bundle for Contao
 *
 * @package     tdoescher/vtt-bundle
 * @author      Torben Döscher <mail@tdoescher.de>
 * @license     LGPL
 * @copyright   tdoescher.de - WEB und IT <https://tdoescher.de>
 */

namespace tdoescher\VttBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ContentElement;
use Contao\ContentModel;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\StringUtil;
use Contao\System;

/**
 * @Hook("getContentElement")
 */
class GetContentElementListener
{
    public function __invoke(ContentModel $contentModel, string $buffer, $element): string
    {
        if($contentModel->type === 'player')
        {
            $tracks = StringUtil::deserialize($contentModel->playerTracks);

            if (empty($tracks) || !\is_array($tracks))
            {
                return $buffer;
            }

            $objTracks = FilesModel::findMultipleByUuids($tracks);

            if ($objTracks === null)
            {
                return $buffer;
            }

            $locale = System::getContainer()->get('request_stack')->getCurrentRequest()->getLocale();

            $html = '';

            foreach($objTracks as $track)
            {
                $meta = StringUtil::deserialize($track->meta);

                $objTemplate = new FrontendTemplate('player_tracks');
                $objTemplate->src = $track->path;
                $objTemplate->label = $meta[$locale]['title'];
                $objTemplate->kind = 'subtitles';
                $objTemplate->srclang = $locale;

                if(preg_match('/.*\\.([a-zA-Z]{2})\\.vtt$/u', $track->path))
                {
                    $objTemplate->srclang = substr($track->path, -6, -4);
                }
                else if(preg_match('/.*\\.(captions|chapters|descriptions|metadata)\\.vtt$/u', $track->path))
                {
                    $objTemplate->kind = preg_replace('/.*.(captions|chapters|descriptions|metadata).vtt$/u','$1', $track->path);
                    $objTemplate->srclang = false;
                }

                $objTemplate->default = $html === '' && $contentModel->playerTracksDefault;

                $html .= $objTemplate->parse();
            }

            return preg_replace("/<\/video>/is", $html.'</video>'.$html, $buffer);
        }

        return $buffer;
    }
}
