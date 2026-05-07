<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Look up OSM objects with Nominatim.
 */
class OpenStreetMapNominatimLookup extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_nominatim_lookup';
    protected const DESCRIPTION = 'Look up address details for OpenStreetMap object IDs with Nominatim.';
    protected const METHOD = 'nominatimLookup';

    public function parameters(): array
    {
        return OpenStreetMapParameters::lookup();
    }
}
