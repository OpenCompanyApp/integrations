<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Call any Bitly GET API endpoint.
 */
class BitlyApiGet extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_api_get';
    }

    public function description(): string
    {
        return 'Call any Bitly API v4 GET endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /groups or /user.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
