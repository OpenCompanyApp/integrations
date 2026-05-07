<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

/**
 * Call any Mastodon POST API endpoint.
 */
class MastodonApiPost extends AbstractMastodonTool
{
    public function name(): string
    {
        return 'mastodon_api_post';
    }

    public function description(): string
    {
        return 'Call any Mastodon POST API endpoint relative to the configured instance.';
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
        return $this->service->apiPost($this->path($args), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
