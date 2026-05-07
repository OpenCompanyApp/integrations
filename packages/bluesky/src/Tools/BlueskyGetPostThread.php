<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get a Bluesky post thread.
 */
class BlueskyGetPostThread extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_post_thread';
    protected const DESCRIPTION = 'Get a post thread by root post AT URI.';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => true, 'description' => 'Post AT URI.'],
        'depth' => ['type' => 'integer', 'description' => 'Reply depth.'],
        'parent_height' => ['type' => 'integer', 'description' => 'Parent traversal height.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getPostThread(
            $this->stringArg($args, 'uri'),
            isset($args['depth']) ? (int) $args['depth'] : null,
            isset($args['parent_height']) ? (int) $args['parent_height'] : null,
        );
    }
}
