<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MastodonListStatuses — browse statuses from a timeline.
 *
 * Retrieves statuses from the home, local, or public timeline.
 * Supports pagination via max_id and since_id cursors.
 */
class MastodonListStatuses implements Tool
{
    public function __construct(
        private MastodonService $service,
    ) {}

    public function name(): string
    {
        return 'mastodon_list_statuses';
    }

    public function description(): string
    {
        return 'Browse statuses (toots) from a Mastodon timeline. Use "home" for your home feed, "public" for the federated timeline, or "local" for the local instance timeline. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'timeline' => ['type' => 'string', 'description' => 'Timeline to retrieve: "home" (default), "local", or "public".', 'default' => 'home'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of statuses to return (1–40, default: 20).'],
            'max_id' => ['type' => 'string', 'description' => 'Return results older than this status ID (for pagination).'],
            'since_id' => ['type' => 'string', 'description' => 'Return results newer than this status ID (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            $timeline = $args['timeline'] ?? 'home';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $maxId = $args['max_id'] ?? null;
            $sinceId = $args['since_id'] ?? null;

            $statuses = $this->service->listStatuses($timeline, $limit, $maxId, $sinceId);

            $formatted = array_map([$this, 'formatStatus'], $statuses);

            return ToolResult::success([
                'timeline' => $timeline,
                'statuses' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a status for a cleaner response.
     *
     * @param  array<string, mixed>  $status
     * @return array<string, mixed>
     */
    private function formatStatus(array $status): array
    {
        $account = $status['account'] ?? [];

        return [
            'id' => $status['id'] ?? null,
            'created_at' => $status['created_at'] ?? null,
            'content' => $status['content'] ?? '',
            'spoiler_text' => $status['spoiler_text'] ?? '',
            'sensitive' => $status['sensitive'] ?? false,
            'visibility' => $status['visibility'] ?? null,
            'uri' => $status['uri'] ?? null,
            'url' => $status['url'] ?? null,
            'reblogs_count' => $status['reblogs_count'] ?? 0,
            'favourites_count' => $status['favourites_count'] ?? 0,
            'replies_count' => $status['replies_count'] ?? 0,
            'account' => [
                'id' => $account['id'] ?? null,
                'username' => $account['username'] ?? null,
                'display_name' => $account['display_name'] ?? null,
                'acct' => $account['acct'] ?? null,
            ],
            'in_reply_to_id' => $status['in_reply_to_id'] ?? null,
            'language' => $status['language'] ?? null,
        ];
    }
}
