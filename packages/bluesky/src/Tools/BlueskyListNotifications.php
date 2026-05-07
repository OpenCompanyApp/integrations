<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * List notifications for the authenticated Bluesky account.
 */
class BlueskyListNotifications extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_list_notifications';
    protected const DESCRIPTION = 'List notifications for the authenticated account.';
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Number of notifications to return.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'seen_at' => ['type' => 'string', 'description' => 'Optional seen timestamp.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listNotifications((int) ($args['limit'] ?? 50), $args['cursor'] ?? null, $args['seen_at'] ?? null);
    }
}
