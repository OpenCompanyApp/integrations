<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get likes for a Bluesky post.
 */
class BlueskyGetLikes extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_likes';
    protected const DESCRIPTION = 'Get actors who liked a post.';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => true, 'description' => 'Post AT URI.'],
        'cid' => ['type' => 'string', 'description' => 'Optional post CID.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of results to return.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getLikes($this->stringArg($args, 'uri'), $args['cid'] ?? null, (int) ($args['limit'] ?? 50), $args['cursor'] ?? null);
    }
}
