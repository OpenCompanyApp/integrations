<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Reverse geocode coordinates with Nominatim.
 */
class OpenStreetMapNominatimReverse extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_nominatim_reverse';
    protected const DESCRIPTION = 'Reverse geocode latitude and longitude with Nominatim.';
    protected const METHOD = 'nominatimReverse';

    public function parameters(): array
    {
        return OpenStreetMapParameters::reverse();
    }
}
