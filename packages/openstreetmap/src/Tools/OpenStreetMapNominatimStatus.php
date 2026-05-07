<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Check Nominatim service status.
 */
class OpenStreetMapNominatimStatus extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_nominatim_status';
    protected const DESCRIPTION = 'Check Nominatim service status.';
    protected const METHOD = 'nominatimStatus';

    public function parameters(): array
    {
        return OpenStreetMapParameters::status();
    }
}
