<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Execute an Overpass QL query.
 */
class OpenStreetMapOverpassQuery extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_overpass_query';
    protected const DESCRIPTION = 'Execute an Overpass QL query against the public Overpass API. Include [out:json] for parsed JSON responses.';
    protected const METHOD = 'overpassQuery';

    public function parameters(): array
    {
        return OpenStreetMapParameters::overpassQuery();
    }
}
