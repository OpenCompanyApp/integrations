<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

/**
 * Call any Mastodon GET API endpoint.
 */
class MastodonApiGet extends AbstractMastodonTool
{
    public function name(): string
    {
        return 'mastodon_api_get';
    }

    public function description(): string
    {
        return 'Call any Mastodon GET API endpoint relative to the configured instance, such as /api/v1/notifications.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path beginning with /api/.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->path($args), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
