<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Call any Bitly DELETE API endpoint.
 */
class BitlyApiDelete extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_api_delete';
    }

    public function description(): string
    {
        return 'Call any Bitly API v4 DELETE endpoint.';
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
        return $this->service->apiDelete($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
