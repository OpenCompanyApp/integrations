<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

/**
 * Call any Mastodon PUT API endpoint.
 */
class MastodonApiPut extends AbstractMastodonTool
{
    public function name(): string
    {
        return 'mastodon_api_put';
    }

    public function description(): string
    {
        return 'Call any Mastodon PUT API endpoint relative to the configured instance.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path beginning with /api/.'],
            'body' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiPut($this->path($args), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
