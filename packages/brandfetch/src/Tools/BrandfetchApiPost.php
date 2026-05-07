<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Execute a safe raw POST request against Brandfetch.
 */
class BrandfetchApiPost extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_api_post';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Brandfetch API path with POST.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path, for example /v2/brands/transaction.'],
        'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        'params' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->apiPost(
            (string) $this->required($args, 'path'),
            $this->object($args, 'payload'),
            $this->object($args, 'params'),
        );
    }
}
