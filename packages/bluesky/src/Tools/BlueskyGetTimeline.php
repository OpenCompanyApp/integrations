<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Get the authenticated account's Bluesky timeline.
 */
class BlueskyGetTimeline extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_get_timeline';
    protected const DESCRIPTION = 'Get the authenticated Bluesky account timeline.';
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Number of posts to return, max 100.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getTimeline((int) ($args['limit'] ?? 50), $args['cursor'] ?? null);
    }
}
