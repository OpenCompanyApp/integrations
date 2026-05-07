<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get one or more Bluesky posts by URI.
 */
class BlueskyGetPosts extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_posts';
    protected const DESCRIPTION = 'Get one or more posts by AT URI.';
    protected const PARAMETERS = [
        'uris' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Post AT URIs.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        if (! is_array($args['uris'] ?? null)) {
            throw new \RuntimeException('uris must be an array.');
        }

        return $this->service->getPosts($args['uris']);
    }
}
