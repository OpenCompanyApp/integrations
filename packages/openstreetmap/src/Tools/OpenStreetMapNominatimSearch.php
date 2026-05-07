<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Search for places with Nominatim.
 */
class OpenStreetMapNominatimSearch extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_nominatim_search';
    protected const DESCRIPTION = 'Search OpenStreetMap places with Nominatim using free-form or structured address queries.';
    protected const METHOD = 'nominatimSearch';

    public function parameters(): array
    {
        return OpenStreetMapParameters::search();
    }
}
