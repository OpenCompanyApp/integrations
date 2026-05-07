<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Get detailed Nominatim place information.
 */
class OpenStreetMapNominatimDetails extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_nominatim_details';
    protected const DESCRIPTION = 'Get detailed Nominatim place information by place_id or OSM object reference.';
    protected const METHOD = 'nominatimDetails';

    public function parameters(): array
    {
        return OpenStreetMapParameters::details();
    }
}
