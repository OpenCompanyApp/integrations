<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get metadata for a Bluesky feed generator.
 */
class BlueskyGetFeedGenerator extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_feed_generator';
    protected const DESCRIPTION = 'Get metadata for a feed generator AT URI.';
    protected const PARAMETERS = [
        'feed' => ['type' => 'string', 'required' => true, 'description' => 'Feed generator AT URI.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getFeedGenerator($this->stringArg($args, 'feed'));
    }
}
