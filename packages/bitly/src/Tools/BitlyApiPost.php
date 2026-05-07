<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Call any Bitly POST API endpoint.
 */
class BitlyApiPost extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_api_post';
    }

    public function description(): string
    {
        return 'Call any Bitly API v4 POST endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path.'],
            'body' => ['type' => 'object', 'description' => 'JSON body.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiPost($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
