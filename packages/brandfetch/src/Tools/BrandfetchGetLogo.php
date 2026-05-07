<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Build a direct Logo API CDN URL.
 */
class BrandfetchGetLogo extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_logo';
    protected const TOOL_DESCRIPTION = 'Build a direct Brandfetch Logo API CDN URL for embedding.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Domain, Brand ID, ticker, ISIN, or crypto symbol.'],
        'src' => ['type' => 'string', 'description' => 'Legacy passthrough logo source URL.'],
        'options' => ['type' => 'object', 'description' => 'Logo URL options such as width, height, theme, fallback, type, format, or client_id.'],
    ];

    protected function run(array $args): array
    {
        if (isset($args['src']) && !isset($args['identifier'])) {
            return $this->service->getLogo((string) $args['src']);
        }

        return $this->service->logoUrl((string) $this->required($args, 'identifier'), $this->object($args, 'options'));
    }
}
