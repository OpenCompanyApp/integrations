<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Build OpenStreetMap map URLs.
 */
class OpenStreetMapMapUrl extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_map_url';
    protected const DESCRIPTION = 'Build a stable OpenStreetMap map URL centered on latitude and longitude.';
    protected const METHOD = 'mapUrl';

    public function parameters(): array
    {
        return OpenStreetMapParameters::mapUrl();
    }
}
