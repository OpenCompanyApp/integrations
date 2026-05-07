<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Build OpenStreetMap object URLs.
 */
class OpenStreetMapObjectUrl extends AbstractOpenStreetMapTool
{
    protected const NAME = 'openstreetmap_object_url';
    protected const DESCRIPTION = 'Build a stable OpenStreetMap URL for a node, way, or relation.';
    protected const METHOD = 'objectUrl';

    public function parameters(): array
    {
        return OpenStreetMapParameters::objectUrl();
    }
}
