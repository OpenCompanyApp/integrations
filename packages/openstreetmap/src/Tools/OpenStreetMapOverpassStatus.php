<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Check Overpass API status.
 */
class OpenStreetMapOverpassStatus extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_overpass_status';
    protected const DESCRIPTION = 'Check public Overpass API status.';
    protected const METHOD = 'overpassStatus';
}
