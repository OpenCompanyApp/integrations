<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get actors who reposted a Bluesky post.
 */
class BlueskyGetRepostedBy extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_reposted_by';
    protected const DESCRIPTION = 'Get actors who reposted a post.';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => true, 'description' => 'Post AT URI.'],
        'cid' => ['type' => 'string', 'description' => 'Optional post CID.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of results to return.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getRepostedBy($this->stringArg($args, 'uri'), $args['cid'] ?? null, (int) ($args['limit'] ?? 50), $args['cursor'] ?? null);
    }
}
