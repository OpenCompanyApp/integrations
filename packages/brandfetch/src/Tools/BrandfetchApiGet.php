<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Execute a safe raw GET request against Brandfetch.
 */
class BrandfetchApiGet extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_api_get';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Brandfetch API path with GET.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path, for example /v2/brands/brandfetch.com.'],
        'params' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->apiGet((string) $this->required($args, 'path'), $this->object($args, 'params'));
    }
}
