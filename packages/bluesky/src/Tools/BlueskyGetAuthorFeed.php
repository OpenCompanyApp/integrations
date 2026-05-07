<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get posts and reposts by a Bluesky actor.
 */
class BlueskyGetAuthorFeed extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_author_feed';
    protected const DESCRIPTION = 'Get an actor feed of posts and reposts by handle or DID.';
    protected const PARAMETERS = [
        'actor' => ['type' => 'string', 'required' => true, 'description' => 'Handle or DID.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of posts to return, max 100.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'filter' => ['type' => 'string', 'description' => 'Optional author feed filter.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getAuthorFeed(
            $this->stringArg($args, 'actor'),
            (int) ($args['limit'] ?? 50),
            $args['cursor'] ?? null,
            $args['filter'] ?? null,
        );
    }
}
