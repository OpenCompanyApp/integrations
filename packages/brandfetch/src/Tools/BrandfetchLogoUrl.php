<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Build a Logo API CDN URL with transformations.
 */
class BrandfetchLogoUrl extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_logo_url';
    protected const TOOL_DESCRIPTION = 'Build a Brandfetch Logo API CDN URL with optional transformations.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Domain, Brand ID, ticker, ISIN, or crypto symbol.'],
        'options' => ['type' => 'object', 'description' => 'Options: width, height, theme, fallback, type, format, client_id.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->logoUrl((string) $this->required($args, 'identifier'), $this->object($args, 'options'));
    }
}
