<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * Call any Ahrefs API v3 GET endpoint.
 */
class AhrefsApiGet extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_api_get';
    }

    public function description(): string
    {
        return 'Call any Ahrefs API v3 GET endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /v3/site-explorer/metrics.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
