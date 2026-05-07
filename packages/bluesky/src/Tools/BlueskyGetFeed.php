<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get posts from a Bluesky feed generator.
 */
class BlueskyGetFeed extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_feed';
    protected const DESCRIPTION = 'Get posts from a feed generator AT URI.';
    protected const PARAMETERS = [
        'feed' => ['type' => 'string', 'required' => true, 'description' => 'Feed generator AT URI.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of posts to return, max 100.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getFeed($this->stringArg($args, 'feed'), (int) ($args['limit'] ?? 50), $args['cursor'] ?? null);
    }
}
